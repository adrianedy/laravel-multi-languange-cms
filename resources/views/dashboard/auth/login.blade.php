<!DOCTYPE html>
<html lang="en">
  @include('dashboard.partials.head')
  <body>
    <div>
      <img src='{{ asset('images/background.jpg') }}' style='position:fixed;top:0px;left:0px;width:100%;height:100%;z-index:-1;'>    
      <div class="container">
        <div class="row">
          <div class="col-sm-9 col-md-7 col-lg-5 mx-auto" style="margin-top:80px">
            <div class="card my-5 p-2 text-center">
              <form action="{{ route('login') }}" method="post">
                @csrf
                <div> 
                  <h2 class="mt-3 mb-4"> 
                    <span>Admin Login</span>
                  </h2>
                </div>
                @foreach($errors->all() as $error)
                <span class="text-danger">
                    <strong>{{ $error }}</strong>
                </span>
                @endforeach
                <div class="form-group">
                  <input type="text" class="form-control" name="email" placeholder="Username" value="{{ old('email') }}" required autofocus>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn">Login</button>
              </form>
            </div>   
          </div>
        </div>
      </div>   
    </div>
    
    @include('dashboard.partials.script')
  </body>
</html>