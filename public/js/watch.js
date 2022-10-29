var counter = 0;
function playVid(elemen) {
  var anu = elemen;
  var vid = document.getElementById(`vid${anu}`);
  if(!vid.muted){
    counter = 0;
    vid.pause();
    $(`.btn-${anu}`).toggleClass("opacity-0");
    $(`#vid${anu}`).toggleClass("opacity-0");
    vid.muted=true;
    // $(`#vid${anu}`).removeClass("ada");
  }else{
  counter++;
  $(`#vid${anu}`).toggleClass("opacity-0");
  vid.play();
  vid.muted=false;
  // $(`#vid${anu}`).addClass("ada");
  $(`.btn-${anu}`).toggleClass("opacity-0");
  }
}
// mematikan klik kanan
var message="Function Disabled";
function clickIE() {if (document.all) {(message);return false;}}
function clickNS(e) {if
(document.layers||(document.getElementById&&!document.all)) {
if (e.which==2||e.which==3) {(message);return false;}}}
if (document.layers)
{document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;}
else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;}
document.oncontextmenu=new Function("return false")
