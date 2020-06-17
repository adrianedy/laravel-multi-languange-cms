<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
  <a class="navbar-brand" href="{{ route('dashboard.index') }}"><img src="{{ asset('images/logo-putih.png') }}" width="150px" alt=""></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link text-light" href="{{ route('dashboard.index') }}">Dashboard</span></a>
      </li>
    </ul>
    <div class="float-right">
      <a class="btn btn-danger display-xs-block" href="{{ route('logout') }}"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          Sign Out
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
      </form>
    </div>
  </div>
</nav>