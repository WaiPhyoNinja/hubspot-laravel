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
                    @if (Session::has('access_token'))
                    <li class="nav-item p-2 pl-5">
                        <a class="nav-link active" aria-current="page" href="/users">Home</a>
                    </li>
                    <li class="nav-item p-2 pl-5">
                        <a class="nav-link active" aria-current="page" href="/products">Products</a>
                    </li>
                    <li class="nav-item p-2 pl-5">
                    <form id="logout-form" class="m-l" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-none">Logout</button>
                    </form>
                   </li>
                    @else
                    <li class="nav-item p-2 pl-5">
                        <a class="nav-link active" aria-current="page" href="/signup-news">Signup News</a>
                    </li>
                    <li class="nav-item p-2 pl-5">
                        <a class="nav-link active" aria-current="page" href="{{ route('login') }}">Login</a>
                    </li>
                    @endif

                </ul>
            </div>
        </div>
    </nav>
</div>
