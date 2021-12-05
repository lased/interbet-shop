<?php
$title = "Авторизация";
require_once ROOT."/views/common/header/index.php";
?>

<div class="uk-container content">
  <div class="uk-child-width-1-1" uk-grid>

    <div>
      <h3 class="uk-text-center"><span>Авторизация</span></h3><hr class="delimiter blue">
      <div class="uk-flex uk-flex-center">
        <form class="uk-width-1-3@s uk-width-2-3" method="post">

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
            <div class="uk-form-label">Логин:</div>
            <div class="uk-form-controls">
              <input class="uk-input" type="text" placeholder="Логин..." required pattern="\w{2,}" name="login" value="<?php echo $login; ?>">
            </div>
          </div>
          <div class="uk-margin">
            <div class="uk-form-label">Пароль:</div>
            <div class="uk-form-controls">
              <input class="uk-input" type="password" placeholder="Пароль..." required pattern="\w{1,}" name="password" value="<?php echo $password; ?>">
            </div>
          </div>
          <div class="uk-margin" uk-grid>
            <label><input class="uk-checkbox" type="checkbox" name="saveme" checked>Запомнить меня</label>
          </div>
          <div class="uk-margin">
            <button class="uk-button uk-width-1-1 uk-button-primary" name="submit">Вход</button>
          </div>

        </form>
      </div>

    </div>
  </div>
</div>

<?php
require_once ROOT."/views/common/footer.php";
?>
