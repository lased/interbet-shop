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
    <h4 class="uk-text-center">Импорт товара</h4><hr class="delimiter green">

    <div class="uk-flex uk-flex-center">
      <form class="uk-width-1-3@s uk-width-2-3" method="post">

        <?php
        if(isset($error)):
          ?>
          <div class="uk-margin uk-text-danger">
            <?php echo $error; ?>
          </div>
          <?php
        endif;
        ?>

        <div class="uk-margin">
          <div class="uk-form-label">Код товара:</div>
          <div class="uk-form-controls">
            <input class="uk-input" type="text" placeholder="Код..." name="code" pattern="[0-9]+" required>
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-form-label">Количество:</div>
          <div class="uk-form-controls">
            <input class="uk-input" type="text" placeholder="Количество..." name="count" pattern="[0-9]+" required>
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-form-label">Цена за шт.:</div>
          <div class="uk-form-controls">
            <input class="uk-input" type="text" placeholder="Цена..." name="price" pattern="[0-9]+" required>
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-form-label">Поставщик:</div>
          <div class="uk-form-controls">
            <select class="uk-select" name="supplier" required>
              <?
              $supplier = supplier::listSupplier();
              foreach ($supplier as $row):
                ?>
                <option value="<? echo $row["number"];?>"><?echo $row["name"]?></option>
                <?
              endforeach;
              ?>
            </select>
          </div>
        </div>
        <div class="uk-margin">
          <button class="uk-button uk-width-1-1 green-button" name="addStock">Добавить</button>
        </div>

      </form>
    </div>

    <h4 class="uk-text-center">Список импортов</h4><hr class="delimiter orange">

    <div class="uk-grid-medium uk-child-width-1-3@m" uk-grid>
      <?
      if(count($import)):
        foreach ($import as $row):
          ?>
          <div>
            <div class="uk-card uk-card-default max-height uk-flex uk-flex-column">
              <div class="uk-card-body">
                <p>Код товара: <?=$row["number_product"];?></p>
                <p>Количество: <?=$row["count"]?></p>
                <p>Цена: <?=$row["price"]?></p>
                <p>Поставщик: <?
                if(!isset($row["number_supplier"])){
                  echo "Неопределен";
                }
                else{
                  echo supplier::getSupplierId($row["number_supplier"])["name"];
                }

                ?></p>
              </div>
              <div class="uk-card-footer uk-text-center uk-flex uk-flex-column">
                <a name="edit_show" href="#modal-overflow" data-type="edit_importData" data-id="<?=$row["number"];?>" uk-toggle class="uk-button uk-button-text">
                  <span uk-icon="icon: pencil;"></span>Редактировать
                </a>
                <a href="/admin/importData/delete/<? echo $row["number"];?>" class="uk-margin uk-button uk-button-text">
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
