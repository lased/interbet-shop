<?php
$title = "Корзина";
require_once ROOT."/views/common/header/index.php";
?>

<div class="uk-container content">
  <div class="" uk-grid>

    <div class="uk-width-1-1">

      <?
      if(isset($products)):
        ?>
        <ul class="uk-list uk-list-striped">
          <li>
            <div class="uk-child-width-1-6@m uk-child-width-1-1" uk-grid>

              <div class="uk-width-1-2@m">
                Наименование
              </div>
              <div class="">
                Цена х Кол-во
              </div>
              <div class="">
                Сумма
              </div>
            </div>
          </li>

          <?
          $sum = 0;
          foreach ($products as $key => $value):
            $id = preg_split("~_~", $key)[1];
            $product = product::getProductId($id);
            $stock = stock::getStockId($id);
            $sum += $value[0] * $value[1];
            ?>
            <li>
              <div class="uk-child-width-1-6@m uk-child-width-1-1" uk-grid>

                <div class="">
                  <img src="<?
                  if($product["image"] == "NULL" || !is_file(ROOT.$product["image"])){
                    echo "/public/images/noimage.jpg";
                  }
                  else{
                    echo LINK.$product["image"];
                  }
                  ?>" alt="">
                </div>
                <div class="uk-width-1-3@m">
                  <?=$product["name"]?>
                </div>
                <div class="">
                  <?=$value[1]?> х <input data-id="<?=$id?>" data-price="<?=$value[1]?>" type="number" class="uk-input cart_change_count" min="1" max="<?=$stock["count"]?>" name="count" value="<?=$value[0]?>" style="width: 50px;">
                </div>
                <div class="cart_sum_<?=$id?>">
                  <span><? echo $value[1] * $value[0];?></span> руб.
                </div>
                <div class="">
                  <a href="/cart/delete/<?=$id?>" class="uk-button uk-button-text">
                    <span uk-icon="icon: close;"></span>Удалить
                  </a>
                </div>

              </div>
            </li>
            <?
          endforeach;
          ?>
        </ul>

        <form method="post" class="summary" action="/cart/AddOrder">

          <div class="uk-margin uk-flex uk-flex-right">
            <span style="padding: 5px;">Служба доставки:</span>
            <select class="uk-select uk-width-1-6@m" name="delivery" required="">

              <?
              if (!$delivery):
                ?>
                <option value="">Нет служб доставки</option>
                <?
              else:
                foreach ($delivery as $row): ?>
                <option value="<?=$row["number"]?>"><?=$row["name"]?></option>
                <?
              endforeach;
            endif;
            ?>


          </select>
        </div>
        <div class="uk-flex uk-flex-right">
          <span>Итого: <span id="cart_summary"><?=$sum?></span> руб.</span><br>
        </div>

        <?if (isset($_SESSION["id_user"])): ?>
        <div class="uk-margin uk-flex uk-flex-right">
          <button type="submit" class="uk-button uk-button-primary">
            <span>Оформить заказ</span>
          </button>
        </div>
        <?else: ?>
        <div class="uk-margin uk-flex uk-flex-right">
          <button disabled class="uk-button uk-button-primary">
            <span>Авторизуйтесь перед оформлением заказа</span>
          </button>
        </div>
        <?endif; ?>
      </form>

      <?
    else:
      ?>
      <div class="uk-text-primary">
        <span>Корзина пуста</span>
      </div>
      <?
    endif;
    ?>

  </div>

</div>
</div>

<?php
require_once ROOT."/views/common/footer.php";
?>
