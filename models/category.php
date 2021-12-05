<?
/**
*
*/
class category
{
  public static function getCategoryAll(){
    $db = new db();
    $result = $db->select("*", "category");
    $db->close();
    return $result;
  }
  public static function addCategory($name, $url){
    $db = new db();
    $db->insert("category", "name,image", "'{$name}', '{$url}'");
    $db->close();
  }
  public static function updateCategory($id, $name, $url){
    $db = new db();
    $db->update("category", "name='{$name}',image='{$url}'", "number={$id}");
    $db->close();
  }
  public static function checkCategory($name){
    $db = new db();
    $result = $db->select("*", "category", "name='{$name}'");
    $db->close();
    return count($result) > 0 ? true : false;
  }
  public static function getCategoryId($id){
    $db = new db();
    $result = $db->select("*", "category", "number={$id}");
    $db->close();
    return $result[0];
  }
  public static function getCategoryName($id){
    $db = new db();
    $result = $db->select("name", "category", "number={$id}");
    $db->close();
    return $result ? $result[0]: false;
  }
  public static function daleteCategory($id){
    $db = new db();
    $result = $db->delete("category", "number={$id}");
    $db->close();
  }
  public static function deleteCategoryParams($name){
    $path = ROOT."/config/category_params.json";
    $data = file_get_contents($path);
    if($data){
      $arr = array();
      $json = json_decode($data, true);
      $k = 0;
      $l = 0;
      foreach ($json as $value) {
        foreach ($value as $key => $val) {
          if(!strcmp($key, $name)){
            $l = 1;
            break;
          }
          $k++;
        }
        if($l) break;
      }
      if(count($json) == 1){
        array_pop($json);
        $arr = $json;
      }
      else{
        $keys = self::getMass($json);
        $values = self::getMass($json, 1);

        for ($i=0; $i < count($values); $i++) {

          if($k != $i){
            array_push($arr, array($keys[$i] => $values[$i]));
          }
        }
      }
      $data = json_encode($arr);
    }
    $file = fopen($path, 'w');
      fwrite($file,$data);
    fclose($file);
  }
  public static function addCategoryParams($name, $params){
    $path = ROOT."/config/category_params.json";
    $data = file_get_contents($path);
    if(!$data){
      $json = array();
      array_push($json,array($name => $params));
      $data = json_encode($json);
    }
    else {
      $json = json_decode($data, true);
      array_push($json,array($name => $params));
      $data = json_encode($json);
    }
    $file = fopen($path, 'w');
    fwrite($file,$data);
    fclose($file);
  }

  private static function getMass($arr, $type = 0){
    $mass = array();
    foreach($arr as $row){
      foreach($row as $key => $value){
        if(!$type){
          array_push($mass, $key);
        }
        else{
          array_push($mass, $value);
        }
      }
    }
    return $mass;
  }

  public static function getCategoryParams(){
    $path = ROOT."/config/category_params.json";
    $data = file_get_contents($path);
    if($data){
      return json_decode($data, true);
    }
    else{
      return false;
    }
  }

  public static function getCategoryProperty($nameCategory){
    $json = self::getCategoryParams();
    $keys = self::getMass($json);
    $values = self::getMass($json, 1);
    $index = 0;

    for ($i=0; $i < count($keys); $i++) {
      if($nameCategory == $keys[$i]){
        $index = $i;
      }
    }
    return $values[$index];
  }
}
