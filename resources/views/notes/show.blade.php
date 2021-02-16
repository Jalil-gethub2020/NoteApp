@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
      <div class="col">  </div>

    <div class="row">

      <div class="col">

        <div class="card" style="width: 45rem">

      <div class="card-body">
       <h5 class="card-title">{{($note->title)}}</h5>
        <p class="card-text"> {{($note->content)}}</p>

<br>
      <a class="btn btn-success" href="{{route('notes')}}">All Notes </a>

            </div>
          </div>
      </div>
    </div>
  </div>

  @endsection
