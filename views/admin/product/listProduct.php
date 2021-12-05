<?php
$title = "Список товаров";
require_once ROOT."/views/admin/header.php";
?>

<div uk-grid class="max-height">
  <div class="uk-width-1-4">
    <?php
    require_once ROOT."/views/admin/sidebar.php";
    ?>
  </div>
  <div class="uk-width-3-4">
    <h4 class="uk-text-center">Список товаров</h4><hr class="delimiter green">

    <div class="uk-grid-medium uk-child-width-1-3@m" uk-grid>

      <?
      if(count($product)):
        foreach ($product as $row):
          ?>
          <div>
            <div class="uk-card uk-card-default max-height uk-flex uk-flex-column">
              <div class="uk-card-header uk-flex uk-flex-middle uk-flex-center">
                <img src="<?php
                if($row["image"] == "NULL" || !is_file(ROOT.$row["image"])){
                  echo "/public/images/noimage.jpg";
                }
                else{
                  echo LINK.$row["image"];
                }
                ?>" alt="">
              </div>
              <div class="uk-card-body">
                <p><?echo $row["name"];?></p>
                <p>Код товара: <?=$row["number"]?></p>
                <?
                $property = category::getCategoryProperty($row["name"]);
                $row["description"] = preg_split("~;~", $row["description"]);
                for ($i=0; $i < 3; $i++):?>
                <p><? echo $property[$i].": ".$row["description"][$i]?></p>
                <?
              endfor;
              ?>
              <p>...</p>
            </div>
            <div class="uk-card-footer uk-flex uk-flex-column">
              <a name="edit_show" href="#modal-overflow" data-type="edit_product" data-id="<?=$row["number"];?>" uk-toggle class="uk-button uk-button-text">
                <span uk-icon="icon: pencil;"></span>Редактировать
              </a>
              <a href="/admin/product/delete/<?=$row["number"];?>" class="uk-margin uk-button uk-button-text">
                <span uk-icon="icon: close;"></span>Удалить
              </a>
            </div>
          </div>
        </div>
        <?
      endforeach;
    else:
      ?>
      <div class="uk-margin uk-text-danger">
        <?php echo "Нет товаров."; ?>
      </div>
      <?
    endif;
    ?>

  </div>
</div>
</div>
<?php
require_once ROOT."/views/admin/footer.php";
?>
