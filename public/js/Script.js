$(document).ready(function(){
 $("#body-container").css("margin-top", $(".navigation").innerHeight() + "px")
 $(".postingan .lead").each(function (i, post){
   $(post).addClass("over-paragraf")
   let text = $(post).text()
   if (text.length > 30) {
     $(post).parent().find(".rm-contain").before(`<p class="readmore fw-bold">readmore...</p>`)
   }
 })
 $(".readmore").on("click", function (){
   $(this).parent().parent().find(".lead").removeClass("over-paragraf")
   $(this).remove()
 })
})