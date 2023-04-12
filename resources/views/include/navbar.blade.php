<nav class="navbar navbar-expand-lg navbar-light bg-light px-3">
    <a class="navbar-brand" href="#">
       Charles' Item Store
    </a>
    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav me-auto mt-2 mt-lg-0 ">
            <li class="nav-item px-lg-2">
                <a class="nav-link" href="{{ route('user.home') }}">Home</a>
            </li>
        </ul>
        <hr class="d-block-sm">
        <a href="{{ route('user.logout') }}" class="text-muted">Logout</a>
    </div>
</nav>

