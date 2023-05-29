@extends('layouts.admin')

@section('content')

<main class="create-main container-fluid py-4">
  <div class="row justify-content-center">
    <div class="col-6">
      <div class="create-card">
        <div class="card-header">
          <h3 class="card-title mt-3 mb-4 text-center">Add Project</h5>
        </div>
        <div class="card-body">

          <form action="{{ route('admin.projects.store') }}" method="POST" class="text-dark" enctype="multipart/form-data">
            @csrf

            <div class="mb-3 text-white">
              <label for="title" class="form-label">Title</label>
              <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title')}}" required>
            
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
                  <option value="{{$item->id}}" {{$item->id == old('type_id') ? 'selected' : ''}}>{{$item->name}}</option>   
                @endforeach

              </select>

              @error('type_id')
              <div class="invalid-feedback">
                {{$message}}
              </div>
              @enderror
            </div>

            {{-- test file --}}

            <div class="mb-3">
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
                <input type="checkbox" name="technologies[]" id="technology-{{$item->id}}"  value="{{$item->id}}" @checked(in_array($item->id, old('technologies', [])))>
                <label for="technology-{{$item->id}}">{{$item->name}}</label>
              </div>
              @endforeach

              @error('technologies')
              <div class="text-danger">
                {{$message}}
              </div>
              @enderror
        
            </div>



            <div class="mb-3 text-white">
              <label for="content" class="form-label">Project Summary</label>
              <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" required>{{old('content')}}</textarea>
            
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

            {{-- <div class="d-grid">
              <button class="btn btn-primary mt-3" type="submit">Add Project</button>
              <a href="{{ route('admin.projects.index')}}" class="btn btn-success">Back to List</a>
            </div> --}}

            <div class="d-flex justify-content-between align-items-center" style="gap: 1rem; max-width: 300px; margin: auto;">
              <button type="submit" class="btn btn-primary">Add Project</button>
              <button class="btn btn-success" onclick="location.href='{{ route('admin.projects.index')}}'">Back to List</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</main>

@endsection