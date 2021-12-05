<?
class delivery{
  public static function getDeliveryAll(){
    $dbh = new db();
    $result = $dbh->select("*", "delivery_service");
    $dbh->close();
    return $result;
  }

  public static function checkDelivery($name){
    $db = new db();
    $result = $db->select("*", "delivery_service", "name={$name}");
    $db->close();
    return $result ? true : false;
  }

  public static function addDelivery($name,$phone){
    $db = new db();
    $db->insert("delivery_service", "name, phone", "'{$name}', '{$phone}'");
    $db->close();
  }
  public static function updateDelivery($id,$name,$phone){
    $db = new db();
    $db->update("delivery_service", "name='{$name}', phone='{$phone}'", "number={$id}");
    $db->close();
  }
  public static function daleteDelivery($id){
    $db = new db();
    $db->delete("delivery_service", "number={$id}");
    $db->close();
  }

  public static function getDeliveryId($id){
    $db = new db();
    $result = $db->select("*", "delivery_service", "number={$id}");
    $db->close();
    return $result ? $result[0]: false;
  }
}
