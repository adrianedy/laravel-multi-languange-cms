<nav class="navbar navbar-expand-lg navbar-dark bg-warning">
  <a class="navbar-brand" href="{{ route('index') }}"><img src="{{ url('images/user/company-logo/logo-blue.png') }}" width="150px" alt=""></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    </ul>
    <div class="float-right">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-light" href="#" id="flagDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @if (App::getLocale() == 'en')
            <img class="img-fluid" width="20" src="{{ asset('images/user/icons/flag-united-kingdom.svg') }}" alt="flag united kingdom">
            @elseif ((App::getLocale() == 'id'))
            <img class="img-fluid" width="20" src="{{ asset('images/user/icons/flag-indonesia.svg') }}" alt="flag indonesia">
            @endif
          </a>
          <div class="dropdown-menu text-center" style="min-width: auto" aria-labelledby="navbarDropdown">
            @if (App::getLocale() == 'en')
            <a href="{{ route('set-locale', 'id') }}" class="nav-link">
              <img class="img-fluid" width="20" src="{{ asset('images/user/icons/flag-indonesia.svg') }}" alt="flag united kingdom">
            </a>
            @elseif ((App::getLocale() == 'id'))
            <a href="{{ route('set-locale', 'en') }}" class="nav-link">
              <img class="img-fluid" width="20px" src="{{ asset('images/user/icons/flag-united-kingdom.svg') }}" alt="flag indonesia">
            </a>
            @endif
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>