<?php

class user
{
  public static function getUserAll(){
    $dbh = new db();
    $result = $dbh->select("*", "user");
    $dbh->close();
    return $result;
  }
  public static function getUserId($id){
    $db = new db();
    $result = $db->select("*", "user","id = {$id}");
    $db->close();
    return $result ? $result[0]: false;
  }
  public static function checkUserData($login, $password, $email = false){
    $db = new db();
    if($email){
      $result = $db->select("*", "user", "login = '{$login}' or email = '{$email}'");
    }
    else{
      $result = $db->select("*", "user", "login = '{$login}' and password = '{$password}'");
    }
    $db->close();
    return $result ? $result[0]: false;
  }

  public static function changeUser($login, $email, $name, $surname, $password, $address, $phone){
    $db = new db();
    $db->update("user", "address='{$address}', phone='{$phone}', login='{$login}',email='{$email}',name='{$name}',surname='{$surname}',password='{$password}'", "id={$_SESSION["id_user"]}");
    $db->close();
  }

  public static function accessUser(){
    if(!isset($_SESSION["id_user"])){
      header("Location: /user/login");
    }
  }

  public static function userData(){
    if($_SESSION["id_user"] != ""){
      $db = new db();
      $result = $db->select("*", "user", "id={$_SESSION["id_user"]}");
      $db->close();
      return $result;
    }
    else{
      return false;
    }
  }

  public static function auth($id_user, $role, $saveme = false){
    $_SESSION["id_user"] = $id_user;
    $_SESSION["role"] = $role;
    if($saveme){
      setcookie("id_user", $id_user, time() + 3600 * 24 * 7);
      setcookie("role", $role, time() + 3600 * 24 * 7);
    }
  }

  public static function logout(){
    unset($_SESSION["id_user"], $_SESSION["role"]);
    setcookie("id_user", "", time() - 3600);
    setcookie("role", "", time() - 3600);
  }

  public static function createUser($login, $email, $name, $surname, $password, $address, $phone){
    $db = new db();
    $db->insert("user", "login,email,name,surname,password, address, phone", "'{$login}', '{$email}', '{$name}', '{$surname}', '{$password}', '{$address}', '{$phone}'");
    $db->close();
    return true;
  }
}
