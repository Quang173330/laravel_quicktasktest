@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <!-- Current Tasks -->
            @if ($user)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        User
                    </div>

                    <div class="panel-body">
                        @include('common.errors')

                        <table class="table table-striped task-table" id="table-task">
                            <thead>
                                <th>Name</th>
                                <th>Email</th>
                            </thead>
                            <tbody>
                                <td>
                                    <div>{{ $user->name }}
                                        <div>
                                </td>
                                <td>
                                    <div>{{ $user->email }}</div>
                                </td>
                                <td><button type="submit" class="btn btn-danger" id="button-edit">
                                        <i class="fa fa-pencil"></i>
                                    </button></td>
                            </tbody>
                        </table>
                        <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST" id="form-edit"
                            class="form-horizontal" style="display:none">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <!-- Task Name -->
                            <div class="form-group">
                                <label for="user-name" class="col-sm-3 control-label">Name</label>
                                <div class="col-sm-6">
                                    <input type="text" name="name" id="user-name" class="form-control"
                                        value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="user-email" class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-6">
                                    <textarea name="email" id="user-email" class="form-control"
                                        value="">{{ $user->email }}</textarea>
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
                        Task
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                                <th>Name</th>
                                <th>Description</th>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td class="table-text">
                                            <div>{{ $task->name }}</div>
                                        </td>
                                        <td class="table-text">
                                            <div>{{ $task->description }}</div>
                                        </td>
                                        <td>
                                            <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('PUT') }}
                                                <input type="hidden" name="delete_task" value="{{ $task->id }}">
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
                    <button type="button" class="btn btn-success" id="button-add-user">Add Task</button>
                </div>
                <div class="panel panel-default" id="add-user" style="display:none">
                    <div class="panel-heading">
                        Add Task
                    </div>

                    <div class="panel-body">
                        <!-- Display Validation Errors -->
                        @include('common.errors')

                        <!-- New Task Form -->
                        <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST"
                            class="form-horizontal">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <!-- Task Name -->
                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-3">
                                    @foreach ($tasks1 as $task)
                                        <div class="form-check">
                                            <input name="add_task[]" class="form-check-input" value="{{ $task->id }}"
                                                type="checkbox" id="gridCheck1">
                                            <label class="form-check-label" for="gridCheck1">{{ $task->name }}</label>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                            <!-- Add Task Button -->
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-success">
                                        Add Task
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
