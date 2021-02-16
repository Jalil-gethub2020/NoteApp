@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
      <div class="col">
        <div class="jumbotron">
            <h1 class="display-4"> Edit Note </h1>
        <a class="btn btn-success" href="{{route('notes')}}">All Notes </a>
        </div>
      </div>
    </div>

    <div class="row">

        @if (count($errors)>0)
            <ul>
            @foreach($errors->all() as $item)
              <li>
                  {{$item}}
              </li>
            @endforeach
            </ul>
        @endif

      <div class="col">
        <form action="{{route('note.update',['id'=>$note->id])}}" method="POST" >
        @csrf
            <div class="form-group">
              <label for="exampleFormControlInput1">Title</label>
              <input type="text" name="title" value="{{$note->title}}" class="form-control">
            </div>

            <div class="form-group">
              <label for="exampleFormControlTextarea1">Content </label>
              <textarea class="form-control" name="content" rows="3"> {{$note->content}} </textarea>
            </div>

            <div class="form-group">
                <button class="btn btn-primary" type="submit"> Update</button>
            </div>

        </form>
      </div>
    </div>
  </div>

  @endsection
