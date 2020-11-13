@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <!-- Current Tasks -->
            @if (count($tasks) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ __('task.list') }}
                    </div>

                    <div class="panel-body">
                        @include('common.errors')

                        <table class="table table-striped task-table">
                            <thead>
                                <th>Task</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td class="table-text">
                                            <div>{{ $task->name }}</div>
                                        </td>
                                        <!-- Task Delete Button -->
                                        <td>
                                            <form action="{{ route('tasks.destroy', ['task' => $task->id]) }}"
                                                method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>Delete
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{ route('tasks.show', ['task' => $task->id]) }}" method="GET">
                                                <button type="submit" class="btn btn-info">
                                                    <i class="fa fa-btn  fa-eye"></i>View
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{ route('tasks.edit', ['task' => $task->id]) }}" method="GET">
                                                <button type="submit" class="btn btn-warning">
                                                    <i class="fa fa-btn fa-edit"></i>Edit
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <h1>No have tasks</h1>
            @endif
        </div>
    </div>
@endsection
