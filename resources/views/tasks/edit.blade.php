@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <!-- Current Tasks -->
            @if ($task)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Task
                    </div>

                    <div class="panel-body">
                        @include('common.errors')

                        <table class="table table-striped task-table" id="table-task">
                            <thead>
                                <th>Name</th>
                                <th>Description</th>
                            </thead>
                            <tbody>
                                <td>
                                    <div>{{ $task->name }}
                                        <div>
                                </td>
                                <td>
                                    <div>{{ $task->description }}</div>
                                </td>
                                <td><button type="submit" class="btn btn-danger" id="button-edit">
                                        <i class="fa fa-pencil"></i>
                                    </button></td>
                            </tbody>
                        </table>
                        <form action="{{ route('tasks.update', ['task' => $task->id]) }}" method="POST" id="form-edit"
                            class="form-horizontal" style="display:none">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <!-- Task Name -->
                            <div class="form-group">
                                <label for="task-name" class="col-sm-3 control-label">Name</label>
                                <div class="col-sm-6">
                                    <input type="text" name="name" id="task-name" class="form-control"
                                        value="{{ $task->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="task-description" class="col-sm-3 control-label">Description</label>
                                <div class="col-sm-6">
                                    <textarea name="description" id="task-description" class="form-control"
                                        value="">{{ $task->description }}</textarea>
                                </div>
                            </div>
                            <!-- Add Task Button -->
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-success">
                                        Update
                                    </button>
                                    <button type="button" class="btn btn-success" id="button-reset">
                                        Reset
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        User
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                                <th>Name</th>
                                <th>Email</th>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="table-text">
                                            <div>{{ $user->name }}</div>
                                        </td>
                                        <td class="table-text">
                                            <div>{{ $user->email }}</div>
                                        </td>
                                        <td>
                                            <form action="{{ route('tasks.update', ['task' => $task->id]) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('PUT') }}
                                                <input type="hidden" name="delete_user" value="{{ $user->id }}">
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-user-times"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="">
                    <button type="button" class="btn btn-success" id="button-add-user">Add User</button>
                </div>
                <div class="panel panel-default" id="add-user" style="display:none">
                    <div class="panel-heading">
                        Add User
                    </div>

                    <div class="panel-body">
                        <!-- Display Validation Errors -->
                        @include('common.errors')

                        <!-- New Task Form -->
                        <form action="{{ route('tasks.update', ['task' => $task->id]) }}" method="POST"
                            class="form-horizontal">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <!-- Task Name -->
                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-3">
                                    @foreach ($users1 as $user)
                                        <div class="form-check">
                                            <input name="add_user[]" class="form-check-input" value="{{ $user->id }}"
                                                type="checkbox" id="gridCheck1">
                                            <label class="form-check-label" for="gridCheck1">{{ $user->name }}</label>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                            <!-- Add Task Button -->
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-success">
                                        Add User
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/edittask.js') }}"></script>
@endsection
