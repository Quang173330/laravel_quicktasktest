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

                        <table class="table table-striped task-table">
                            <thead>
                                <th>Name</th>
                                <th>Email</th>
                            </thead>
                            <tbody>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Tasks
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
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
