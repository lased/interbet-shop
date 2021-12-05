<div class="mix" data-order="<?=$stock["price"]?>">
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
      <?
      if($stock):
        ?>
        <b><?=$stock["price"]?> руб.</b>
        <?
      else:
        ?>
        <b>Цена не определена</b>
        <?
      endif;
      ?>
    </div>
    <div class="uk-card-footer uk-flex uk-flex-column">
      <?
      if($stock):
        ?>
        <a data-price="<?=$stock["price"]?>" data-id="<?=$row["number"]?>" class="addToCart uk-button uk-button-primary" href="#modalAddToCart" uk-toggle>
          <span data-price="<?=$stock["price"]?>" data-id="<?=$row["number"]?>">Добавить</span>
        </a>
        <?
      endif;
      ?>
      <a href="/product/<?echo $row["number"];?>" class="uk-margin uk-button uk-button-text">Подробнее</a>
    </div>
  </div>
</div>
