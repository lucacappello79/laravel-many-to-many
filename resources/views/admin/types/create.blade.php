@extends('layouts.admin')

@section('content')


<div class="container">

    <h1 class="mb-3">Add a Type</h1>
    
    <form action="{{ route('admin.types.store')}}" method="POST">
    @csrf
    
    <div class="mb-3">
        <label for="name">Type Name</label>
        <input name="name" id="name" class="form-control @error('name') is-invalid @enderror" type="text" value="{{old('name')}}">

        @error('name')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>
    
    <div class="mb-3">
        <label for="description">Type Description</label>
        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{old('description')}}</textarea>

        @error('description')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Create a Type</button>

</form>

</div>


@endsection
