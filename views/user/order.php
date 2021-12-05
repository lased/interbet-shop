<div class="uk-flex uk-flex-center@s uk-flex-left@m">
  <div class="uk-child-width-1-2@m max-width" uk-grid>
    <?
    if(isset($orders[0]["number"])):
    foreach ($orders as $o):
      $ordersData = ordersData::getOrdersDataAll($o["number"]);
      $status = orders::getStatusId($o["number_status"])["name"];
      $delivery = delivery::getDeliveryId($o["number_delivery"])["name"];

      foreach ($ordersData as $row):
        $product = product::getProductId($row["number_product"]);
        ?>

        <div>
          <div class="uk-card uk-card-default max-height uk-flex uk-flex-column">
            <div class="uk-card-header uk-flex uk-flex-middle uk-flex-center">
              <img src="<?php
              if($product["image"] == "NULL" || !is_file(ROOT.$product["image"])){
                echo "/public/images/noimage.jpg";
              }
              else{
                echo LINK.$product["image"];
              }
              ?>" alt="">
            </div>
            <div class="uk-card-body">
              <p>Заказ <?=$o["number"]?> от <?=$o["date"]?></p>
              <p>Название: <?=$product["name"]?></p>
              <p>Код товара: <?=$product["number"]?></p>
              <p>Количество: <?=$row["count"]?></p>
              <p>Цена: <?=$row["price"]?> руб.</p>
              <p>Сумма: <?=$row["sum"]?> руб.</p>
              <p>Служба доставки: <?=$delivery?></p>
              <p>Статус: <?=$status?></p>
            </div>
            <?if ($o["number_status"] == 4): ?>

            <div class="uk-card-footer uk-flex uk-flex-column">
              <a href="/profile/order/delete/<?=$row["number"];?>" class="uk-margin uk-button uk-button-text">Удалить заказ</a>
            </div>

            <?endif; ?>

          </div>
        </div>

        <?
      endforeach;
      ?>

      <?
    endforeach;
  else:
    echo "NO";
  endif;
    ?>

  </div>
</div>
