<?

if(!defined("ROOT") && !defined("LINK")){
  define('ROOT', dirname(dirname( __FILE__ )));
  define('LINK', "http://".$_SERVER['SERVER_NAME']);
}

//Подключаем БД
include_once ROOT."/components/db.php";

//Подключаем все модели
spl_autoload_register(function ($class) {
    include_once ROOT."/models/".$class.".php";
});

$type = isset($_POST["type"]) ? trim($_POST["type"]) : "";

if($type == "edit_show"){
  $id = trim($_POST["id"]);
  $name = preg_split("~_~", trim($_POST["name"]))[1];
  ajax::edit_show($id, $name);
}
