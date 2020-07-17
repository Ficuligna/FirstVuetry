<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Auth;
class UserController extends Controller
{


  public function __construct()
  {
      $this->middleware('auth');
  }

  public function home(){
    $tasks = Task::all() -> where("completed" , 0);
    $user = Auth::user() -> name;
    $id = Task::all()->max('id');
    return view("welcome", compact("tasks", "user", "id"));
  }
  public function delete($id){

    $task = Task::findOrFail($id);
    $task -> delete();

    return response() -> json("task n° " . $id . " deleted", 200);
  }

  public function update(Request $request,$id){
    $validate_data = $request-> validate([
      "name" => "required"
    ]);

    $task = Task::findOrFail($id);
    $task["name"] = $validate_data["name"];
    $task->save();

    return response() -> json("task n° " . $id . " has been updated",200);

  }

  public function archive($id){

    $task = Task::findOrFail($id);
    $task["completed"] = 1;
    $task->save();

    return response() -> json("task n° " . $id . " has been archived",200);

  }
  public function store(Request $request){
    $user_id = Auth::user() -> id;
    $validate = $request -> validate([
      "name" => "required"
    ]);
    $task = new Task;
    $task["name"] = $validate["name"];
    $task["user_id"] = $user_id;
    $task["completed"] = 0;
    $task -> save();

    return response() -> json("new task is added", 200);

  }
}
