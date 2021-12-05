<?
class ordersData{
  public static function addOrdersData($order, $id, $count, $price){
    $dbh = new db();
    $sum = $count * $price;
    $dbh->insert("orders_data", "number_product, number_orders, count, price, sum", "{$id}, {$order}, {$count}, {$price}, {$sum}");
    $dbh->close();
  }
  public static function getOrdersDataId($id){
    $db = new db();
    $result = $db->select("*", "orders_data","number = {$id}");
    $db->close();
    return $result ? $result[0]: false;
  }
  public static function getOrdersDataAll($id){
    $db = new db();
    $result = $db->select("*", "orders_data","number_orders = {$id}");
    $db->close();
    return $result;
  }
  public static function updateOrdersData($id,$number_product,$count, $change_product = false, $price = 0){
    $db = new db();
    if($change_product){
      $db->update("orders_data", "price={$price},sum={$count}*{$price},`count`={$count},number_product={$number_product}", "number={$id}");
    }
    else{
      $db->update("orders_data", "sum={$count}*price,`count`={$count},number_product={$number_product}", "number={$id}");
    }
    $db->close();
  }
  public static function deleteOrdersData($id){
    $db = new db();
    $db->delete("orders_data", "number={$id}");
    $db->close();
  }
}
