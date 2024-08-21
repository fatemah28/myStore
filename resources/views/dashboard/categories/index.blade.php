@extends('layouts.master')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Data Tables</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Categories</li>
                    <li class="breadcrumb-item">Data</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Categories</h5>
                            <div>
                                <form action="{{ route('adminCreateCategory') }}">
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
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Category Image</th>
                                        <th scope="col">Created at</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($categories) > 0)
                                        @foreach ($categories as $category)
                                            <tr>
                                                <th scope="row">{{ $category->id }}</th>
                                                <td>{{ $category->name }}</td>
                                                <td><img style="width: 100px;height:80px;"
                                                        src="{{ Storage::url($category->image) }}" alt=""></td>
                                                <td>{{ $category->created_at }}</td>
                                                <td><a class="btn btn-primary rounded-pill"
                                                        href="{{ route('adminEditCategory', $category->id) }}">Edit</a>
                                                    <a class="btn btn-danger rounded-pill"
                                                        href="{{ route('adminDeleteCategory', $category->id) }}">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                    @endif
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
