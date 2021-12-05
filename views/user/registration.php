<?php
$title = "Регистрация";
require_once ROOT."/views/common/header/index.php";
?>

<div class="uk-container content">
  <div class="uk-child-width-1-1" uk-grid>

    <div>
      <h3 class="uk-text-center"><span>Регистрация</span></h3><hr class="delimiter blue">
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
            <div class="uk-form-label">E-mail:</div>
            <div class="uk-form-controls">
              <input class="uk-input" type="email" placeholder="Почта..." name="email" value="<?php echo $email;?>" required>
            </div>
          </div>
          <div class="uk-margin">
            <div class="uk-form-label">Логин:</div>
            <div class="uk-form-controls">
              <input class="uk-input" type="text" placeholder="Логин..." name="login" pattern="\w{2,}" value="<?php echo $login;?>" required>
            </div>
          </div>
          <div class="uk-margin">
            <div class="uk-form-label">Фамилия:</div>
            <div class="uk-form-controls">
              <input class="uk-input" type="text" placeholder="Фамилия..." name="surname" pattern="\D{2,}" value="<?php echo $surname;?>" required>
            </div>
          </div>
          <div class="uk-margin">
            <div class="uk-form-label">Имя:</div>
            <div class="uk-form-controls">
              <input class="uk-input" type="text" placeholder="Имя..." name="name" pattern="\D{2,}" value="<?php echo $name;?>" required>
            </div>
          </div>
          <div class="uk-margin">
            <div class="uk-form-label">Адрес доставки:</div>
            <div class="uk-form-controls">
              <input class="uk-input" type="text" placeholder="Адрес..." name="address" value="<?php echo $address;?>" required>
            </div>
          </div>
          <div class="uk-margin">
            <div class="uk-form-label">Контактный телефон:</div>
            <div class="uk-form-controls">
              <input class="uk-input phone" type="text" placeholder="Телефон..." name="phone" value="<?php echo $phone;?>" required>
            </div>
          </div>
          <div class="uk-margin">
            <div class="uk-form-label">Пароль:</div>
            <div class="uk-form-controls">
              <input class="uk-input" id="inputPassword" type="password" placeholder="Пароль..." name="password" pattern="\w{1,}" value="<?php echo $password;?>" required>
              <label><input class="uk-checkbox" type="checkbox" id="showPassword">Показать</label>
            </div>
          </div>

          <div class="uk-margin">
            <button class="uk-button uk-width-1-1 uk-button-primary" name="submit">Регистрация</button>
          </div>

        </form>
      </div>

    </div>
  </div>
</div>

<script src="<?php echo LINK."/public/js/mask.js"?>"></script>
<?php
require_once ROOT."/views/common/footer.php";
?>
