<?

class product
{
  public static function stringData($arr)
  {
    $str = "";
    for ($i = 0; $i < count($arr); $i++) {
      $str .= "'{$arr[$i]}'";
      if ($i != count($arr) - 1) {
        $str .= ",";
      }
    }
    return $str;
  }
  public static function getFilterProduct($id_category, $price, $params)
  {
    $db = new db();
    $price = preg_split("~,~", $price);
    $query = "p.number = s.number AND s.price BETWEEN {$price[0]} AND {$price[1]} AND ";
    $end = 0;
    foreach ($params as $key => $value) {
      $data = self::stringData($value);
      $col = $key + 1;
      $query .= "SPLIT_STRING(p.description, ';', {$col}) IN({$data})";
      if (count($params) != $end + 1) $query .= " AND ";
      $end++;
    }
    $result = $db->select("p.*", "product p, stock s", $query);
    $db->close();
    return $result;
  }
  public static function getLabelAll($id, $key)
  {
    $db = new db();
    $result = $db->select("DISTINCT SPLIT_STRING(`description`, ';', {$key}) as part", "product", "number_category={$id}");
    $db->close();
    return $result;
  }
  public static function checkProduct($name)
  {
    $db = new db();
    $result = $db->select("*", "product", "name={$name}");
    $db->close();
    return $result ? true : false;
  }
  public static function addProduct($name, $category, $brand, $description, $country, $garant, $url)
  {
    $db = new db();
    $db->insert("product", "name,number_category,brand,description,country,garant,image", "'{$name}',{$category},'{$brand}','{$description}','{$country}',{$garant},'{$url}'");
    $db->close();
  }
  public static function updateProduct($id, $name, $category, $brand, $description, $country, $garant, $url)
  {
    $db = new db();
    $db->update("product", "name='{$name}',number_category={$category},brand='{$brand}',description='{$description}',country='{$country}',garant={$garant},image='{$url}'", "number={$id}");
    $db->close();
  }
  public static function deleteProduct($id)
  {
    $db = new db();
    $db->delete("product", "number={$id}");
    $db->close();
  }
  public static function productSearch($category, $name)
  {
    $db = new db();
    if ($category == "") {
      $result = $db->select("*", "product", "name LIKE '%{$name}%'");
    } else {
      $result = $db->select("*", "product", "name LIKE '%{$name}%' and number_category = {$category}");
    }

    $db->close();
    return $result ? $result : false;
  }
  public static function getProductName($name)
  {
    $db = new db();
    $result = $db->select("id", "product", "name = '{$name}'");
    $db->close();
    return $result ? $result[0] : false;
  }
  public static function getProductAll()
  {
    $db = new db();
    $result = $db->select("p.*, c.name as category_name", "product p, category c", "c.number = p.number_category");
    $db->close();
    return $result;
  }
  public static function getProductLast($limit)
  {
    $db = new db();
    $result = $db->select("*", "product", 1, 1, $limit);
    $db->close();
    return $result;
  }
  public static function getProductCategoryId($id)
  {
    $db = new db();
    $result = $db->select("p.*, c.name as category_name", "product p, category c", "c.number = p.number_category and p.number_category={$id}");
    $db->close();
    return $result;
  }
  public static function getProductId($id)
  {
    $db = new db();
    $result = $db->select("*", "product", "number = {$id}");
    $db->close();
    return $result ? $result[0] : false;
  }
}
