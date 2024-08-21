@extends('layouts.master')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item ">Customer Items</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Recent Sales -->
                        <div class="col-12">
                            <div class="card recent-sales">

                                <div class="card-body">
                                    <h5 class="card-title">Recent Sales <span>| Today</span></h5>

                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Product Name</th>
                                                <th scope="col">Product Category</th>
                                                <th scope="col"> Date</th>
                                                <th scope="col">Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cartsUsersItems as $cartItem)                         
                                            <tr>
                                                <th scope="row"><a href="#">#{{$cartItem->id}}</a></th>
                                                <td>{{$cartItem->product->name}}</td>
                                                <td><a href="#" class="text-primary">{{$cartItem->product->category->name}}</a></td>
                                                <td>{{$cartItem->created_at}}</td>
                                                <td> {{ $cartItem->product->price * $cartItem->quantity }}</td>
                                                </tr>
                                                @endforeach
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div><!-- End Recent Sales -->

                    </div>
                </div><!-- End Left side columns -->
            </div>
        </section>

    </main><!-- End #main -->
@endsection
