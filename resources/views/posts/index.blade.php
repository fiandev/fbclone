@extends("layouts.main")

@section("meta")
<title>page</title>
@endsection

@section("body")
<div class="postingan clearfix">
  <div class="btn-posting">•••</div>
  <div class="mx-2 pp-posting-personal d-inline-block">
  <img class="rounded-circle" src="{{ url('/') }}/img/1.jpg" alt="" />
  </div>
  <div class="content">
    <h5 class="fs-5">
      <a href="/profile/{{ $post->author->uid }}">
        {{ (auth()->user()->id == $post->author->id) ? "you" : $post->author->name }}
      </a>
    </h5> 
    <p class="text-muted">{{ $post->created_at->diffForHumans() }}</p>
    <p class="p-posting lead">
      {{ $post->content }}
    </p>
    <div class="rm-contain my-0"></div>
    @if($post->media !== null)
      <img class="post-img" src="{{ url("$post->media") }}" alt="hero" />
    @endif
  </div>
  <div class="coment-top position-relative py-1">
    <span class="suki-count d-flex align-items-center gap-1">
      <span>{{ $post->responses->count() }}</span>
      <i class="bi bi-heart-fill" style="color: red"></i>
    </span>
    <p class="position-absolute text-muted comments-count">
      {{ $post->comments->count() }} komentar
    </p>
  </div>
  <div class="border-b mt-1">
  <div class="nav-3 mt-2 text-center text-muted">
    <div>
      <form class="likeForm" action="/posts/{{ $post->slug }}" method="post" accept-charset="utf-8">
        @csrf
        <button class="btn" type="submit">
          suka
        </button>
      </form>
    </div>
    <div>
      <a href="/posts/{{ $post->slug }}">Komentar</a>
    </div>
    <div>bagikan</div>
  </div>
 </div>
 <div class="comment-container py-2 px-1 d-flex flex-column gap-1">
   <div id="comments-field" class="comments-field">
     @foreach($post->comments as $comment)
     <div class="comment d-flex gap-2">
       <h1 class="username">
         {{ (auth()->user()->id === $comment->author->id) ? "you" : $comment->author->name }}
       </h1>
       <small class="message">{{ filterBadWord($comment->comment) }}</small>
     </div>
     @endforeach
   </div>
   <div class="form-comment-field fixed-bottom bg-light p-2 shadow-lg text-dark">
     <form id="formComment" class="d-flex justify-content-between" method="post" action="/comments/{{ $post->slug }}" accept-charset="utf-8">
       @method("put")
       @csrf
       <div class="make-status">
         <input autocomplete="off" class="form-control @error('comment') is-invalid @enderror" type="text" name="comment" id="commentField" value="" placeholder="write your comment here.." />
       </div>
       <button type="submit" class="btn btn-outline-primary">kirim</button>
     </form>
   </div>
 </div>
</div>
@endsection
@section("script")
<!-- sweetalert -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.19/sweetalert2.css" integrity="sha512-p06JAs/zQhPp/dk821RoSDTtxZ71yaznVju7IHe85CPn9gKpQVzvOXwTkfqCyWRdwo+e6DOkEKOWPmn8VE9Ekg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.19/sweetalert2.min.js" integrity="sha512-8EbzTdONoihxrKJqQUk1W6Z++PXPHexYlmSfizYg7eUqz8NgScujWLqqSdni6SRxx8wS4Z9CQu0eakmPLtq0HA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- end sweetalert -->
<script src="{{ url('/') }}/js/comments.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
  setInterval(function (){
    showComments("{{ $post->slug }}")
  }, 1000)
  $(document).ready(function(){
    let h = $(".form-comment-field").innerHeight()
    let commentField_mb = parseInt($(".comments-field").css("margin-bottom").split("px").join(""))
    $(".comments-field").css("margin-bottom", `${commentField_mb + h}px`)
    $(".likeForm").on("submit", function (){
      console.log("sending")
      let formElementIndex = $(".likeForm").index(this)
      /* ========= */
      
      $.ajax({
          type: "POST",
          url: $(this).attr("action"),
          data: $(this).serialize(),
          success: function(data)
          {
            $(".suki-count span").eq(formElementIndex).html(data.total_responses)
            console.log(data)
          },
          error: function (data){
            console.log(data)
          }
      });
     return false
    })
    $("#formComment").on("submit", function (){
      console.log("sending")
      $.ajax({
          type: "PUT",
          url: $(this).attr("action"),
          data: $(this).serialize(),
          success: function(data)
          {
            $(".comments-field").append(`
              <div class="comment d-flex gap-2">
                 <h1 class="username">${data.by.name}</h1>
                 <small class="message">${data.comment}</small>
               </div>
            `)
            document.querySelector("#commentField").form.reset()
            console.log(data)
          },
          error: function (data){
            Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: res.errors.comment[0],
                  })
            console.log(data)
          }
      });
     return false
    })
    setInterval(function() {
      $('#comments-field').load('/comments/{{ $post->slug }}')
    }, 5000);
  })
</script>
@endsection