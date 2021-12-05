<?

class adminCategoryController
{
  public function actionDeleteCategory($id){
    admin::access();
    admin::adminAccess([1]);
    $category = category::getCategoryId($id);
    if($category["image"] != ""){
      unlink(ROOT.$category["image"]);
    }
    category::deleteCategoryParams($category["name"]);
    category::daleteCategory($id);
    header("Location: /admin/category");
    return true;
  }
  public function actionCategory(){
    admin::access();
    admin::adminAccess([1]);
    if(isset($_POST["addCategory"])){
      $name = trim($_POST["name"]);
      if(category::checkCategory($name)){
        $error = "Данная категория уже существует.";
      }
      else{
        $url="";
        $type_image = $_FILES["upload_file"]["type"];
        if($type_image === "image/jpg" || $type_image === "image/jpeg" || $type_image === "image/png"){
          if(is_uploaded_file($_FILES['upload_file']["tmp_name"])){
            $url = "/public/images/category/".date("d_m_y_H_i_s").str_replace("image/", ".", $type_image);
            move_uploaded_file($_FILES['upload_file']["tmp_name"],ROOT.$url);
          }
          else{
            $error = "Ошибка".$_FILES["upload_file"]["error"];
          }
        }
        else{
          $error = "Неправильный тип";
        }
        category::addCategory($name,$url);
        $arr = array();
        for ($i = 0; $i < count($_POST) - 2; $i++) {
          array_push($arr, $_POST["{$i}"]);
        }
        category::addCategoryParams($name, $arr);
        header("Location: /admin/category");
      }
    }
    elseif(isset($_POST["edit_save"])){
      $id = trim($_POST["edit_save"]);
      $name = trim($_POST["name"]);

      $category = category::getCategoryId($id);
      $url="";
      if($_FILES["upload_file"]["name"] != ""){
        if($category["image"] != "NULL"){
          if(is_file(ROOT.$category["image"])){
            unlink(ROOT.$category["image"]);
          }
        }
        $type_image = $_FILES["upload_file"]["type"];
        if($type_image === "image/jpg" || $type_image === "image/jpeg" || $type_image === "image/png"){
          if(is_uploaded_file($_FILES['upload_file']["tmp_name"])){
            $url = "/public/images/category/".date("d_m_y_H_i_s").str_replace("image/", ".", $type_image);
            move_uploaded_file($_FILES['upload_file']["tmp_name"],ROOT.$url);
          }
        }
      }
      $url = $url != "" ? $url: $category["image"];

      $arr = array();
      for ($i = 0; $i < count($_POST) - 2; $i++) {
        array_push($arr, $_POST["{$i}"]);
      }
      category::deleteCategoryParams(category::getCategoryName($id)["name"]);
      category::addCategoryParams($name, $arr);
      category::updateCategory($id,$name,$url);
      header("Location: /admin/category");
    }

    $category = category::getCategoryAll();

    require_once ROOT."/views/admin/product/category.php";
    return true;
  }

}
