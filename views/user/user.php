<?php
$title = "Профиль";
require_once ROOT."/views/common/header/index.php";
?>
<div class="uk-container content">
  <h3 class="uk-text-center">Личный кабинет</h3><hr class="delimiter orange">
  <div uk-grid>
    <div class="uk-width-1-5@m">
      <ul class="uk-tab-left" uk-tab="connect:#profile">
        <li class="<?
        if(!$delete){
          echo "uk-active";
        }
        ?>
        "><a href="#">Профиль</a></li>
        <li class="<?
        if($delete){
          echo "uk-active";
        }
        ?>
        "><a href="/user/order">Заказы</a></li>
      </ul>
    </div>

    <div class="uk-width-4-5@m">
      <ul id="profile" class="uk-switcher uk-margin">
        <li class="<?
        if(!$delete){
          echo "uk-active";
        }
        ?>
        ">
        <?php
        require_once ROOT."/views/user/profile.php";
        ?>
      </li>
      <li class="<?
      if($delete){
        echo "uk-active";
      }
      ?>
      ">
      <?php
      require_once ROOT."/views/user/order.php";
      ?>
    </li>
  </ul>
</div>
</div>
</div>

<script src="<?php echo LINK."/public/js/mask.js"?>"></script>

<?php
require_once ROOT."/views/common/footer.php";
?>
