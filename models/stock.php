<?

class stock
{
  public static function getStockId($id){
    $db = new db();
    $result = $db->select("*", "stock","number = {$id}");
    $db->close();
    return $result ? $result[0]: false;
  }
  public static function getStockAll(){
    $db = new db();
    $result = $db->select("*", "stock");
    $db->close();
    return $result;
  }
  public static function deleteStock($id){
    $db = new db();
    $db->delete("stock", "number={$id}");
    $db->close();
  }
  public static function updateStock($id,$price, $count){
    $db = new db();
    $db->update("stock", "price='{$price}', count='{$count}'", "number={$id}");
    $db->close();
  }
}
