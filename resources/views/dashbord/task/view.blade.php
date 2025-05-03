@extends('dashbord.layout.main')

@section('content')
<a href="{{ route('task.create') }}" class="btn btn-success mb-3">Add Task</a>

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Task Table</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Edit/Delete</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($Task as $key => $taskItem)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $taskItem->title }}</td>
                    <td>{{ $taskItem->description }}</td>
                    <td>{{ $taskItem->due_date }}</td>
                    <td>
                        @if($taskItem->is_completed )
                            <span class="badge bg-success">Completed</span>
                        @else
                            <span class="badge bg-warning">Pending</span>
                        @endif
                    </td>
                    <td class="d-flex gap-2">
                        <a href="{{ route('task.show', $taskItem->id) }}" class="btn btn-info">Update</a>

                        <form action="{{ route('task.destroy', $taskItem->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">No tasks found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
