<?php
$title = "Добавить поставщика";
require_once ROOT."/views/admin/header.php";
?>

<div uk-grid class="max-height">
  <div class="uk-width-1-4">
    <?php
    require_once ROOT."/views/admin/sidebar.php";
    ?>
  </div>
  <div class="uk-width-3-4">
    <h4 class="uk-text-center">Добавить поставщика</h4><hr class="delimiter green">

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
          <div class="uk-form-label">Название:</div>
          <div class="uk-form-controls">
            <input class="uk-input" type="text" placeholder="название..." required name="name">
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-form-label">Телефон:</div>
          <div class="uk-form-controls">
            <input class="uk-input phone" type="text" name="phone" required>
          </div>
        </div>
        <div class="uk-margin">
          <button class="uk-button uk-width-1-1 green-button" name="addSupplier">Добавить</button>
        </div>

      </form>
    </div>

    <h4 class="uk-text-center">Список поставщиков</h4><hr class="delimiter orange">
    <div class="uk-grid-medium uk-child-width-1-2@m" uk-grid>

      <?
      if(count($sup)):
        foreach ($sup as $value):
          ?>
          <div>
            <div class="uk-card uk-card-default max-height uk-flex uk-flex-column uk-text-center">
              <div class="uk-card-body">
                <p><?=$value["name"]?></p>
                <p><?=$value["phone"]?></p>
              </div>
              <div class="uk-card-footer uk-flex uk-flex-column">
                <a name="edit_show" href="#modal-overflow" data-type="edit_supplier" data-id="<?=$value["number"];?>" uk-toggle class="uk-button uk-button-text">
                  <span uk-icon="icon: pencil;"></span>Редактировать
                </a>
                <a href="/admin/supplier/delete/<?=$value["number"]?>" class="uk-margin uk-button uk-button-text">
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
          <?php echo "Нет поставщиков."; ?>
        </div>
        <?
      endif;
      ?>


    </div>
  </div>
  <?php
  require_once ROOT."/views/admin/footer.php";
  ?>
