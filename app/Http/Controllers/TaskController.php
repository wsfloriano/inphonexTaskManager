<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Task;

class TaskController extends Controller
{
	public function index()
	{
		$tasks = Task::where('done', '=', false)->orderBy('sort_order')->get();

		if ($tasks->count() < 1) {
			return response()->json(array('message' => 'Wow. You have nothing else to do. Enjoy the rest of your day!'));
		}

		return $tasks->toJson();
	}

    public function store()
    {
    	$newTask = new Task();
    	$sort_order = Input::get('sort_order');
    	$content = Input::get('content');
    	$type = Input::get('type');

    	if (empty($content)) {
    		return response()->json(['error' => 'Bad move! Try removing the task instead of deleting its content.'], 403);
    	}

    	switch ($type) {
    		case 'shopping':
    			$type = 1;
    			break;
    		case 'work':
    			$type = 2;
    			break;
    		default:
    			return response()->json(['error' => 'The task type you provided is not supported. You can only use shopping or work.'], 403);
    			break;
    	}
    	
    	$tasks = Task::orderBy('sort_order')->get();
    	if ($tasks->count() > 1) {
	    	foreach ($tasks as $task) {
	    		if ($task->sort_order >= $sort_order) {
	    			$updateTask = Task::findOrFail($task->id);
		    		$updateTask->sort_order = ++$task->sort_order;
		    		$updateTask->save();
	    		}	    		
	    	}
    	}

    	$newTask->type = $type;
    	$newTask->content = $content;
    	$newTask->sort_order = $sort_order;
    	$newTask->done = false;


    	if ($newTask->save()) {
    		return response()->json(["succes" => true , $newTask]);
    	}else{
    		return response()->json(['error' => 'Unexpected error.']);
    	}
    }

    public function details($id)
    {
    	$task = Task::find($id);

    	if (empty($task)) {
    		return response()->json(['error' => "Are you a hacker or something? The task doesn't exist."], 403);
    	}

    	return response()->json(["succes" => true , $task]);
    }

    public function delete($id)
    {
    	$task = Task::find($id);

    	if (empty($task)) {
    		return response()->json(['error' => "Good news! The task you were trying to delete didn't even exist"], 403);
    	}

    	$tasks = Task::where('sort_order', '>=', $task->sort_order)->orderBy('sort_order')->get();
    	if ($tasks->count() > 1) {
    		
	    	foreach ($tasks as $key) {
	    		$updateTask = Task::findOrFail($key->id);
	    		$updateTask->sort_order = --$key->sort_order;
	    		$updateTask->save();
	    	}
    	}

    	if ($task->delete()) {
    		return response()->json(["succes" => true , "message" => "Task successfully deleted."]);
    	}
    	
    }

    public function update($id)
	{
    	$updateTask = Task::find($id);
    	$sort_order = Input::get('sort_order');
    	$content = Input::get('content');
    	$type = Input::get('type');
    	$done = Input::get('done');

    	if (empty($updateTask)) {
    		return response()->json(['error' => "Are you a hacker or something? The task you were trying to edit doesn't exist."], 403);
    	}

    	if (!empty($done)) {
    		$updateTask->done = $done;
    		if ($updateTask->save()) {
	    		return response()->json(["succes" => true , $updateTask]);
	    	}
    	}

    	if (empty($content)) {
    		return response()->json(['error' => 'Bad move! Try removing the task instead of deleting its content.'], 403);
    	}

    	switch ($type) {
    		case 'shopping':
    			$type = 1;
    			break;
    		case 'work':
    			$type = 2;
    			break;
    		default:
    			return response()->json(['error' => 'The task type you provided is not supported. You can only use shopping or work.'], 403);
    			break;
    	}
    	
    	$tasks = Task::orderBy('sort_order')->get();
    	if ($tasks->count() > 1) {
	    	foreach ($tasks as $task) {
	    		if ($task->sort_order >= $sort_order) {
	    			$reorderTask = Task::findOrFail($task->id);
		    		$reorderTask->sort_order = ++$task->sort_order;
		    		$reorderTask->save();
	    		}	    		
	    	}
    	}

    	$updateTask->type = $type;
    	$updateTask->content = $content;
    	$updateTask->sort_order = $sort_order;
    	


    	if ($updateTask->save()) {
    		return response()->json(["succes" => true , $updateTask]);
    	}else{
    		return response()->json(['error' => 'Unexpected error.']);
    	}
	}
}
