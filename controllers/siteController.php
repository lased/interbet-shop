<?php

class siteController
{
  public function actionSearch(){
    if(isset($_POST["category"]) && isset($_POST["category"])){
      $category = trim($_POST["category"]);
      $search = trim($_POST["search"]);
      $result = product::productSearch($category, $search);
    }

    require_once ROOT."/views/site/search.php";
    return true;
  }
  public function actionIndex(){
    $limitLastProduct = 9;
    $category = category::getCategoryAll();
    $product = product::getProductLast($limitLastProduct);
    require_once ROOT."/views/site/index.php";
    return true;
  }

  public function actionCategory($id = 0){
    if(!$id){
      $category = category::getCategoryAll();
      require_once ROOT."/views/category/categoryList.php";
    }
    else{
      if(!isset($_POST["button"]) && !isset($_COOKIE["filterProduct"]) || isset($_POST["button"]) && !isset($_POST["CHECKBOX"])){
        if(isset($_COOKIE["filterProduct"])) setcookie("filterProduct", "", time() - 3600, "/");
        $category = category::getCategoryId($id);
        $products = product::getProductCategoryId($id);
      }
      if(isset($_POST["button"]) && isset($_POST["CHECKBOX"])){
        $id_category = trim($_POST["button"]);
        $price = trim($_POST["price"]);
        $checkbox = $_POST["CHECKBOX"];
        setcookie("filterProduct", "", time() - 3600, "/");
        setcookie("filterProduct", json_encode($_POST), time() + 3600, "/");
        $category = category::getCategoryId($id_category);
        $products = product::getFilterProduct($id_category, $price, $checkbox);
      }
      if(isset($_COOKIE["filterProduct"])){
        $decode = json_decode($_COOKIE["filterProduct"], true);
        if($id != $decode["button"]){
          if(isset($_COOKIE["filterProduct"])) setcookie("filterProduct", "", time() - 3600, "/");
          $category = category::getCategoryId($id);
          $products = product::getProductCategoryId($id);
        }
        else{
          $id_category = $decode["button"];
          $price = $decode["price"];
          $checkbox = $decode["CHECKBOX"];
          $category = category::getCategoryId($id_category);
          $products = product::getFilterProduct($id_category, $price, $checkbox);
        }
      }

      if(!count($products)){
        $error = "Нет товаров";
      }
      $categoryProperty = category::getCategoryProperty($category["name"]);
      require_once ROOT."/views/category/categoryId.php";
    }
    return true;
  }

  public function actionProductData($id){
    $product = product::getProductId($id);
    $stock = stock::getStockId($id);
    $propertyCategory = category::getCategoryProperty(category::getCategoryName($product["number_category"])["name"]);
    require_once ROOT."/views/product/productInfo.php";
    return true;
  }

  public function actionCart(){
    if(isset($_COOKIE["shop"]) && $_COOKIE["shop"][0] != "["){
      $products = json_decode($_COOKIE["shop"], true);
    }
    $delivery = delivery::getDeliveryAll();
    require_once ROOT."/views/cart/cart.php";
    return true;
  }

  public function actionDeleteCart($id){
    $products = json_decode($_COOKIE["shop"], true);
    unset($products["product_{$id}"]);
    $products = json_encode($products);
    setcookie("shop", $products, time() + 3600* 24, "/");
    header("Location: /cart");
  }

  public function actionAddOrder(){
    if(!isset($_COOKIE["shop"]) || !$_SESSION["id_user"]){
      header("Location: /");
    }
    $id_delivery = trim($_POST["delivery"]);
    $shop = json_decode($_COOKIE["shop"], true);
    $id_user = $_SESSION["id_user"];

    $id_order = orders::addOrders($id_user, $id_delivery);
    foreach ($shop as $key => $value) {
      $id = preg_split("~_~", $key)[1];
      $count = $value[0];
      $price = $value[1];
      ordersData::addOrdersData($id_order, $id,$count,$price);
    }
    setcookie("shop", "", time() - 3600,  "/");
    require_once ROOT."/views/cart/success.php";
    return true;
  }

}
