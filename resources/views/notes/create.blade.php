@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
      <div class="col">
        <div class="jumbotron">
            <h1 class="display-4"> New Note  </h1>
            <a class="btn btn-success" href="{{route('notes')}}"> All Notes </a>
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
        <form action="{{route('note.store')}}" method="POST">
            @csrf

            <div class="form-group">
                <label for="exampleFormControlInput"> Title:</label>
                <input type="text" class="form-control" name="title">
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Content</label>
                <textarea class="form-control"name="content" rows="3"></textarea>
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-primary">SAVE</button>
            </div>
          </form>

        </div>
     </div>
    </div>
</div>
@endsection


