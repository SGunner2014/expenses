<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/home">Accounts</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/home">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/years">Years</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/children">Children</a>
            </li>
        </ul>
        <span class="navbar-text">
            <form action="/logout" method="post">
                @csrf
                <button class="btn btn-sm btn-primary" type="submit">Logout</button>
            </form>
        </span>
    </div>
</nav>