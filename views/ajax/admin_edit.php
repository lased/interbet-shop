<div class="uk-flex uk-flex-center">
  <form class="uk-width-1-1" method="post" id="edit_form_show" enctype="multipart/form-data">

    <?
    foreach ($data as $key => $value):
      $filed_name = self::ru_fields_name($key);
      switch ($key):
        case "description":
        ?>
        <div class="uk-margin">
          <div class="uk-form-label"><?=$filed_name?>:</div>
        </div>
        <?
        $categoryProperty = category::getCategoryProperty(product::getProductId($id)["category_name"]);
        $part_description = preg_split("~;~", $value);
        for ($i=0; $i < count($part_description) ; $i++):
          ?>
          <div class="uk-margin">
            <div class="uk-form-label"><?=$categoryProperty[$i]?>:</div>
            <div class="uk-form-controls">
              <input class="uk-input" type="text" placeholder="<?=$categoryProperty[$i]?>..." name="<?=$i?>" value="<?=$part_description[$i]?>" required>
            </div>
          </div>
          <?
        endfor;
        break;
        case "image":
        ?>
        <div class="uk-margin">
          <div class="uk-form-label"><?=$filed_name?>:</div>
          <img class="uk-width-small" src="<?
          if($value != "")
          echo LINK.$value;
          else
          echo LINK."/public/images/noimage.jpg";
          ?>" alt="">
          <div uk-form-custom="target: true">
            <input type="file" name="upload_file">
            <input class="uk-input uk-form-width-medium" type="text" placeholder="Выбор файла" disabled>
          </div>
        </div>
        <?
        break;
        case "number_supplier":
        case "number_category":
        case "number_delivery":
        case "number_status":
        $model = preg_split("~_~", $key)[1];
        $method = "get".ucfirst($model)."Id";
        $data = $model::$method($value);
        ?>

        <div class="uk-margin">
          <div class="uk-form-label"><?=$filed_name?>:</div>
          <div class="uk-form-controls">
            <select class="uk-select" name="<?=$model?>" id="categoryName">
              <option value="<?=$value?>"><?=$data["name"]?></option>
              <?
              $method = "get".ucfirst($model)."All";
              $data = $model::$method();
              foreach ($data as $row):
                ?>
                <option value="<? echo $row["number"];?>"><?echo $row["name"]?></option>
                <?
              endforeach;
              ?>
            </select>
          </div>
        </div>

        <?
        break;
        default:
        ?>

        <div class="uk-margin">
          <div class="uk-form-label"><?=$filed_name?>:</div>
          <div class="uk-form-controls">
            <?
            switch ($key) {
              case "date":
              case "number":
              case "price":
              case "number_orders":
              case "sum":
              ?>
              <input class="uk-input" type="text" placeholder="<?=$filed_name?>..." name="<?=$key?>" value="<?=$value?>" <?
              if($name != "importData" && $key != "price" || $name != "stock" && $key != "price") echo "disabled";
              ?>>
              <?
              break;

              case "number_user":
              ?>
              <input class="uk-input" type="text" placeholder="<?=$filed_name?>..." name="<?=$key?>" value="<?=$value?>" disabled>

              <?
              break;
              default:
              ?>
              <input class="uk-input <?
              if($key == "phone")
              echo $key;
              ?>" type="text" placeholder="<?=$filed_name?>..." name="<?=$key?>" value="<?=$value?>" required>
              <?
              break;
            }
            ?>

          </div>
        </div>

        <?
        break;
      endswitch;
    endforeach;

    if($name == "category"):
      $categoryProperty = category::getCategoryProperty(category::getCategoryName($id)["name"]);
      for ($i=0; $i < count($categoryProperty); $i++):
        ?>
        <div class="uk-margin">
          <div class="uk-form-controls">
            <input class="uk-input" type="text" placeholder="Название..." name="<?=$i?>" value="<?=$categoryProperty[$i]?>" required>
          </div>
        </div>
        <?
      endfor;
    endif;
    ?>

  </form>

</div>

<script>
if("mask" in $) {
  $(".phone").mask("+7(999)999-99-99", {autoclear: false});
}
</script>
