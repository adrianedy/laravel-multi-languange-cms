<!DOCTYPE html>
<html lang="en">
  <head>
  @include('user.partials.head')
  @yield('head')
  </head>
  <body> 
    <div class="wrapper">
      @include('user.partials.navigation')
      <div class="content-wrapper">
        @yield('content')
      </div>
    </div>
    @include('user.partials.script')
    @yield('script')
  </body>
</html>