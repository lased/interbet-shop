<?php

class admin
{
  public static function access(){
    if(!isset($_SESSION["role"])){
      header("Location: /");
    }
    elseif ($_SESSION["role"] == 2) {
      header("Location: /");
    }
  }
  public static function adminAccess($role){
    $k = 0;
    for ($i=0; $i < count($role); $i++) {
      if($_SESSION["role"] == $role[$i]){
        $k++;
      }
    }
    if(!$k){
      header("Location: /admin");
    }
  }
}
