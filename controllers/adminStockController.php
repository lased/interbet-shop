<?

class adminStockController
{
  public function actionAddOnStock(){
    admin::access();
    admin::adminAccess([1,3]);
    if(isset($_POST["addStock"]) || isset($_POST["edit_save"])){
      $id = isset($_POST["edit_save"]) ? trim($_POST["edit_save"]) : "";
      $code = $id != "" ? trim($_POST["number_product"]) : trim($_POST["code"]);
      $price = trim($_POST["price"]);
      $count = trim($_POST["count"]);
      $supplier = trim($_POST["supplier"]);
      $supplier = $supplier == "" ? "NULL": $supplier;

      if($id == ""){
        if(product::getProductId($code)){
          importData::addImportData($code,$count,$price,$supplier);
        }
        else{
          $error = "Данного кода товара нет.";
        }
      }
      else{
        importData::updateImportData($id,$code,$count,$price,$supplier);
      }
      header("Location: /admin/addOnStock");
    }

    $import = importData::getImportAll();
    require_once ROOT."/views/admin/importData/importData.php";
    return true;
  }
  public function actionListStock(){
    admin::access();
    admin::adminAccess([1,3]);
    if(isset($_POST["edit_save"])){
      $id = trim($_POST["edit_save"]);
      $price = trim($_POST["price"]);
      $count = trim($_POST["count"]);
      stock::updateStock($id,$price,$count);
      header("Location: /admin/listStock");
    }
    $stock = stock::getStockAll();
    require_once ROOT."/views/admin/stock/stock.php";
    return true;
  }
  public function actionDeleteStock($id){
    admin::access();
    admin::adminAccess([1,3]);
    stock::deleteStock($id);
    header("Location: /admin/listStock");
  }
  public function actionDeleteImportData($id){
    admin::access();
    admin::adminAccess([1,3]);
    importData::deleteImportData($id);
    header("Location: /admin/addOnStock");
  }
}
