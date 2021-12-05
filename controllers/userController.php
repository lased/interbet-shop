<?php

/**
*
*/
class userController
{

  public function actionLogin(){
    $login = "";
    $password = "";

    if(isset($_POST["submit"])){
      $login =  trim($_POST["login"]);
      $password =  trim($_POST["password"]);
      $error = "";

      $user = user::checkUserData($login,$password);
      if($user == false){
        $error[] = "Неверный логин или пароль.";
      }
      else{
        user::auth($user["id"], $user["role"], isset($_POST["saveme"]));
        header("Location: /");
      }
    }
    require_once ROOT."/views/user/login.php";
    return true;
  }

  public function actionRegistration(){
    $login = "";
    $password = "";
    $email = "";
    $surname = "";
    $name = "";
    $address = "";
    $phone = "";

    if(isset($_POST["submit"])){
      $login =  trim($_POST["login"]);
      $password =  trim($_POST["password"]);
      $email =  trim($_POST["email"]);
      $surname =  trim($_POST["surname"]);
      $name =  trim($_POST["name"]);
      $address =  trim($_POST["address"]);
      $phone =  trim($_POST["phone"]);
      $error = "";

      $user = user::checkUserData($login,$password,$email);
      if($user != false){
        $error[] = "Данный логин или email уже заняты.";
      }
      else{
        user::createUser($login, $email, $name, $surname, $password, $address,$phone);
        $user = user::checkUserData($login,$password);
        user::auth($user["id"], $user["role"], true);
        header("Location: /");
      }
    }
    require_once ROOT."/views/user/registration.php";
    return true;
  }

  public function actionLogout(){
    user::logout();
    header("Location: /");
    return true;
  }

  public function actionProfile(){
    user::accessUser();
    $user = user::userData();

    if(isset($_POST["saveProfile"])){
      $login =  trim($_POST["login"]);
      $password =  trim($_POST["password"]);
      $email =  trim($_POST["email"]);
      $surname =  trim($_POST["surname"]);
      $name =  trim($_POST["name"]);
      $address =  trim($_POST["address"]);
      $phone =  trim($_POST["phone"]);

      user::changeUser($login, $email, $name, $surname, $password,$address,$phone);
      header("Location: /profile");
    }
    $orders = orders::getOrdersIdUser($_SESSION["id_user"]);

    $delete = isset($_COOKIE["deleteProfileOrder"]) ? true : false;
    setcookie("deleteProfileOrder","", time() - 3600, "/");

    require_once ROOT."/views/user/user.php";
    return true;
  }

  public function actionDeleteProfileOrder($id){
    user::accessUser();
    ordersData::deleteOrdersData($id);
    setcookie("deleteProfileOrder", "1", time() + 3600, "/");
    header("Location: /profile");
    return true;
  }

}
