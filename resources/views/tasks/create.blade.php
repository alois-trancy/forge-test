@extends('layouts.scaffold')

@section('main')

<h1>Create Task</h1>

<form action="{{ route('tasks.store') }}" method="POST">
	{{ csrf_field() }}
	<ul>
        <li>
        	<label for="name">Name</label>
        	<input type="text" name="name" id="name" />
        </li>

        <li>
        	<label for="description">Description</label>
        	<textarea name="description" id="description"></textarea>
        </li>

		<li>
			<button type="submit" class="btn btn-info">Submit</button>
		</li>
	</ul>
</form>

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop