<?

class adminProductController
{
  public function actionAddProduct(){
    admin::access();
    admin::adminAccess([1]);

    if(isset($_POST["addProduct"])){
      $name = trim($_POST["name"]);
      $category = trim($_POST["category"]);
      $brand = trim($_POST["brand"]);
      $garant = trim($_POST["garant"]);
      $country = trim($_POST["country"]);
      $len = count($_POST) - 6;

      if(product::checkProduct($name)){
        $error = "Данный продукт уже существует.";
      }
      else{
        $url="";
        $type_image = $_FILES["upload_file"]["type"];
        if($type_image === "image/jpg" || $type_image === "image/jpeg" || $type_image === "image/png"){
          if(is_uploaded_file($_FILES['upload_file']["tmp_name"])){
            $url = "/public/images/product/".date("d_m_y_H_i_s").str_replace("image/", ".", $type_image);
            move_uploaded_file($_FILES['upload_file']["tmp_name"],ROOT.$url);
          }
          else{
            $error = "Ошибка".$_FILES["upload_file"]["error"];
          }
        }
        else{
          $error = "Неправильный тип";
        }

        $description = '';

        for($i = 0; $i < $len; $i++){
          $description .= trim($_POST["{$i}"]);
          if($i != $len - 1){
            $description .= ";";
          }
        }
        product::addProduct($name,$category,$brand,$description,$country,$garant, $url);
        header("Location: /admin/addProduct");
      }
    }
    elseif(isset($_POST["edit_save"])){

    }

    $category = category::getCategoryAll();
    require_once ROOT."/views/admin/product/addProduct.php";
    return true;
  }

  public function actionDeleteProduct($id)
  {
    admin::access();
    admin::adminAccess([1]);
    $product = product::getProductId($id);
    if($product["image"] != ""){
      unlink(ROOT.$product["image"]);
    }
    product::deleteProduct($id);
    header("Location: /admin/listProduct");
  }

  public function actionListProduct(){
    admin::access();
    admin::adminAccess([1]);

    if(isset($_POST["edit_save"])){
      $id = trim($_POST["edit_save"]);
      $name = trim($_POST["name"]);
      $category = trim($_POST["category"]);
      $brand = trim($_POST["brand"]);
      $garant = trim($_POST["garant"]);
      $country = trim($_POST["country"]);
      $len = count($_POST) - 6;

      $product = product::getProductId($id);
      $url="";
      if($_FILES["upload_file"]["name"] != ""){
        if($product["image"] != "NULL"){
          if(is_file(ROOT.$product["image"])){
            unlink(ROOT.$product["image"]);
          }
        }
        $type_image = $_FILES["upload_file"]["type"];
        if($type_image === "image/jpg" || $type_image === "image/jpeg" || $type_image === "image/png"){
          if(is_uploaded_file($_FILES['upload_file']["tmp_name"])){
            $url = "/public/images/product/".date("d_m_y_H_i_s").str_replace("image/", ".", $type_image);
            move_uploaded_file($_FILES['upload_file']["tmp_name"],ROOT.$url);
          }
        }
      }
      $url = $url != "" ? $url: $product["image"];

      $description = '';

      for($i = 0; $i < $len; $i++){
        $description .= trim($_POST["{$i}"]);
        if($i != $len - 1){
          $description .= ";";
        }
      }
      product::updateProduct($id,$name,$category,$brand,$description,$country,$garant, $url);
      header("Location: /admin/listProduct");
    }
    $product = product::getProductAll();
    require_once ROOT."/views/admin/product/listProduct.php";
    return true;
  }
}
