<?php
$title = "Главная страница";
require_once ROOT."/views/common/header/index.php";
?>

<div class="uk-container content">
  <div class="" uk-grid>

    <div class="uk-width-1-4@m">
      <?php
      require_once ROOT."/views/common/category.php";
      ?>
    </div>

    <div class="uk-width-3-4@m">

      <h2 class="uk-text-center"><span>Последние товары</span></h2><hr class="delimiter blue">
      <div class="uk-grid-small uk-flex-center uk-text-center uk-child-width-1-3@m" uk-grid>

        <?
        foreach ($product as $row):
          $stock = stock::getStockId($row["number"]);
          require ROOT."/views/product/cardProduct.php";
        endforeach;
        ?>

      </div>
    </div>

  </div>
</div>


<?php
require_once ROOT."/views/common/footer.php";
?>
