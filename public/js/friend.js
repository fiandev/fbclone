var teman = 0;
$(document).ready(function() {
  if(teman >= 9){
  $(".seeAll").attr("onclick", `see(${teman})`);
  for (var i = 0; i < 9; i++) {
    let nama = randomAngka(8);
    //teman--;
    $(".list-teman").append(`<div class="teman clearfix" id="${nama}"><div class="photo-profile float-start rounded-circle bg-secondary"><img src="./img/1.jpg" class="profile-img"></div><div class="float-end"><div class="nama-teman"><h6>${nama}</h6><p class="text-muted">1 minggu</p><div class="input-group mt-3"><button class="btn rounded mx-2" type="button" onclick="addFriend('${nama}')">Konfirmasi</button><button class="btn rounded btn2" type="button" onclick="rm('${nama}')">Hapus</button></div></div></div></div>`);
  }
  $(".jumlah-teman").html(teman);
  //alert(teman)
  $("img").on("click", function() {
    let a = this.src;
    $("body").append(`<div style="width:100%;position:fixed;top:0;bottom:0;left:0;right:0;z-index:99999;background-image:url(${a});background-size:cover;background-position:center;" id="gambar"></div>`);
    setTimeout(() => {
      $("#gambar").remove();
    }, 500)
  });
 }else if(teman <= 9 && teman > 0){
     $(".seeAll").attr("onclick", `see(${teman})`);
     for (var i = 0; i < teman; i++) {
       let nama = randomAngka(8);
       //teman--;
       $(".list-teman").append(`<div class="teman clearfix" id="${nama}"><div class="photo-profile float-start rounded-circle bg-secondary"><img src="./img/1.jpg" class="profile-img"></div><div class="float-end"><div class="nama-teman"><h6>${nama}</h6><p class="text-muted">1 minggu</p><div class="input-group mt-3"><button class="btn rounded mx-2" type="button" onclick="addFriend('${nama}')">Konfirmasi</button><button class="btn rounded btn2" type="button" onclick="rm('${nama}')">Hapus</button></div></div></div></div>`);
     }
     $(".jumlah-teman").html(teman);
     //alert(teman)
     $("img").on("click", function() {
       let a = this.src;
       $("body").append(`<div style="width:100%;position:fixed;top:0;bottom:0;left:0;right:0;z-index:99999;background-image:url(${a});background-size:cover;background-position:center;" id="gambar"></div>`);
       setTimeout(() => {
         $("#gambar").remove();
       }, 500)
     });
 }else if(teman == 0){
   $(".list-teman").css("height","500px")
   $(".list-teman").addClass("bg-light")
 }
})
function rm(element){
  $(`#${element}`).remove();
  teman--;
  $(".jumlah-teman").html(teman);
}
function addFriend(name){
  teman--;
  $(".jumlah-teman").html(teman);
  $(`#${name} .input-group`).html("Anda sekarang berteman");
  $(`#${name} .input-group`).addClass("text-muted")
}
function see() {
  $(".seeAll").css("opacity", "0");
  $(".seeAll").addClass("text-muted");
  $(".seeAll").attr("onclick", "");
  $(".seeAll").css("opacity", "1");
  for (let i = 0; i < teman; i++) {
    let nama = randomAngka(8);
    $(".list-teman").append(`<div class="teman clearfix" id="${nama}"><div class="photo-profile float-start rounded-circle bg-secondary"><img src="./img/1.jpg" class="profile-img"></div><div class="float-end"><div class="nama-teman"><h6>${nama}</h6><p class="text-muted">1 minggu</p><div class="input-group mt-3"><button class="btn rounded mx-2" type="button" onclick="addFriend('${nama}')">Konfirmasi</button><button class="btn rounded btn2" type="button" onclick="rm('${nama}')">Hapus</button></div></div></div></div>`);
    // $(".list-teman").append(`<div class="teman clearfix"><div class="photo-profile float-start rounded-circle bg-secondary"><img src="./img/1.jpg" class="profile-img"></div><div class="float-end"><div class="nama-teman"><h6>${nama}</h6><p class="text-muted">1 minggu</p><div class="input-group mt-3"><button class="btn rounded mx-2" type="button">Konfirmasi</button><button class="btn rounded btn2" type="button">Hapus</button></div></div></div></div>`);
  }
  $("img").on("click", function() {
    let a = this.src;
    $("body").append(`<div style="width:100%;position:fixed;top:0;bottom:0;left:0;right:0;z-index:99999;background-image:url(${a});background-size:cover;background-position:center;" id="gambar"></div>`);
    setTimeout(() => {
      $("#gambar").remove();
    }, 500)
  });
}

function randomAngka(param){
  let res = "";
  let numbers = [1,2,3,4,5,6,7,8,9,0];
  for(var i = 0;i < param; i++){
  let number = numbers[Math.floor(Math.random() * numbers.length)];
  res += number;
  }
  return res
}