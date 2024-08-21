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
            <h5 class="card-title">Are you sure to Delete &nbsp;{{$user->name}} &nbsp;User?</h5>

            <!-- General Form Elements -->
            <form action="{{route('adminUserDestroy',$user->id)}}" method="POST" enctype="multipart/form-data">
              @csrf
              
              <div class="row mb-3">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-danger rounded-pill">Delete</button>
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