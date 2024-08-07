@extends('layouts.app')
@section('content')
    <form action="{{route('adminCategoryUpdate',$category->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Category Name</label>
            <input type="text"  value="{{$category->name}}" name="name" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Category Image</label>
            <img  style="width: 100px;height=100px;" src="{{Storage::url($category->image)}}" alt="">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Change Image</label>
            <input type="file" name="image" id="">
          </div>
          <div class="mb-3">
         <input type="submit" value="Update">
          </div>
    </form>
@endsection