<?php
$title = "Добавить товар";
require_once ROOT."/views/admin/header.php";
?>

<div uk-grid class="max-height">
  <div class="uk-width-1-4">
    <?php
    require_once ROOT."/views/admin/sidebar.php";
    ?>
  </div>
  <div class="uk-width-3-4">
    <h4 class="uk-text-center">Добавить товар</h4><hr class="delimiter green">

    <div class="uk-flex uk-flex-center">
      <form class="uk-width-1-3@s uk-width-2-3" method="post" enctype="multipart/form-data">

        <?php
        if(isset($error)):
          foreach ($error as $value):
            ?>
            <div class="uk-margin uk-text-danger">
              <?php echo $value; ?>
            </div>
            <?php
          endforeach;
        endif;
        ?>
        <div class="uk-margin">
          <div class="uk-form-label">Картинка:</div>
          <div uk-form-custom="target: true">
            <input type="file" name="upload_file" required>
            <input class="uk-input uk-form-width-medium" type="text" placeholder="Выбор файла" disabled>
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-form-label">Название:</div>
          <div class="uk-form-controls">
            <input class="uk-input" type="text" placeholder="Название..." required pattern="[\S\s]{2,}" name="name">
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-form-label">Категория:</div>
          <div class="uk-form-controls">
            <select class="uk-select" name="category" id="categoryName">
              <?
              foreach ($category as $row):
                ?>
                <option value="<? echo $row["number"];?>"><?echo $row["name"]?></option>
                <?
              endforeach;
              ?>
            </select>
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-form-label">Бренд:</div>
          <div class="uk-form-controls">
            <input class="uk-input" type="text" placeholder="Бренд..." required pattern="\D{2,}" name="brand">
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-form-label">Гарантия(в месяцах):</div>
          <div class="uk-form-controls">
            <input class="uk-input" type="text" placeholder="Гарантия..." required pattern="\d{1,}" name="garant">
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-form-label">Страна-производитель:</div>
          <div class="uk-form-controls">
            <input class="uk-input" type="text" placeholder="Страна..." required pattern="\D{2,}" name="country">
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-form-label">Характеристики:</div>
        </div>

        <div class="uk-margin" id="listDataProduct">

        </div>

        <div class="uk-margin" id="addProductButton">
          <button class="uk-button uk-width-1-1 green-button" name="addProduct">Добавить</button>
        </div>

      </form>
    </div>

  </div>
</div>
<?php
require_once ROOT."/views/admin/footer.php";
?>
