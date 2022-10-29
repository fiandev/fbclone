const baseUrl = window.location.origin;
function showComments(slug){
  const url = `${baseUrl}/comments/${slug}`
  $.ajax({
      type: "GET",
      url: url,
      success: function(data)
      {
        let timeNow = new Date().getTime()
        let timeComment = new Date(data.created_at)
        let isNewMessage = Math.floor(timeNow - timeComment)
        console.log(isNewMessage);
        if (isNewMessage <= 3000) {
            $(".comments-field").append(`
              <div class="comment d-flex gap-2">
                 <h1 class="username">${data.author.name}</h1>
                 <small class="message">${data.comment.replace(/<\/?[^>]+(>|$)/g, "")}</small>
               </div>
            `)
          }
        console.log(data)
      },
      error: function (data){
        console.log(data)
        console.log(url);
      }
  });
}