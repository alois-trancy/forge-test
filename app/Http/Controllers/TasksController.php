<?php

namespace App\Http\Controllers;

use App\Jobs\LogDetail;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Validator;

class TasksController extends Controller
{
    /**
	 * Task Repository
	 *
	 * @var Task
	 */
	protected $task;

	public function __construct(Task $task)
	{
		$this->task = $task;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tasks = $this->task->all();

		return view('tasks.index', compact('tasks'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('tasks.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = request()->all();
		$validation = Validator::make($input, Task::$rules);

		if ($validation->passes())
		{
			$task = $this->task->create($input);

            // Queue::push(LogDetail::class);
            dispatch(new LogDetail($task->id));

			return redirect()->route('tasks.index');
		}

		return redirect()->route('tasks.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$task = $this->task->findOrFail($id);

		return view('tasks.show', compact('task'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$task = $this->task->find($id);

		if (is_null($task))
		{
			return redirect()->route('tasks.index');
		}

		return view('tasks.edit', compact('task'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(request()->all(), '_method');
		$validation = Validator::make($input, Task::$rules);

		if ($validation->passes())
		{
			$task = $this->task->find($id);
			$task->update($input);

			return redirect()->route('tasks.show', $id);
		}

		return redirect()->route('tasks.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->task->find($id)->delete();

		return redirect()->route('tasks.index');
	}
}
