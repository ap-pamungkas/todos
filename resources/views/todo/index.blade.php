<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Todo List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1>Todo</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('todos.store') }}" method="POST">
                    @csrf
                    <input type="text" name="title" class="form-control" placeholder="What needs to be done?">
                </form>
                <div class="mt-3">
                    @foreach ($todos as $todo)
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <form action="{{ route('todos.updateStatus', $todo->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT') <!-- Assuming you're using PUT for status update -->
                                <input type="checkbox" onclick="this.form.submit()" {{ $todo->status == 'complete' ? 'checked' : '' }}>
                                <label>{{ $todo->title }}</label>
                            </form>
                        </div>
                        <div>
                            <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
                
                </div>
            </div>
            <div class="card-footer">
                <span>{{ $todos->count() }} items left</span>
                <div class="float-end">
                    <a href="{{ route('todos.index', ['status' => 'all']) }}" class="btn btn-link {{ $status == 'all' ? 'active' : '' }}">All</a>
                    <a href="{{ route('todos.index', ['status' => 'active']) }}" class="btn btn-link {{ $status == 'active' ? 'active' : '' }}">Active</a>
                    <a href="{{ route('todos.index', ['status' => 'completed']) }}" class="btn btn-link {{ $status == 'completed' ? 'active' : '' }}">Completed</a>
                    <form action="{{ route('todos.clearCompleted') }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-link">Clear completed</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
