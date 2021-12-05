<?php

class adminController
{
  public function actionIndex(){
    admin::access();
    require_once ROOT."/views/admin/index.php";
    return true;
  }
}
