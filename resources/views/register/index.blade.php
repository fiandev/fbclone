@extends("layouts.auth-layout")

@section("body")
  <form class='container' action="" id='form' target='' method='POST'>
      <div class='right-side'>
        <div class='containte'>
          <div class='login-card'>
           @if(session("successRegister"))
            <div class="alert alert-info" role="alert" onclick="this.remove()">
              {{ session("successRegister") }}
              </div>
            @endif
            @csrf
          <label for='name'>name :</label>
          <input class='form-input' required id='name' name='name' type='text' placeholder='john doe' value='{{ old("name") }}'>
          @error("name")
            <p class="invalid-feedback">
              {{ $message }}
            </p>
          @enderror
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
            <button name='submit' value='send' type='submit'>register</button>
            <p class="forget-link">has an account ? <b><a href="/login">login!</a></b></p>
        </div>
        <div class='esf'>
        <p>© <year></year> </p>
      </div>
        </div>
      </div>
  </form>
@endsection