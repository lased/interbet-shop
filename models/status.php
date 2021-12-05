<?
class status{
  public static function getStatusAll(){
    $dbh = new db();
    $result = $dbh->select("*", "status");
    $dbh->close();
    return $result;
  }
  public static function getStatusId($id){
    $db = new db();
    $result = $db->select("*", "status","number = {$id}");
    $db->close();
    return $result ? $result[0]: false;
  }
}
