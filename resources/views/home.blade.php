@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
					<form action="{{route('adminCreateCategory')}}">
						<button>Create</button>
					</form>
				</div>

                <div class="card-body">
                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
					<table class="table">
						<thead>
						  <tr>
							<th scope="col">#</th>
							<th scope="col">Category Name</th>
							<th scope="col">Category Image</th>
							<th scope="col">Created at</th>
							<th scope="col">Actions</th>
						  </tr>
						</thead>
						<tbody>
						  @foreach ($categries as $category)
						  <tr>
							<th scope="row">{{$category->id}}</th>
							<td>{{$category->name}}</td>
							<td><img  style="width: 100px;height=100px;" src="{{Storage::url($category->image)}}" alt=""></td>
							<td>{{$category->created_at}}</td>
							<td><a href="{{route('adminEditCategory',$category->id)}}">Edit</a> 
								<a href="{{route('adminDeleteCategory',$category->id)}}">Delete</a></td>
						  </tr>
						  @endforeach
						</tbody>
					  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
