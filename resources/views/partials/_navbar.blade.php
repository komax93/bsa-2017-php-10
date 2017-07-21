<!-- Fixed navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('cars.index') }}">Cars Service</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="{{ Request::is('cars') ? "active" : ""}}"><a href="{{ route('cars.index') }}">Cars list</a></li>
                <li class="{{ Request::is('cars/create') ? "active" : ""}}"><a href="{{ route('cars.create') }}">Add</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>