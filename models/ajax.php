<?

class ajax
{
  public static function ru_fields_name($name){
    $words = require ROOT."/config/ru_fields_name.php";
    foreach ($words as $key => $value) {
      if($key == $name){
        return $value;
      }
    }
    return false;
  }
  public static function edit_show($id, $name){
    $method = "get".ucfirst($name)."Id";
    $data = $name::$method($id);
    require_once ROOT."/views/ajax/admin_edit.php";
  }

}
