<?php
$title = "Категории";
require_once ROOT."/views/admin/header.php";
?>

<div uk-grid class="max-height">
  <div class="uk-width-1-4">
    <?php
    require_once ROOT."/views/admin/sidebar.php";
    ?>
  </div>
  <div class="uk-width-3-4">
    <h4 class="uk-text-center">Добавить категорию</h4><hr class="delimiter green">

    <div class="uk-flex uk-flex-center">
      <form class="uk-width-1-3@s uk-width-2-3" method="post" enctype="multipart/form-data">

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
            <input class="uk-input" type="text" placeholder="название..." required pattern="\D{2,}" name="name">
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-form-label">Картинка:</div>
          <div uk-form-custom="target: true">
            <input type="file" name="upload_file">
            <input class="uk-input uk-form-width-medium" type="text" placeholder="Выбор файла" disabled>
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-form-label">Количество характеристик:</div>
          <div class="uk-form-controls uk-margin">
            <input class="uk-input" id="countData" type="number" min="0" max="20" placeholder="Кол-во..." required>
          </div>
        </div>
        <div class="uk-margin" id="listInput">
          <div class="uk-form-label">Список характеристик:</div>
        </div>

        <button class="uk-button uk-button-danger circle" required id="addInput" type="button">+</button>

        <div class="uk-margin">
          <button class="uk-button uk-width-1-1 green-button" name="addCategory">Добавить</button>
        </div>

      </form>
    </div>

    <h4 class="uk-text-center">Список категорий</h4><hr class="delimiter orange">
    <div class="uk-grid-medium uk-child-width-1-3@m" uk-grid>

      <?
      if(count($category)):
        foreach ($category as $row):
          ?>

          <div>
            <div class="uk-card uk-card-default max-height uk-flex uk-flex-column uk-text-center">
              <div class="uk-card-header uk-flex uk-flex-middle uk-flex-center">
                <img src="<?
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
              </div>
              <div class="uk-card-footer uk-flex uk-flex-column">
                <a name="edit_show" href="#modal-overflow" data-type="edit_category" data-id="<?=$row["number"];?>" uk-toggle class="uk-button uk-button-text">
                  <span uk-icon="icon: pencil;"></span>Редактировать
                </a>
                <a href="/admin/category/delete/<?=$row["number"];?>" class="uk-margin uk-button uk-button-text">
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
          <?php echo "Нет категорий."; ?>
        </div>
        <?
      endif;
      ?>


    </div>
  </div>
  <?php
  require_once ROOT."/views/admin/footer.php";
  ?>
