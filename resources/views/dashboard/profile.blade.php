@extends('layouts.master')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item  @if (Request::routeIs('userProfile')) active @endif">Profile</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                            <img id="dashboardCardProfileImg"src="{{ Storage::url(auth()->user()->image) }}" alt="Profile"
                                {{-- <img id="dashboardCardProfileImg"src="{{ asset('/dashboard/assets/img/profile-img.jpg') }}" alt="Profile" --}} class="rounded-circle">
                            <h2>{{ auth()->user()->name }}</h2>
                        </div>
                    </div>

                </div>

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link @if (Request::routeIs('userProfile')) active @endif" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">Overview</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                        Profile</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#profile-change-password">Change Password</button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show @if (Request::routeIs('userProfile')) active @endif profile-overview" id="profile-overview">
                                    <h5 class="card-title">Profile Details</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Name</div>
                                        <div class="col-lg-9 col-md-8">{{ auth()->user()->name }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                        <div class="col-lg-9 col-md-8">{{ auth()->user()->full_name }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Role</div>
                                        <div class="col-lg-9 col-md-8">{{ auth()->user()->role }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">{{ auth()->user()->email }}</div>
                                    </div>

                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                    <!-- Profile Edit Form -->

                                    <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                            Image</label>
                                        <div class="col-md-8 col-lg-9">
                                            <img id="dashboardEditProfileImg"
                                                src="{{ Storage::url(auth()->user()->image) }}" alt="Profile">
                                            <div class="pt-2">
                                                <form id="uploadProfileImageForm" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="file" name="image" id="profileImageInput"
                                                        style="display:none;">
                                                    <a href="#" id="uploadNewImage" class="btn btn-primary btn-sm"
                                                        title="Upload new profile image"><i class="bi bi-upload"></i></a>

                                                    <a href="#" class="btn btn-danger btn-sm" id="deleteProfileImage"
                                                        title="Remove my profile image"><i class="bi bi-trash"></i></a>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                    <script>
                                        $(document).ready(function() {
                                            // Upload new profile image
                                            $('#uploadNewImage').click(function(e) {
                                                e.preventDefault();
                                                $('#profileImageInput').click();
                                            });

                                            $('#profileImageInput').change(function(e) {
                                                let fileInput = $('#profileImageInput')[0];
                                                if (fileInput.files && fileInput.files[0]) {
                                                    let formData = new FormData();
                                                    formData.append('image', fileInput.files[0]);
                                                    formData.append('_token', '{{ csrf_token() }}');

                                                    $.ajax({
                                                        url: "{{ route('profile.image.upload') }}",
                                                        type: 'POST',
                                                        data: formData,
                                                        contentType: false,
                                                        processData: false,
                                                        success: function(response) {
                                                            if (response.status === 'success') {
                                                                $('#navProfileImg').attr('src', response.profile_image_url);
                                                                $('#dashboardEditProfileImg').attr('src', response
                                                                    .profile_image_url);
                                                                $('#dashboardCardProfileImg').attr('src', response
                                                                    .profile_image_url);
                                                                // alert('Profile image updated successfully!');
                                                            } else {
                                                                alert('Failed to update profile image.');
                                                            }
                                                        },
                                                        error: function(xhr, status, error) {
                                                            alert('An error occurred while uploading the profile image.');
                                                        }
                                                    });
                                                } else {
                                                    alert('Please select a file.');
                                                }
                                            });

                                            // Delete profile image
                                            $('#deleteProfileImage').click(function(e) {
                                                e.preventDefault();

                                                if (confirm('Are you sure you want to delete your profile image?')) {
                                                    $.ajax({
                                                        url: "{{ route('profile.image.delete') }}",
                                                        type: 'POST',
                                                        data: {
                                                            _token: '{{ csrf_token() }}'
                                                        },
                                                        success: function(response) {
                                                            if (response.status === 'success') {
                                                                // Update the images in both the navbar and dashboard to a default placeholder image
                                                                let defaultImage = response.profile_image_url;
                                                                // alert(defaultImage);
                                                                // Path to a default image
                                                                $('#navProfileImg').attr('src', defaultImage);
                                                                $('#dashboardEditProfileImg').attr('src', defaultImage);
                                                                $('#dashboardCardProfileImg').attr('src', defaultImage);
                                                                // alert('Profile image deleted successfully!');
                                                            } else {
                                                                alert('Failed to delete profile image.');
                                                            }
                                                        },
                                                        error: function(xhr, status, error) {
                                                            alert('An error occurred while deleting the profile image.');
                                                        }
                                                    });
                                                }
                                            });
                                        });
                                    </script>
                                    <form action="{{ route('saveProfileInfo') }}" method="post">
                                        @csrf
                                        <div class="row mb-3">
                                            <label for="Name" class="col-md-4 col-lg-3 col-form-label">Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="name" type="text" class="form-control" id="Name"
                                                    value="{{ auth()->user()->name }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="full_name" type="text" class="form-control" id="fullName"
                                                    value="{{ auth()->user()->full_name }}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="text" class="form-control" id="email"
                                                    value="{{ auth()->user()->email }}">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>

                                    </form><!-- End Profile Edit Form -->

                                </div>

                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <!-- Change Password Form -->
                                    <form action="{{ route('updatePassword') }}" method="POST">
                                        @csrf
                                        <div class="row mb-3">
                                            <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current
                                                Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password" type="password" class="form-control"
                                                    id="currentPassword">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New
                                                Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="new_password" type="password" class="form-control"
                                                    id="newPassword">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter
                                                New Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="new_password_confirmation" type="password" class="form-control"
                                                    id="renewPassword">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Change Password</button>
                                        </div>
                                    </form><!-- End Change Password Form -->

                                </div>

                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>
                </div>
                <div class="text-center">
                    @if (session('message'))
                        {{ session('message') }}
                    @endif
                </div>
            </div>

        </section>

    </main><!-- End #main -->
@endsection
