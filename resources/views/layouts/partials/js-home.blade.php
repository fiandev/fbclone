<script type="text/javascript" charset="utf-8">
  $(document).ready(function (){
    $("#makePost").on("click", function (){
      $("#container").append(`
          <div class="position-fixed p-2 bg-light writePost">
            <form id="publishForm" action="{{ url('/') }}" method="post" enctype="multipart/form-data">
              <div class="d-flex justify-content-between align-items-center border-b py-1 mb-1">
                <p id="makePostCloseBtn" class="d-flex gap-2 align-items-center">
                  <i class="bi bi-arrow-left"></i>
                  buat postingan
                </p>
                <button type="submit" class="border px-3 py-1 d-flex align-items-center my-auto btn-publish">
                  upload
                </button>
              </div>
              <div class="top-menu d-flex align-items-center">
                <img class="rounded-circle pp border" src="{{ url('/') }}/img/1.jpg" />
                <div class="d-flex flex-column">
                  <h1 class="fs-5">{{ auth()->user()->name }}</h1>
                  <div class="d-flex gap-1">
                    <div class="p-1 border">public</div>
                    <div class="p-1 border">album</div>
                  </div>
                </div>
              </div>
              <input id="postMedia" name="media" class="d-none" type="file" />
              @csrf
              <textarea style="height:auto;max-height: 30vh" name="content" id="postCaptionInput" class="input-field bg-light" placeholder="apa yang kamu pikirkan ?"></textarea>
              <div id="preview" class="d-flex"></div>
              <div class="shadow-lg bottom-menu d-flex flex-column gap-1 fixed-bottom bg-light px-2">
                <label for="postMedia" class="d-flex gap-2 menu py-2">
                  <i class="bi bi-images"></i>
                  foto/video
                </label>
                <div class="d-flex gap-2 menu py-2">
                  <i class="bi bi-images"></i>
                  tandai orang
                </div>
                <div class="d-flex gap-2 menu py-2">
                  <i class="bi bi-images"></i>
                  perasaan/aktivitas
                </div>
                <div class="d-flex gap-2 menu py-2">
                  <i class="bi bi-images"></i>
                  singgah
                </div>
              </div>
            </form>
          </div>
      `)
      $("#postCaptionInput").focus()
      $("#makePostCloseBtn").on("click", function (){
        $(".writePost").remove()
      })
      $("#publishForm").on("submit", function(){
        let content = $("#postCaptionInput").val()
        if(content == "") {
          $(".alert").remove()
          $(this).before(`
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              input field can't null, please fill it!
              <button onclick="this.parentElement.remove()" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          `);
        return false
        }
      })
      $("#postMedia").on("change", function (event){
        var files = event.target.files,
                    file;
       if (files && files.length > 0) {
         file = files[0];
         try {
           var fileReader = new FileReader();
           var extension = file.name.split('.').pop().toLowerCase();
           fileReader.onload = function (e) {
             $("#image-preview").remove()
             if (isImage(extension)) {
               $("#preview").append(`
                  <img id="image-preview" src="${e.target.result}" style="max-height:8rem;max-width:8rem;overflow:hidden">
               `)
             }
             if (isVideo(extension)) {
               $("#preview").append(`
                <video controls id="image-preview" src="${e.target.result}" controlsList="nodownload">
                  browser not supported video
                 </video>
               `)
             }
             //console.log(e.target.result);
           };
           fileReader.readAsDataURL(file);
         } catch (e) {
           console.log("FileReader are not supported ");
           console.error(e)
         }
       }
       else {
         $("#image-preview").remove()
       }
      })
    })
    
  })
  
  
  function isVideo(extension) {
    const videoExtensions = ["mp4", "mov"]
    return videoExtensions.includes(extension) 
  }
  function isImage(extension) {
    const imageExtension = ["jpg", "jpeg", "webp", "png"]
    return imageExtension.includes(extension)
  }
</script>