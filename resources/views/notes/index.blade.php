@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
      <div class="col">
        <div class="jumbotron">
            <h1 class="display-4"> All Notes  </h1>
        <a class="btn btn-success" href="{{route('note.create')}}"> New Note</a>
    </div>
</div>
</div>

<div class="row">

    @if ($notes->count() >0)
    <div class="col">
        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Content</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>

            <tbody>
                @php
                $i = 1;
            @endphp
            @foreach ($notes as $item)
            <tr>
                <th scope="row">{{$i++}}</th>
                <td>{{$item->title}}</td>
                <td>{{$item->content}}</td>
                <td>
                    <a class="text-success" href="{{route('note.show',['id'=> $item->id])}}"> <i class="fas  fa-2x fa-eye"></i>  </a>
                    <a href="{{route('note.edit',['id'=> $item->id])}}"> <i class="fas fa-2x fa-edit"></i>  </a>
                    <a class="text-danger" href="{{route('note.destroy',['id'=> $item->id])}}"> <i class="fas  fa-2x fa-trash-alt"></i> </a>
                </td>
              </tr>
            @endforeach
        </tbody>
      </table>
  </div>
@else
<div class="col">
    <div class="alert alert-danger" role="alert">
        No Notes
      </div>
</div>
@endif
</div>
</div>
@endsection



