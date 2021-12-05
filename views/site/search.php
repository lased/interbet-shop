<?
$title = "Результат поиска";
require_once ROOT."/views/common/header/index.php";
?>

<div class="uk-container content">
  <h3 class="uk-text-center"><span>Результат поиска по запросу "<?if(isset($search)) echo $search;?>"</span></h3><hr class="delimiter blue">
  <div class="uk-child-width-1-3@m" uk-grid>
    <?
    if (isset($result[0])):
      foreach ($result as $row):
        $stock = stock::getStockId($row["number"]);
        require ROOT."/views/product/cardProduct.php";
      endforeach;
      ?>
      <?else: ?>
      <h4 class="uk-text-center"><span>Поиск не дал результатов.</span></h4>
      <?endif; ?>

    </div>
  </div>
  <?
  require_once ROOT."/views/common/footer.php";
  ?>
