@extends('layouts.main_layout')

@section('main_section')
<div id="app">

  @auth
  <span class="user">{{$user}}</span>
  @endauth
  <select v-model="selected">
    <option  value=" ">Select employee</option>
    @foreach ($users as $user)
      <option value="{{$user -> id}}">{{$user -> name}}</option>
    @endforeach
  </select>
  <input v-model="message" placeholder="filter by title">
  @foreach ($tasks as $task)

    <task-component
    :filterbyname = "message"
    :selectvalue = "selected"
    :creator = '"{{$task -> user -> name}}"'
    :id = "{{$task -> id}}"
    :name ="'{{$task-> name}}'"
    :yarchived = "'yes'"
    :archivedbyuser = "'{{$task -> completed_by_id}}'"
    ></task-component>
  @endforeach

</div>
@endsection
