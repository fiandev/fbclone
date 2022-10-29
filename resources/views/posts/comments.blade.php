@foreach($post->comments as $comment)
 <div class="comment d-flex gap-2">
   <h1 class="username">
     {{ (auth()->user()->id === $comment->author->id) ? "you" : $comment->author->name }}
     </h1>
   <small class="message">{{ filterBadWord($comment->comment) }}</small>
 </div>
 @endforeach