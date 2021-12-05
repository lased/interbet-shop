<?

class adminOrderController
{
  public function actionListOrders(){
    admin::access();
    admin::adminAccess([1,4]);
    if(isset($_POST["edit_save"])){
      $id = trim($_POST["edit_save"]);
      $status = trim($_POST["status"]);
      $delivery = trim($_POST["delivery"]);
      orders::updateOrders($id,$status,$delivery);
      header("Location: /admin/listOrders");
    }

    $orders = orders::getOrdersAll();
    require_once ROOT."/views/admin/order/order.php";
    return true;
  }
  public function actionAddDelivery(){
    admin::access();
    admin::adminAccess([1,4]);
    if (isset($_POST["addDelivery"]) || isset($_POST["edit_save"])) {

      $id = isset($_POST["edit_save"]) ? trim($_POST["edit_save"]) : "";
      $name = $_POST["name"];
      $phone = $_POST["phone"];
      if($id == ""){
        if(delivery::checkDelivery($name)){
          $error = "Даннай служба доставки уже существует.";
        }
        else{
          delivery::addDelivery($name, $phone);

        }
      }
      else{
        delivery::updateDelivery($id,$name,$phone);
      }
      header("Location: /admin/addDelivery");
    }

    $sup = delivery::getDeliveryAll();
    require_once ROOT."/views/admin/order/delivery.php";
    return true;
  }

  public function actionDeleteDelivery($id){
    admin::access();
    admin::adminAccess([1,4]);
    delivery::daleteDelivery($id);
    header("Location: /admin/addDelivery");
    return true;
  }


  public function actionOrderItem($id){
    admin::access();
    admin::adminAccess([1,4]);
    if(isset($_POST["edit_save"])){
      $id = trim($_POST["edit_save"]);
      $number_product = trim($_POST["number_product"]);
      $count = trim($_POST["count"]);
      $url = trim($_SERVER["HTTP_REFERER"]);
      $url = preg_split("~/~", $url);

      $order_data = ordersData::getOrdersDataId($id);
      if($order_data["number_product"] != $number_product){
        $price = stock::getStockId($number_product)["price"];
        ordersData::updateOrdersData($id,$number_product,$count, true, $price);
      }
      else{
        ordersData::updateOrdersData($id,$number_product,$count);
      }
      header("Location: /admin/orderItem/$url[5]");
    }

    $data = ordersData::getOrdersDataAll($id);
    require_once ROOT."/views/admin/order/order_item.php";
    return true;
  }
  public function actionDeleteOrderItem($id){
    admin::access();
    admin::adminAccess([1,4]);
    ordersData::deleteOrdersData($id);
    $url = trim($_SERVER["HTTP_REFERER"]);
    $url = preg_split("~/~", $url);
    header("Location: /admin/orderItem/$url[5]");
    return true;
  }
  public function actionDeleteListOrders($id){
    admin::access();
    admin::adminAccess([1,4]);
    orders::deleteOrders($id);
    header("Location: /admin/listOrders");
    return true;
  }
}
