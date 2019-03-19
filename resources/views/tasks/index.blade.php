@extends('layouts.scaffold')

@section('main')

<h1>Current Tasks</h1>

<a href="{{ route('tasks.create') }}">Add new task</a>

@if ($tasks->count())
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{{ $task->name }}}</td>
                    <td>{{{ $task->description }}}</td>
                    <td>
                        <a class="btn btn-info" href="{{ route('tasks.edit', $task->id) }}">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"> 
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger">Deletea</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    There are no tasks
@endif

@stop
