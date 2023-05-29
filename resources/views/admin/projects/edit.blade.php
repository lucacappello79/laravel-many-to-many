@extends('layouts.admin')

@section('content')

<main class="create-main container-fluid py-4">
  <div class="row justify-content-center">
    <div class="col-6">
      <div class="create-card">
        <div class="card-header">
          <h3 class="card-title mt-3 mb-4 text-center">Edit Project</h5>
        </div>
        <div class="card-body">

          <form action="{{ route('admin.projects.update', $project) }}" method="POST" class="text-dark" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3 text-white">
              <label for="title" class="form-label">Title</label>
              <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title') ?? $project->title}}" required>
            
              @error('title')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
              @enderror
            </div>

            <div class="mb-3 text-white">
              <label for="type_id" class="form-label">Project Type</label>
              <select name="type_id" id="type_id" class="form-select @error('type_id') is-invalid @enderror">
                
                <option value="">Undefined</option>

                @foreach ($types as $item)
                  <option value="{{$item->id}}" {{$item->id == old('type_id', $project->type_id) ? 'selected' : ''}}>{{$item->name}}</option>   
                @endforeach

              </select>

              @error('type_id')
              <div class="invalid-feedback">
                {{$message}}
              </div>
              @enderror
            </div>

            {{-- test file --}}

            <div class="my-4">
              <label for="cover_image">Project Thumb</label>
              <input type="file" id="cover_image" name="cover_image" class="form-control @error('cover_image') is-invalid @enderror">
              @error('cover_image')
                  <div class="invalid-feedback">{{$message}}</div>
              @enderror
            </div>

            {{-- fine test --}}


            <div class="my-3 form-group text-white">
              <h2>Technologies</h2>
        
              @foreach($technologies as $item)
              <div class="form-check">
                <input type="checkbox" id="technology-{{$item->id}}" name="technologies[]" value="{{$item->id}}" @checked($project->technologies->contains($item))>
                <label for="technology-{{$item->id}}">{{$item->name}}</label>
              </div>
              @endforeach
        
            </div>



            <div class="mb-3 text-white">
              <label for="content" class="form-label">Project Summary</label>
              <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" required>{{old('content') ?? $project->content}}</textarea>
            
              @error('content')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
              @enderror
            </div>

            {{-- <div class="mb-3">
              <label for="type" class="form-label">Type</label>
              <input type="text" id="type" name="type" class="form-control @error('type') is-invalid @enderror" value="{{old('type')}}" required>
            
              @error('type')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
              @enderror
            </div> --}}

            {{-- <div class="mb-3">
              <label for="src" class="form-label">Link immagine</label>
              <input type="text" id="src" name="src" class="form-control" required>
            </div> --}}
{{-- 
            <div class="mb-3">
              <label for="slug" class="form-label">Slug</label>
              <input type="text" id="slug" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{old('slug')}}" required>
            
              @error('slug')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
              @enderror
            
            </div> --}}

            <div class="d-flex justify-content-between align-items-center" style="gap: 1rem; max-width: 300px; margin: auto;">
              <button type="submit" class="btn btn-primary">Edit Project</button>
              <button class="btn btn-success" onclick="location.href='{{ route('admin.projects.index')}}'">Back to List</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</main>

@endsection