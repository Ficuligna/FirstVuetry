@extends('layouts.main_layout')

@section('main_section')

  @auth
  <span class="user">{{$user}}</span>    
  @endauth
  <div id="app">
    <a href="/archived">Go to archived tasks</a>
    <button @click="addTask()">Add new task</button>
    <div v-for="(task, index) in tasks" :key="index">
      <task-component
      :user = '"{{$user}}"'
      :name = "'New Title'"
      :stored = "'no'"
      :new_id = "{{$id+1}} + index"
      >
      </task-component>
    </div>

    @foreach ($tasks as $task)

      <task-component
      :new_id = "{{$id}}"
      :user = '"{{$user}}"'
      :creator = '"{{$task -> user -> name}}"'
      :id = "{{$task -> id}}"
      :name ="'{{$task-> name}}'"
      :stored = "'yes'"


      ></task-component>
    @endforeach


  </div>


@endsection
