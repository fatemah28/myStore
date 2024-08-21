@extends('layouts.master')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Data Tables</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item">Data</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Users</h5>
                            <div>
                                <form action="{{ route('adminCreateUser') }}">
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
                                        <th scope="col">User Name</th>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">User Image</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($users) > 0)
                                        @foreach ($users as $user)
                                            <tr>
                                                <th scope="row">{{ $user->id }}</th>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->full_name }}</td>
                                                <td><img style="width: 100px;height:80px;"
                                                        src="{{ Storage::url($user->image) }}" alt=""></td>
                                                <td>{{ $user->role }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td><a class="btn btn-primary rounded-pill"
                                                        href="{{ route('adminEditUser', $user->id) }}">Edit</a>
                                                    <a class="btn btn-danger rounded-pill"
                                                        href="{{ route('adminDeleteUser', $user->id) }}">Delete</a>
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
