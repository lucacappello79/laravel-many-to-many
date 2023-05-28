@extends('layouts.admin')

@section('content')
  
<div class="container">
    
<h1 class="m-3">Type Index</h1>




<table class="mt-5 table table-striped">
    <thead class="thead-dark">
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Slug</th>

            <th>Total</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($types as $item)
        <tr>
            <td>{{$item->name}}</td>
            <td>{{$item->description}}</td>
            <td>{{$item->slug}}</td>

            <td>{{count($item->projects)}}</td>
            <td><a href="{{ route('admin.types.show', $item)}}">View</a></td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center py-3">
    <a href="{{ route('admin.types.create')}}" class="btn btn-primary">Add a Type</a>
</div>




</div>
 
@endsection