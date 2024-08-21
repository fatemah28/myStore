@extends('layouts.master')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Data Tables</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Products</li>
          <li class="breadcrumb-item ">Data</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Products</h5>
              <div>
                <form action="{{ route('adminCreateProduct') }}">
                    @csrf
                    <button type="submit" class="btn btn-success rounded-pill">Create</button>
                    {{ session('message') }}
                </form>
            </div>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Image</th>
                    <th scope="col">Product Price</th>
                    <th scope="col">Product Category</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                      <th scope="row">{{$product->id}}</th>
                      <td>{{$product->name}}</td>
                      <td><img  style="width: 100px;height:80px;" src="{{Storage::url($product->image)}}" alt=""></td>
                      <td>{{$product->price}}</td>
                      <td>{{$product->category->name}}</td>
                      <td><a class="btn btn-primary rounded-pill" href="{{route('adminEditProduct',$product->id)}}">Edit</a> 
                          <a  class="btn btn-danger rounded-pill" href="{{route('adminDeleteProduct',$product->id)}}">Delete</a></td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

@endsection