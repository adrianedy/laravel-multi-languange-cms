<!DOCTYPE html>
<html lang="en">
  @include('dashboard.partials.head')
  <body> 
    <div class="wrapper">
      @include('dashboard.partials.navigation')
      <div class="content-wrapper">
        @yield('content')
      </div>
    </div>
    @include('dashboard.partials.script')
    @yield('script')
  </body>
</html>