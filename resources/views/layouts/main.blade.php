<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield("meta")
    <!-- bootstrap v5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" type="text/css" media="all" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css" type="text/css" media="all" />
    <link rel="stylesheet" href="{{ url('/') }}/framework/bootstrap.min.css" type="text/css" media="all" />
    <script src="{{ url('/') }}/framework/bootstrap.bundle.min.js" type="text/javascript" charset="utf-8"></script>
    <!-- my css -->
    <link rel="stylesheet" href="{{ url('/') }}/css/style.css" type="text/css" media="all" />
    @yield("style")
  </head>
  <body>
    <!-- container utama -->
    <div id="container" class="container pt-2 pb-2 bg-light overflow-hidden">
      <div class="fixed-top bg-light px-2 pt-1 navigation">
        <div class="header d-flex justify-content-between">
          <!-- logo Facebook -->
          <h1 class="d-inline-block"><a class="logo-product" href="{{ url('/') }}">{{ env("BRAND_NAME", auth()->user()->name ) }}</a></h1>
          <div class="d-flex">
            <!-- logo searching -->
            <div class="top-btn rounded-circle">
              
            </div>
            <!-- logo logout default messager -->
            <div class="top-btn rounded-circle d-flex justify-content-center align-items-center">
              <form class="" action="/logout/" method="post" accept-charset="utf-8">
                @csrf
                <button class="btn" type="submit">
                  <i class="bi bi-box-arrow-right"></i>
                </button>
              </form>
            </div>
          </div>
        </div>
        <!-- navigasi utama -->
        <nav class="mynav bg-light">
          <ul class="cf mx-auto px-0">
            <li class="{{ ( Request::is("/") || Request::is("posts/*") ) ? "nav-active" : ""}}">
              <a href="/">
                <i class="bi bi-house-door-fill"></i>
              </a>
            </li>
            <li class="{{ ( Request::is("friends") ) ? "nav-active" : ""}}">
              <a href="/friends/">
                <i class="bi bi-people"></i>
              </a>
            </li>
            <li class="{{ Request::is("/watch/*") ? "nav-active" : ""}}">
              <a href="/watch/">
                <i class="bi bi-play-btn"></i>
              </a>
            </li>
            <li>
              <a href="G">
                <i class="bi bi-controller"></i>
              </a>
            </li>
            <li >
              <a href="N">
                <i class="bi bi-bell"></i>
              </a>
            </li>
            <li>
              <a href="=">
                <i class="bi bi-list"></i>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    <div id="body-container">
    <!-- make status & menu kedua -->
     @yield("second-menu")
        
     @yield("story")
    <!-- postingan -->
      @yield("body")
    </div>
    <!-- akhir container -->
    </div>
    <!-- jQuery -->
    <script src="{{ url('/') }}/framework/jquery-3.6.0.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="{{ url('/') }}/js/Script.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
    </script>
    <script type="text/javascript" charset="utf-8">
      $(document).ready(function(){
       $('body').find('img[src$="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"]').remove();
      }); 
    </script>
    <!-- my script -->
    @yield("script")
  </body>
</html>