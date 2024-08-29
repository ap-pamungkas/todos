<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{

    public function index(Request $request)
    {
        $status = $request->query('status', 'all');

        if ($status == 'active') {
            $todos = Todo::where('status', 'active')->get();
        } elseif ($status == 'completed') {
            $todos = Todo::where('status', 'complete')->get();
        } else {
            $todos = Todo::all();
        }

        return view('todo.index', ['todos' => $todos, 'status' => $status]);
    }


    public function store(Request $request)
    {
        $todo = new Todo;
        $todo->title = $request->input('title');
        $todo->status = 'active';
        $todo->save();

        return redirect()->route('todos.index');
    }


    public function updateStatus($id)
    {
        $todo = Todo::find($id);

        if ($todo->status == 'active') {
            $todo->status = 'complete';
        } else {
            $todo->status = 'active';
        }

        $todo->save();

        return redirect()->route('todos.index');
    }

    // Clear completed todos
    public function clearCompleted()
    {
        Todo::where('status', 'complete')->update(['status' => 'active']);


        return redirect()->route('todos.index');
    }

    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();

        return redirect()->back()->with('success', 'Todo deleted successfully!');
    }
}
