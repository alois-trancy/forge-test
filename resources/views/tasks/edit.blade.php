@extends('layouts.scaffold')

@section('main')

<h1>Edit Task</h1>
<form action="{{ route('tasks.update', $task->id) }}" method="POST">
	{{ csrf_field() }}
	{{ method_field('PATCH') }}
	<ul>
		<li>
        	<label for="name">Name</label>
        	<input type="text" name="name" id="name" value="{{ $task->name }}" />
        </li>

        <li>
        	<label for="description">Description</label>
        	<textarea name="description" id="description">{{ $task->name }}</textarea>
        </li>

		<li>
			<button type="submit" class="btn btn-info">Update</button>
			<a class="btn" href="{{ route('tasks.show', $task->id) }}">Cancel</a>
		</li>
	</ul>
</form>

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
