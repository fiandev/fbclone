@extends("layouts.main")
@section("meta")
<title>page</title>
@endsection


@section("second-menu")
@include("layouts.partials.makeStatus")
@include("layouts.partials.secondMenu")
@endsection

@section("story")
@include("layouts.partials.story")
@endsection

@section("body")
@if(session("success"))
  <div class="alert alert-primary alert-dismissible fade show" role="alert">
    {{ session("success") }}
    <button onclick="this.parentElement.remove()" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
@foreach($posts as $post)
<div class="division"></div>
<div class="postingan clearfix">
  <div class="btn-posting">•••</div>
  <div class="mx-2 pp-posting-personal d-inline-block">
  <img class="rounded-circle" src="{{ url('/') }}/img/1.jpg" alt="" />
  </div>
  <div class="content">
    <h5 class="fs-5 mb-2">
      <a href="/profile/{{ $post->author->uid }}">
        {{ (auth()->user()->id == $post->author->id) ? "you" : $post->author->name }}
        @if(isFriend($post->author->id))
          <i style="font-size: .8rem" class="bi bi-people"></i>
        @endif
        </a>
    </h5>
    <p class="text-muted">{{ $post->created_at->diffForHumans() }}</p>
    <p class="p-posting lead">
      {{ $post->content }}
    </p>
    <div class="rm-contain my-0"></div>
    @if($post->media != null)
      @if(typePostMedia($post->mediaType, "image"))
        <img class="post-media" src="{{ url($post->media) }}" alt="hero" />
      @endif
      @if(typePostMedia($post->mediaType, "video"))
        <video src="{{ url($post->media) }}" class="post-media" controls controlsList="nodownload"></video>
      @endif
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
  <div class="border-b">
  <div class="nav-3 my-2 text-center text-muted">
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
@include("layouts.partials.js-home")
@endsection