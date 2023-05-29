@extends('layouts.admin')

@section('content')

<div class="container">
  <div class="text-center">
    <img src="{{asset ('storage/' . $project->cover_image) }}" alt="fnf" class="w-50">
  </div>
</div>

<main class="container-fluid text-dark py-4">
  <div class="row justify-content-center">
    <h1 class="text-white">Projects {{$project->title}}</h1>
    {{-- <h2 class="text-white">Type: {{$project->type ? $project->type->name : 'Undefined Type'}}</h2> --}}
    <h2 class="text-white">Type: {{$project->type->name ?? 'Undefined Type'}}</h2>

    <div class="d-flex py-3">
      @foreach($project->technologies as $item)
        <span class="badge rounded-pill mx-1" style="background-color: {{$item->color}}">{{$item->name}}</span>
      @endforeach
    </div>


    <div class="col-6">
      <div class="card">


        <div class="card-header">
          <h3 class="card-title text-center">{{ $project->title }}</h3>
        </div>


        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <strong>Slug:</strong> {{ $project->slug }}
          </li>
          <li class="list-group-item">
            <strong>Content:</strong> {{ $project->content }}
          </li>
        </ul>


        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
              <a href="{{ route('admin.projects.edit', $project->slug) }}" class="btn btn-primary">Edit Project</a>
              {{-- <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-primary">Edit Project</a> --}}

              <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Delete
              </button>
          </div>

          <a href="{{ route('admin.projects.index')}}" class="btn btn-success">Back to List</a>

        </div>



        <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete this project?</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to DELETE this project? This Action cannot be undone.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form method="POST" action="{{route('admin.projects.destroy', ['project' => $project->slug])}}"  class="d-inline-block">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger" onclick="return confirm('Confermi di voler cancellare questo elemento dalla libreria? Questa azione non è reversibile')">Delete</button>
        </form>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>



      </div>
    </div>
  </div>
</main>

@endsection
