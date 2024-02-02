<!doctype html>
<html>
<head>
    <title>Sign Up News</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Bootstrap 5 Include -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!--Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Jquery Include-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--Datatable Include-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
</head>
<style>
    /* Center the form container */
</style>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<body>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="/users">Hubspot Integration</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto ml-lg-5 mb-lg-0">
                        <li class="nav-item p-2 pl-5">
                            <a class="nav-link active" aria-current="page" href="/users">Home</a>
                        </li>
                        <li class="nav-item p-2 pl-5">
                            <a class="nav-link active" aria-current="page" href="/signup-news">Signup News</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div id="form-container" class="container mt-5 text-center">
        <!-- Embeded Sign Up HubSpot form code here -->
        {{-- <a href="{{ route('hubspot.login') }}">Login with HubSpot</a> --}}

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
</body>
</html>
