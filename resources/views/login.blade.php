@extends('layouts.layout')
@section('content')

<div id="form-container" class="container mt-5 text-center">
    <div id="hubspot-form-container">
        <div class="card mt-5">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Login</h5>
            </div>
            <div class="card-body">
                <form id="hubspot-contact-form" method="POST" action="{{ route('login.store') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="username" class="col-sm-3 col-form-label text-right">email</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password"  class="col-sm-3 col-form-label text-right">Password</label>
                        <div class="col-sm-9">
                        <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
