<?
/**
 *
 */
class importData
{
  public static function getImportDataId($id){
    $db = new db();
    $result = $db->select("*", "import_data", "number={$id}");
    $db->close();
    return $result ? $result[0]: false;
  }
  public static function getImportAll(){
    $db = new db();
    $result = $db->select("*", "import_data");
    $db->close();
    return $result;
  }
  public static function addImportData($code, $count, $price, $supplier){
    $db = new db();
    $db->insert("import_data", "number_supplier, number_product,count,price","{$supplier},{$code},{$count},{$price}");
    $db->close();
  }
  public static function updateImportData($id,$code, $count, $price, $supplier){
    $db = new db();
    $db->update("import_data", "number_supplier={$supplier}, number_product={$code},count={$count},price={$price}", "number={$id}");
    $db->close();
  }
  public static function deleteImportData($id){
    $db = new db();
    $db->delete("import_data", "number={$id}");
    $db->close();
  }
}
