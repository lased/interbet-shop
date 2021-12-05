<?php
$title = "Список заказов";
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

      <?foreach ($data as $row): ?>
      <div>
        <div class="uk-card uk-card-default max-height uk-flex uk-flex-column">
          <div class="uk-card-body">

            <? foreach ($row as $key => $value):
              $filed_name = ajax::ru_fields_name($key);
              ?>

              <p><?=$filed_name?>: <?
              switch ($key) {
                case "price":
                case "sum":
                echo $value." руб.";
                break;

                default:
                echo $value;
                break;
              }
              ?></p>
              <?
            endforeach;
            ?>

          </div>
          <div class="uk-card-footer uk-text-center uk-flex uk-flex-column">
            <a name="edit_show" href="#modal-overflow" data-type="edit_ordersData" data-id="<?=$row["number"];?>" uk-toggle class="uk-button uk-button-text">
              <span uk-icon="icon: pencil;"></span>Редактировать
            </a>
            <a href="/admin/orderItem/delete/<?=$row["number"];?>" class="uk-margin uk-button uk-button-text">
              <span uk-icon="icon: close;"></span>Удалить
            </a>
          </div>
        </div>
      </div>
      <?endforeach; ?>

    </div>
  </div>
</div>
<?php
require_once ROOT."/views/admin/footer.php";
?>
