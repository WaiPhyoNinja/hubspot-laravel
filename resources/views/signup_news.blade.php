@extends('layouts.layout')
@section('content')
<div id="form-container" class="container mt-5 text-center">
    <a href="{{ route('auth.login') }}">Login with HubSpot</a>

    <!-- End Here -->
    <div id="hubspot-form-container">
        <div class="card mt-5">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Enter Details</h5>
            </div>
            <div class="card-body">
                <form id="hubspot-contact-form" method="POST" action="{{ route('store.user') }}">
                    @csrf <!-- Add CSRF token for security -->
                    <div class="form-group row">
                        <label for="firstname" class="col-sm-3 col-form-label text-right">First Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="firstname" name="firstname" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="lastname"  class="col-sm-3 col-form-label text-right">Last Name</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="lastname" name="lastname" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email"  class="col-sm-3 col-form-label text-right">Email Address</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-3 col-form-label text-right">Phone Number</label>
                        <div class="col-sm-9">
                            <input type="tel" class="form-control" id="phone" name="phone">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
