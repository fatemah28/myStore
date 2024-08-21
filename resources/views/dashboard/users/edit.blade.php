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
                            <form action="{{ route('adminUserUpdate', $user->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">User Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name"
                                            value="{{ $user->name }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Full Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="full_name"
                                            value="{{ $user->full_name }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">User Image</label>
                                    <div class="col-sm-10">
                                        <img style="width:150px;height:150px;" src="{{ Storage::url($user->image) }}"
                                            alt="">
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="image">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="email"
                                            value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">New
                                      Password</label>
                                  <div class="col-md-8 col-lg-9">
                                      <input name="password" type="password" class="form-control" value="{{$user->password}}"
                                          id="currentPassword">
                                  </div>
                              </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Select</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="role">
                                            <option value="admin">Admin</option>
                                            <option value="client">Client</option>
                                        </select>
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
