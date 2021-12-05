<?

class adminSupplierController
{
  public function actionAddSupplier(){
    admin::access();
    admin::adminAccess([1,3]);
    if(isset($_POST["addSupplier"]) || isset($_POST["edit_save"])){
      $id = isset($_POST["edit_save"]) ? trim($_POST["edit_save"]) : "";
      $name = $_POST["name"];
      $phone = $_POST["phone"];
      if($id == ""){
        if(supplier::checkSupplier($name)){
          $error = "Даннай поставщик уже существует.";
        }
        else{
          supplier::addSupplier($name, $phone);

        }
      }
      else{
        supplier::updateSupplier($id,$name,$phone);
      }
      header("Location: /admin/addSupplier");
    }
    $sup = supplier::listSupplier();

    require_once ROOT."/views/admin/supplier/supplier.php";
    return true;
  }

  public function actionDeleteSupplier($id){
    admin::access();
    admin::adminAccess([1,3]);
    supplier::daleteSupplier($id);
    header("Location: /admin/addSupplier");
    return true;
  }
}
