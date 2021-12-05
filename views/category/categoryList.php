<?php
$title = "Категории";
require_once ROOT."/views/common/header/index.php";
?>

<div class="uk-container content">
  <div class="uk-child-width-1-3@m" uk-grid>

    <?
    foreach ($category as $row):
      ?>

      <div>
        <div class="uk-card uk-card-default max-height uk-text-center">
          <div class="uk-card-header uk-flex uk-flex-column">
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
          </div>
          <div class="uk-card-footer">
            <a href="/category/<? echo $row["number"];?>" class="uk-button uk-button-text">
              Подробнее
            </a>
          </div>
        </div>
      </div>

      <?
    endforeach;
    ?>

  </div>
</div>

<?php
require_once ROOT."/views/common/footer.php";
?>
