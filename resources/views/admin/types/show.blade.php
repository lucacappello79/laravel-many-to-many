@extends('layouts.admin')

@section('content')
  
<div class="container">
    
<h1 class="m-3">Type: {{$type->name}}</h1>


@if (count($type->projects) > 0)




<table class="mt-5 table table-striped">


    <thead class="thead-dark">
        <tr>
            <th>Title</th>
            {{-- <th>Content</th> --}}
            <th>Slug</th>
            <th>Console</th>
        </tr>
    </thead>


    <tbody>
        @foreach($type->projects as $item)
        <tr>
            <td>{{$item->title}}</td>
            {{-- <td>{{$item->content}}</td> --}}
            <td>{{$item->slug}}</td>

            <td class="line-height">
                <div class="d-flex gap-2">
                    <a href="{{route('admin.projects.show', ['project' => $item->slug])}}" class="btn btn-primary">View</a>
                    <a href="{{route('admin.projects.edit', ['project' => $item->slug])}}" class="btn btn-warning">Edit</a>

                    <form method="POST" action="{{route('admin.projects.destroy', ['project' => $item->slug])}}"  class="d-inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Confermi di voler cancellare questo elemento dalla libreria? Questa azione non è reversibile')">Delete</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>



@else
    <strong>No project of this type</strong>
@endif

<div class="d-flex justify-content-around">
    <a href="{{route('admin.types.edit', $type)}}" class="btn btn-secondary">Edit Type</a>

    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
    
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="deleteModalLabel">Delete Type</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to DELETE this type: {{$type->name}}?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          
          <form action="{{route('admin.types.destroy', $type)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">DELETE</button>
          </form>
  
        </div>
      </div>
    </div>
  </div>
  


@endsection
