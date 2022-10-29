<?php $authFriends = isFriend($user->id); ?>
<?php $receivedRequest = array_search($user->id, auth()->user()->request_friendship) ?>
<?php $requestSended = in_array(auth()->user()->id, $user->request_friendship) ?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield("meta")
    <!-- bootstrap v5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css" type="text/css" media="all" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.2/css/bootstrap.min.css" integrity="sha512-SCpMC7NhtrwHpzwKlE1l6ks0rS+GbMJJpoQw/A742VaxdGcQKqVD8F/y/m9WLOfIPppy7mWIs/kS0bKgSI0Bfw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" type="text/javascript" charset="utf-8"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.2/js/bootstrap.min.js" integrity="sha512-HSNvqjhsAxRPvbSBEdXWlkR9uYmJtUvXEyfAvUzlA0uS5SyFZMZdczgz8oPWTz2NUEBaXkIYL4kdrBJkP66jYA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- my css -->
    <link rel="stylesheet" href="profile.css" type="text/css" media="all" />
    <link rel="stylesheet" href="{{ url('/') }}/css/style.css" type="text/css" media="all" />
    
    <!-- sweetalert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.19/sweetalert2.css" integrity="sha512-p06JAs/zQhPp/dk821RoSDTtxZ71yaznVju7IHe85CPn9gKpQVzvOXwTkfqCyWRdwo+e6DOkEKOWPmn8VE9Ekg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style type="text/css" media="all">
      p {
        margin: 0;
        padding: 0;
      }
      .cover-profile {
        height: 30vh;
        width:100%;
        background-position: center;
        background-size: cover
      }
      .detail-user {
        font-size: 1rem;
        text-transform: capitalize;
      }
      .hobby {
        background-color: lightgrey;
        font-size: .8rem;
      }
      a {
        color: inherit;
      }
      .title-section {
        font-size: 1rem;
        text-transform: capitalize;
      }
      .friend-name {
        font-size: .6rem;
      }
    </style>
  </head>
  <body>
    <!-- container -->
    <div id="container" class="container bg-light overflow-hidden">
      <!-- header -->
      <div class="d-flex justify-content-between align-items-center pt-1 gap-2">
        <button class="btn fw-bold fs-3">
          <a href="{{ url('/') }}">
            <i class="bi bi-arrow-left"></i>
          </a>
        </button>
        <form style="width: 90%" action="" method="get" accept-charset="utf-8">
          <input class="form-control rounded-pill" type="text" name="q" id="searchField" value="" placeholder="search.." />
        </form>
      </div>
      
      <!-- profile card -->
      <div class="container mt-1 pb-3 border-bottom mb-2">
        <div style="height: 40vh" class="cover-profile rounded d-flex align-items-center flex-column position-relative">
          <!--- cover --->
          <div 
          style="background-image: url(@yield('cover-profile'));" 
          class="cover-profile bg-secondary rounded-top rounded-right overflow-hidden">
          </div>
          <!--- Avatar --->
          <div style="width: 10em; height: 10em;border: solid 5px #fff" class="photo-profile bg-info rounded-circle position-absolute bottom-0 overflow-hidden">
            @yield("photo-profile")
          </div>
        </div>
        <!-- user info -->
        @yield("user-info")
        <!-- send message or follow -->
        <div class="d-flex w-100 justify-content-center gap-2 pb-3 border-bottom">
          @if($user->id !== auth()->user()->id )
          <form class="rounded" style="width: 80%" action="{{ url('/friends/') }}" method="post" accept-charset="utf-8">
            @if($receivedRequest !== false)
            <input type="hidden" name="accUserId" id="accUserId" value="{{ $user->id }}" />
            @else
            <input type="hidden" name="userIdToBeFriend" id="userIdToBeFriend" value="{{ $user->id }}" />
            @endif
            @csrf
            <button 
            @if($authFriends || in_array(auth()->user()->id, $user->request_friendship))
            type="button"
            @else
            type="submit"
            @endif
            style="width: 100%" class="btn d-flex align-items-center justify-content-center bg-primary p-2 gap-2 text-light">
              @if($authFriends)
              <i class="bi bi-people"></i>
              {{ "your friend" }}
              @else
               @if($receivedRequest !== false)
                <i class="bi bi-person-plus"></i>
                acc friendship
               @else
                <i class="bi bi-person-plus"></i>
                {{ $requestSended ? "request sended" : "send request" }}
                @endif
              @endif
            </button>
          </form>
          <button class="btn d-flex align-items-center bg-light py-2 px-3">
            <i class="bi bi-chat-left-text-fill"></i>
          </button>
          <button id="moreFeature" tabindex="0" class="popover-dismiss btn d-flex align-items-center bg-light py-2 px-3" role="button" data-toggle="popover" data-trigger="focus">
            <i class="bi bi-three-dots"></i>
          </button>
         @endif
        </div>
        <!-- user detail info -->
        <ul class="w-100 p-0 d-flex flex-column gap-2 my-3">
          @if($user->locate)
          <li class="d-flex gap-2 detail-user align-items-start">
            <i class="bi bi-house-door"></i>
            <p>
              tinggal di <b>{{ $user->locate}}</b>
            </p>
          </li>
          @endif
          @if($user->hometown)
          <li class="d-flex gap-2 detail-user align-items-start">
            <i class="bi bi-geo-alt"></i>
            <p>
              dari <b>{{ $user->hometown }}</b>
            </p>
          </li>
          @endif
          @if($user->workspace)
          <li class="d-flex gap-2 detail-user align-items-start">
            <i class="bi bi-person-workspace"></i>
            <p>
              {{ $user->workspace->position }} in 
             <b>{{ $user->workspace->company }}</b>
            </p>
          </li>
          @endif
          @if($user->education)
          <li class="d-flex gap-2 detail-user align-items-start">
            <i class="bi bi-mortarboard"></i>
            <p>
              {{ $user->education->major }} in 
             <b>{{ $user->education->place }}</b>
            </p>
          </li>
          @endif
          @if($user->relationship)
          <li class="d-flex gap-2 detail-user align-items-start">
            <i class="bi bi-heart-fill"></i>
            <p>
              {{ $user->relationship->status }} with 
             <b>{{ $user->relationship->couple }}</b>
            </p>
          </li>
          @endif
          
          <!-- show more -->
          <li class="d-flex gap-2 detail-user align-items-center">
            <i class="bi bi-three-dots"></i>
            @can("ownerAccount")
            see your about info
            @else
            see {{ $user->name }}'s about info
            @endcan
          </li>
          <!-- hobbies -->
          @if($user->hobbies)
          <li class="d-flex gap-2 detail-user align-items-start">
            @foreach($user->hobbies as $hobby)
              <div class="hobby d-flex gap-1 py-1 px-2 rounded-pill">
                {{ $hobby }}
              </div>
            @endforeach
          </li>
          @endif
          
        </ul>
        @can("ownerAccount")
        <!-- btn edit profile -->
        <button style="background-color: #E7F3FF;" class="btn w-100 d-flex text-primary justify-content-center text-capitalize align-items-center">
          edit profile
        </button>
        @endcan
      </div>
      <div class="friends container">
        <h1 class="title-section">friends</h1>
        <h2 style="font-size: .8rem" class="text-muted friend-count">total friends {{ $user->friends->count() }}</h2>
        <div class="friend-list row d-flex gap-2 justify-content-start">
          @foreach($user->friends as $friend)
          <div class="col-3 friend-items d-flex flex-column align-items-start gap-1">
            <a href="/profile/{{ $friend->uid }}">
              <img style="width: 5em; height: 5em" src="/img/hero2.jpg" class="rounded" alt="{{ $friend->name }}" />
            </a>
            <h1 class="friend-name">
              <a href="/profile/{{ $friend->uid }}">
                {{ $friend->name }}
              </a>
            </h1>
          </div>
          @endforeach
          <div class="division"></div>
        </div>
      </div>
      
      @yield("posts")
      
    </div>
    <!-- sweetalert2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.19/sweetalert2.min.js" integrity="sha512-8EbzTdONoihxrKJqQUk1W6Z++PXPHexYlmSfizYg7eUqz8NgScujWLqqSdni6SRxx8wS4Z9CQu0eakmPLtq0HA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- script -->
    <script type="text/javascript" charset="utf-8">
      $(document).ready(function (){
        
        //$("[data-toggle=popover]").popover();
        $("#moreFeature").popover({
          container: "#container",
          html: true,
          content: function () {
            return `
              <ul class="m-0 p-0 d-flex flex-column gap-2">
              @if($authFriends)
                <li class="dropdown-item" id="btnRemoveFriend">
                    <i class="bi bi-person-dash"></i>
                    delete friend
                  </button>
                </li>
              @endif
              @if($requestSended)
                <li class="dropdown-item" id="btnCancelRequest">
                    <i class="bi bi-person-dash"></i>
                    cancel request
                  </button>
                </li>
              @endif
                <li class="d-flex gap-1 dropdown-item">
                  <i class="bi bi-exclamation-triangle"></i>
                  report
                </li>
                <li class="d-flex gap-1 dropdown-item">
                  <i class="bi bi-dash-circle"></i>
                  block user
                </li>
              </ul>
            `;
          }
        });
        $("#moreFeature").on("shown.bs.popover", function(){
          console.log("popover showed")
          $("#btnRemoveFriend").on("click", function (){
              $.ajax({
                type: "POST",
                url: "/friends/",
                data: {
                  _token: "{{ csrf_token() }}",
                  friendIdToDelete: {{ $user->id }}
                },
                success: function (data){
                  window.location.reload()
                },
                error: function (data){
                  if (data.status !== 200){
                    $(".popover-body").remove()
                    Swal.fire({
                      icon: 'error',
                      title: `oops.. ${data.status}`,
                      text: data.statusText
                    }).then(function (){
                      window.location.reload()
                    })
                  }
                }
              })
            })
          $("#btnCancelRequest").on("click", function (){
              $.ajax({
                type: "POST",
                url: "/friends/",
                data: {
                  _token: "{{ csrf_token() }}",
                  userIdToBeCancel: {{ $user->id }}
                },
                success: function (data){
                  window.location.reload()
                },
                error: function (data){
                  if (data.status !== 200){
                    console.log(data)
                    $(".popover-body").remove()
                    Swal.fire({
                      icon: 'error',
                      title: `oops.. ${data.status}`,
                      text: data.statusText
                    }).then(function (){
                      window.location.reload()
                    })
                  }
                }
              })
            })
        })
      })
    </script>
    <script type="text/javascript" charset="utf-8">
      $(document).ready(function(){
       $('body').find('img[src$="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"]').remove();
      }); 
    </script>
    @yield("script")
  </body>
</html>