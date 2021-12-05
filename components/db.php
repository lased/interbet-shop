<?php

class db{
  public static $db = null;

  public function __construct(){
    $paramsPath = ROOT."/config/db_params.php";
    $params = require($paramsPath);
    $dsn = "mysql:host={$params["host"]};dbname={$params["dbname"]}";
    self::$db = new PDO($dsn, $params["user"], $params["password"]);
  }

  public function close(){
    if(self::$db){
      self::$db = null;
    }
  }

  public function select($what, $from, $where = 1, $order = 1, $limit = 0){
    if($limit){
      $arr = self::$db->prepare('SELECT '.$what.' FROM '.$from.' WHERE '.$where.' ORDER BY '.$order.' LIMIT '.$limit);
    }
    else{
      $arr = self::$db->prepare('SELECT '.$what.' FROM '.$from.' WHERE '.$where.' ORDER BY '.$order);
    }
    $arr->execute();
    return $arr->fetchAll(PDO::FETCH_ASSOC);
  }

  public function delete($from, $where = 1){
    $arr = self::$db->prepare('DELETE FROM '.$from.' WHERE '.$where);
    $arr->execute();
    return $arr;
  }

  public function update($table, $what, $where = 1){
    $arr = self::$db->prepare('UPDATE '.$table.' SET '.$what.' WHERE '.$where);
    $arr->execute();
    return $arr;
  }

  public function insert($table, $what, $value){
    $arr = self::$db->prepare('INSERT INTO '.$table.'('.$what.') VALUES('.$value.');');
    $arr->execute();
    return $arr;
  }
}
