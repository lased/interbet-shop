<?php
$title = $product["name"];
require_once ROOT."/views/common/header/index.php";
?>

<div class="uk-container content">
  <div class="uk-child-width-1-1" uk-grid>
    <div>
      <div class="" uk-grid>
        <div class="uk-width-1-3@m">
          <h2><?=$product["name"]?></h2>
          <p>Код товара: <?=$product["number"]?></p>
          <img style="max-width:320px;max-height:300px;" class="uk-width-medium" src="<?php
          if($product["image"] == "NULL" || !is_file(ROOT.$row["image"])){
            echo "/public/images/noimage.jpg";
          }
          else{
            echo LINK.$product["image"];
          }
          ?>" alt="">
        </div>
        <div class="uk-width-1-3@m">
          <p></p>
          <h2 class="bold">
            <? if ($stock["price"]):
              echo $stock["price"]." руб.";
            else:
              echo "Цена не установлена";
            endif;
            ?>
          </h2>
          <p>
            <? if ($stock["count"]):
              echo "В наличии: ".$stock["count"];
            else:
              echo "Нет в наличии";
            endif;
            ?>
          </p>
          <?
          if($stock):
            ?>
            <a data-price="<?=$stock["price"]?>" data-id="<?=$product["number"]?>" class="addToCart uk-button uk-button-primary" href="#modalAddToCart" uk-toggle>
              <span data-price="<?=$stock["price"]?>" data-id="<?=$product["number"]?>">Добавить</span>
            </a>
            <?
          endif;
          ?>
        </div>
        <div class="uk-width-1-3@m uk-flex uk-flex-column uk-flex-middle uk-flex-center">
          <h5 class="bold">Дополнительно:</h5>
          <span>Гарантия: <?=$product["garant"]?> мес.</span>
          <span>Страна: <?=$product["country"]?></span>
        </div>

        <div class="uk-width-1-1">
          <h4>Характеристики:</h4>
          <table class="uk-table uk-table-hover uk-table-divider">
            <tbody>
              <?
              $description = preg_split("~;~", $product["description"]);

              for ($i=0; $i < count($propertyCategory); $i++):
                if($i == 1):
                  ?>
                  <tr>
                    <td class="uk-width-1-2">Бренд</td>
                    <td class="uk-width-1-2"><?=$product["brand"]?></td>
                  </tr>
                  <?
                endif;
                ?>
                <tr>
                  <td class="uk-width-1-2"><?=$propertyCategory[$i]?></td>
                  <td class="uk-width-1-2"><?=$description[$i]?></td>
                </tr>
                <?
              endfor;
              ?>
            </tbody>
          </table>


        </div>

      </div>

    </div>
  </div>
</div>
<?php
require_once ROOT."/views/common/footer.php";
?>
