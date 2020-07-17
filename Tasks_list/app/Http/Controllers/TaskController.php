<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
class TaskController extends Controller
{
    public function home(){
      $tasks = Task::all() -> where("completed" , 0);
      return view("welcome", compact("tasks"));
    }
}
