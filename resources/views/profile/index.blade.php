@extends("layouts.profile-layout")
@section("meta")
<title>profie {{ $user->name }}</title>
@endsection

@section("body")

@endsection

@section("cover-profile")
{{ url("$user->photo-profile") }}
@endsection

@section("photo-profile")
<img class="img-fluid" src="{{ url("$user->photo-profile") }}" alt="" />
@endsection

@section("user-info")
<!-- user info -->
<div class="d-flex flex-column align-items-center">
  <h1 style="font-size: 1.2rem" class="fw-bold">
    {{ $user->name }}
  </h1>
  <p style="font-size: 1rem" class="user-desc text-muted text-center mb-1">
    {{ $user->bio ?? "no bio" }}
  </p>
</div>
@endsection

@section("posts")
  <h1 class="title-section">posts</h1>
  <div class="division"></div>
  @foreach($posts as $post)
  <div class="postingan clearfix">
    <div class="btn-posting">
      <i class="bi bi-three-dots"></i>
    </div>
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
      <p class="position-absolute text-muted">
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
  </div>
  @endforeach
@endsection
@section("script")
<script src="{{ url('/') }}/js/Script.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
  $(document).ready(function(){
    $(".likeForm").on("submit", function (){
      console.log("sending")
      let formElementIndex = $(".likeForm").index(this)
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
  })
</script>
<script src='//cdn.jsdelivr.net/npm/eruda'></script>
  <script>eruda.init();</script>
@endsection