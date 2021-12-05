<?

class orders
{
  public static function addOrders($id, $id_delivery){
    $dbh = new db();
    $dbh->insert("orders", "number_delivery, number_user", "{$id_delivery}, {$id}");
    $id = $dbh::$db->lastInsertId("orders");
    $dbh->close();
    return $id;
  }
  public static function getOrdersAll(){
    $dbh = new db();
    $result = $dbh->select("*", "orders");
    $dbh->close();
    return $result;
  }
  public static function getCountOrders(){
    $dbh = new db();
    $result = $dbh::$db->prepare('SELECT concat(year(date), ".", month(date), ".", day(date)) as date, COUNT(*) as count FROM orders group by concat(year(date), ".", month(date), ".", day(date))');
    $result->execute();
    $dbh->close();
    return $result->fetchAll(PDO::FETCH_ASSOC);;
  }
  public static function getProfitOrders(){
    $dbh = new db();
    $result = $dbh::$db->prepare('SELECT concat(year(o.date), ".", month(o.date), ".", day(o.date)) as date, SUM(od.count * od.price) as profit FROM orders o, orders_data od
    where od.number_orders = o.number
    group by concat(year(o.date), ".", month(o.date), ".", day(o.date))');
    $result->execute();
    $dbh->close();
    return $result->fetchAll(PDO::FETCH_ASSOC);;
  }
  public static function getStatusId($id){
    $db = new db();
    $result = $db->select("*", "status","number = {$id}");
    $db->close();
    return $result ? $result[0]: false;
  }
  public static function getOrdersId($id){
    $db = new db();
    $result = $db->select("*", "orders","number = {$id}");
    $db->close();
    return $result ? $result[0]: false;
  }
  public static function updateOrders($id, $status, $delivery){
    $db = new db();
    $db->update("orders", "number_status={$status},number_delivery={$delivery}", "number={$id}");
    $db->close();
  }
  public static function deleteOrders($id){
    $db = new db();
    $db->delete("orders", "number={$id}");
    $db->close();
  }
  public static function getOrdersIdUser($id){
    $db = new db();
    $result = $db->select("*", "orders","number_user = {$id}");
    $db->close();
    return $result ? $result: false;
  }

}
