<?
define('ROOT', dirname(dirname( __FILE__ )));

$path = ROOT."/config/category_params.json";
$data = file_get_contents($path);
echo $data;
