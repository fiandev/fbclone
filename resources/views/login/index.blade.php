@extends("layouts.auth-layout")

@section("body")
  <form class='container' action="" id='form' target='' method='POST'>
      <div class='right-side'>
        <div class='containte'>
        <div class='login-card'>
          @if(session("loginError"))
            <div onclick="this.remove()" class="alert alert-danger" role="alert">
              {{ session("loginError") }}
            </div>
          @endif
          @csrf
          <label for='email'>email :</label>
            <input class='form-input' required id='email' name='email' type='text' placeholder='example@example.com' value='{{ old("email") }}'>
            @error("email")
              <p class="invalid-feedback">
                {{ $message }}
              </p>
            @enderror
            <label for='password'>password :</label>
            <input class='form-input' required name='password' type='password' id='password' placeholder='your password' value=''>
            @error("password")
              <p class="invalid-feedback">
                {{ $message }}
              </p>
            @enderror
            <button name='submit' value='send' type='submit'>login</button>
            <p class="forget-link">has'nt account ? <b><a href="/register">create account!</a></b></p>
        </div>
        <div class='esf'>
        <p>© <year></year> </p>
      </div>
        </div>
      </div>
  </form>
@endsection