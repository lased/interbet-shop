<?php
$title = "Импорт товара";
require_once ROOT."/views/admin/header.php";
?>

<div uk-grid class="max-height"> 
  <div class="uk-width-1-4">
    <?php
    require_once ROOT."/views/admin/sidebar.php";
    ?>
  </div>
  <div class="uk-width-3-4">
    <h4 class="uk-text-center">Складской учет</h4><hr class="delimiter green">
    <div class="uk-grid-medium uk-child-width-1-3@m" uk-grid>
      <?
      if(count($stock)):
        foreach ($stock as $row):
          ?>
          <div>
            <div class="uk-card uk-card-default max-height uk-flex uk-flex-column">
              <div class="uk-card-body">
                <p>Код товара(номер на складе): <?=$row["number"];?></p>
                <p>Количество: <?=$row["count"]?></p>
                <p>Цена: <?=$row["price"]?></p>
            </div>
            <div class="uk-card-footer uk-flex uk-flex-column">
              <a name="edit_show" href="#modal-overflow" data-type="edit_stock" data-id="<?=$row["number"];?>" uk-toggle class="uk-button uk-button-text">
                <span uk-icon="icon: pencil;"></span>Редактировать
              </a>
              <a href="/admin/stock/delete/<? echo $row["number"];?>" class="uk-margin uk-button uk-button-text">
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
        <?php echo "Нет импортов."; ?>
      </div>
      <?
    endif;
    ?>

  </div>
</div>

<?php
require_once ROOT."/views/admin/footer.php";
?>
