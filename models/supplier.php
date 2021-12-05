<?
class supplier{
  public static function checkSupplier($name){
    $db = new db();
    $result = $db->select("*", "supplier", "name={$name}");
    $db->close();
    return $result ? true : false;
  }
  public static function addSupplier($name, $phone){
    $db = new db();
    $db->insert("supplier", "name, phone", "'{$name}', '{$phone}'");
    $db->close();
  }
  public static function updateSupplier($id,$name, $phone){
    $db = new db();
    $db->update("supplier", "name='{$name}', phone='{$phone}'", "number={$id}");
    $db->close();
  }
  public static function listSupplier(){
    $db = new db();
    $result = $db->select("*", "supplier");
    $db->close();
    return $result;
  }
  public static function daleteSupplier($id){
    $db = new db();
    $db->delete("supplier", "number={$id}");
    $db->close();
  }
  public static function getSupplierId($id){
    $db = new db();
    $result = $db->select("*", "supplier", "number={$id}");
    $db->close();
    return $result ? $result[0]: false;
  }
  public static function getSupplierAll(){
    $db = new db();
    $result = $db->select("*", "supplier");
    $db->close();
    return $result;
  }
}
