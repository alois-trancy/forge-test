@extends('layouts.scaffold')

@section('main')

<h1>Show Task</h1>

<a href="{{ route('tasks.index') }}">Return to all tasks</a>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Name</th>
				<th>Description</th>
		</tr>
	</thead>

	<tbody>
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
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
		</tr>
	</tbody>
</table>

@stop
