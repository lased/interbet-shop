<?php
$title = $category["name"];
require_once ROOT."/views/common/header/index.php";
?>

<div class="uk-container content">
  <div class="" uk-grid>
    <div class="uk-width-1-4@m">
      <form method="post">
        <button href="#price" class="uk-button uk-button-default max-width" type="button" uk-toggle="target: #price; animation: uk-animation-slide-top-medium">Цена</button>
        <div id="price" class="uk-card uk-card-default uk-card-body uk-margin-small" hidden>
          <input id="price_range" class="" type="text" name="price" value="0,100000">
        </div>

        <?
        foreach ($categoryProperty as $key => $value):?>
        <button href="#<?=$key?>" class="uk-button uk-button-default max-width" type="button" uk-toggle="target: #<?=$key?>; animation: uk-animation-slide-top-medium"><?=$value?></button>
        <div id="<?=$key?>" class="uk-card uk-card-default uk-card-body uk-margin-small" hidden><?
        $description = product::getLabelAll($category["number"], $key + 1);
        foreach ($description as $k => $row):
          ?>
          <label><input class="uk-checkbox" type="checkbox" name="CHECKBOX[<?=$key?>][]" value="<?=$row["part"]?>" <?
          if(isset($_COOKIE["filterProduct"])){
            $decode = json_decode($_COOKIE["filterProduct"],true);
            if(isset($decode["CHECKBOX"][$key][$k])) echo "checked";
          }
          ?>
          ><?=$row["part"]?></label>
          <?
        endforeach;
        ?></div>
        <?endforeach;?>
        <button class="green-button uk-button max-width" value="<?=$id?>" type="submit" name="button">Показать</button>
      </form>

    </div>

    <div class="uk-width-3-4@m">

      <h2 class="uk-text-center"><span><?echo $category["name"];?></span></h2><hr class="delimiter orange">

      <?
      if(!isset($error)):
        ?>
        <div class="uk-flex uk-flex-right uk-margin">
          <div class="uk-button-group">
            <button class="uk-button uk-button-secondary" type="button" data-sort="order:asc">Цена по возрастанию</button>
            <button class="uk-button uk-button-secondary" type="button" data-sort="order:descending">Цена по убыванию</button>
          </div>

        </div>
        <?
      endif;
      ?>

      <div class="uk-grid-small uk-flex-center uk-text-center uk-child-width-1-3@m" id="sort-container" uk-grid>

        <?
        if(isset($error)):
          ?>
          <div class="uk-margin uk-text-warning">
            <?php echo $error; ?>
          </div>
          <?
        else:
          foreach ($products as $row):
            $stock = stock::getStockId($row["number"]);
            require ROOT."/views/product/cardProduct.php";
          endforeach;
        endif;
        ?>

      </div>
    </div>

  </div>
</div>

<script>
$("#price_range").asRange({
  step: 100,
  min: 0,
  max: 100000,
  value: [0, 100000],
  range: true
});
</script>

<?php
require_once ROOT."/views/common/footer.php";
?>
