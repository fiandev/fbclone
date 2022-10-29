
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registrasion</title>
    <link rel="shortcut icon" href="" type="image/x-icon" />
    <link rel="stylesheet" href="/css/login.css">
</head>
<body>
  <!-- body -->
  @yield("body")
  <script src="../jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf-8">
      let form = document.querySelector("#form"),
      checkBox = document.querySelector("#checkbox_remeberMe"),
      year_footer = document.querySelector("year");
      form.addEventListener("change",function(){
        if(checkBox.checked == true){
          form.target = "";
        } else {
          null
        }
      })
      year_footer.innerHTML=new Date().getFullYear();
    </script>
    <script type="text/javascript" charset="utf-8">
      $(document).ready(function(){
       $('body').find('img[src$="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"]').remove();
      }); 
    </script>
</body>
</html>