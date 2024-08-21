@extends('layouts.master')
@section('content')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Form Elements</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Forms</li>
        <li class="breadcrumb-item">Elements</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Categories Create Form</h5>

            <!-- General Form Elements -->
            <form action="{{route('adminCategoryUpdate',$category->id)}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Category Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="name" value="{{$category->name}}">
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Category Image</label>
                <div class="col-sm-10">
                  <img style="width:150px;height:150px;" src="{{Storage::url($category->image)}}" alt="">
                </div>
                <div class="col-sm-10">
                  <input type="file" class="form-control" name="image">
                </div>
              </div>
          

              <div class="row mb-3">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Submit Form</button>
                </div>
              </div>

            </form><!-- End General Form Elements -->

          </div>
        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->

@endsection