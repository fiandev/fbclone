<?php
use Illuminate\Support\Facades\Storage;

function make_uid($each = 0) {
  $result = "";
  for ($i = 0; $i < $each; $i++) {
     $result .= rand(0, 9);
  }
  return $result;
}

function isFriend($id){
  return ($id) ? auth()->user()->friends->where("id", $id)->first() : false;
}
function isSendFriendRequest($id) {
 return (array_search($id, auth()->user()->request_friendship) !== false) ? true : false;
}
function hasSendRequest($reqFriendship) {
  return in_array(auth()->user()->id, $reqFriendship);
}
function censored($len) {
  $res = "";
  for ($i = 0; $i < $len; $i++) {
     $res .= "*";
  }
  return $res;
}
function getBadwords() {
  $badWords = Storage::get("badwords.txt");
  return explode("\n", $badWords);
}
function filterBadWord($str) {
  /* sentence from comment */
  $sentence = strtolower($str);
  $arr = explode(" ", $sentence);
  $badWords = getBadwords();
  foreach ($arr as $i => $word) {
    foreach ($badWords as $badword) {
      if (strlen($word) === strlen($badword) && strpos($word, $badword) !== false) {
        $cleanWord = str_replace($badword, censored(strlen($word)), $word);
        $arr[$i] = $cleanWord;
      }
    }
  }
  
  /* $arr to $sentence */
  return implode(" ", $arr);
}

function typePostMedia($mimeType, $type) {
  return (stripos($mimeType, $type) !== false) ? true : false;
}
