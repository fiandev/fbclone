@extends("layouts.main")
@section("style")
<link rel="stylesheet" href="{{ url('/') }}/css/friend.css" type="text/css" media="all" />
@endsection
@section("body")
<div class="bg-light d-flex justify-content-between pb-3 border-bottom border-dark">
  <div class="d-flex flex-column">
    <h1>Teman</h1>
    <div class="pill d-flex gap-2">
      <span style="border-radius: 20px;background-color: lightgrey;" class="py-2 px-2">suggestions</span>
      <span style="border-radius: 20px;background-color: lightgrey;" class="py-2 px-2">your friends</span>
    </div>
  </div>
  <div class="d-flex justify-content-between">
    <div class="top-btn rounded-circle"></div>
  </div>
</div>
<!-- friend requests -->
@if($requestFriendships->count() > 0)
  <div class="d-flex justify-content-between">
    <div class="d-flex gap-1 align-items-center" style="font-size: 1rem">
        <b>friend requests</b>
        <r class="text-danger">{{ $requestFriendships->count() }}</r>
    </div>
  </div>
  <div class="list-teman">
    <!-- teman -->
   @foreach($requestFriendships as $friend)
    <div class="teman  d-flex justify-content-between align-items-center gap-2">
      <div class="photo-profile  rounded-circle bg-secondary">
        <img class="profile-img" src="{{ url('/') }}/img/1.jpg" alt="photo-profile" />
      </div>
      <div class="d-flex justify-content-start">
        <div class="nama-teman d-flex flex-column">
         <h6>
           <a href="/profile/{{ $friend->uid }}">{{ $friend->name }}</a>
         </h6>
         <div class="input-group mt-3 d-flex gap-2">
           <form action="" method="post" accept-charset="utf-8">
             @csrf
             <input type="hidden" name="accUserId" id="accUserId" value="{{ $friend->id }}" />
             <button class="btn rounded mx-2 btn-primary" type="submit">Konfirmasi</button>
             
           </form>
           <form action="" method="post" accept-charset="utf-8">
             @csrf
             <input type="hidden" name="UserIdToBeReject" id="UserIdToBeReject" value="{{ $friend->id }}" />
             <button class="btn rounded btn-danger" type="submit">reject</button>
           </form>
         </div>
        </div>
      </div>
    </div>
   @endforeach
</div>
@endif

<!-- suggestion friends -->
<div class="d-flex justify-content-between border-top border-dark">
  <div class="d-flex gap-1 align-items-center" style="font-size: 1rem">
      <b>suggestion</b>
  </div>
</div>
<div class="list-teman">
   @foreach($suggestion as $friend)
    @if(!isFriend($friend->id) && !isSendFriendRequest($friend->id) && !hasSendRequest($friend->request_friendship))
      <div class="teman d-flex justify-content-between align-items-center gap-2">
        <div class="photo-profile  rounded-circle bg-secondary">
          <img class="profile-img" src="{{ url('/') }}/img/1.jpg" alt="photo-profile" />
        </div>
        <div class="d-flex justify-content-start">
          <div class="nama-teman d-flex flex-column">
           <h6>
             <a href="/profile/{{ $friend->uid }}">{{ $friend->name }}</a>
           </h6>
           <div class="input-group mt-3 d-flex gap-2">
             <form action="" method="post" accept-charset="utf-8">
               @csrf
               <input type="hidden" name="userIdToBeFriend" id="userIdToBeFriend" value="{{ $friend->id }}" />
               <button class="btn rounded mx-2 btn-primary" type="submit">send request</button>
               
             </form>
             <button class="btnDeletebtnSuggestion btn rounded btn-danger" type="button">hapus</button>
           </div>
          </div>
        </div>
      </div>
    @endif
   @endforeach
</div>
@endsection

@section("script")
<script type="text/javascript" charset="utf-8">
  $(".btnDeletebtnSuggestion").on("click", function(){
    $(this).parent().parent().parent().parent().remove()
  })
</script>
@endsection