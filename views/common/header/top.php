
<div class="top uk-margin">
  <div class="uk-container">
    <div uk-grid>
      <div class="uk-width-1-1 uk-flex uk-flex-right">
        <?php
        if(isset($_SESSION["id_user"]) || isset($_COOKIE["id_user"])):
          ?>
          <?php
          if(isset($_SESSION["role"])):
            if($_SESSION["role"] != 2):
              ?>
              <a class="uk-button uk-button-danger" href="/admin">
                <span uk-icon="icon: cog" style="vertical-align: text-bottom;"></span>Админ панель
              </a>
              <?php
            endif;
          endif;
          ?>
          <a class="uk-button uk-button-primary" href="/profile">
            <span uk-icon="icon: cog" style="vertical-align: text-bottom;"></span>Личный кабинет
          </a>
          <a class="uk-button uk-button-primary" href="/user/logout">
            <span uk-icon="icon: sign-out" style="vertical-align: text-bottom;"></span>Выйти
          </a>
        <?php else: ?>
          <a class="uk-button uk-button-primary" href="/user/login">
            <span uk-icon="icon: sign-in" style="vertical-align: text-bottom;"></span>Вход
          </a>
          <a class="uk-button uk-button-primary" href="/user/registration">
            <span uk-icon="icon: user" style="vertical-align: text-bottom;"></span>Регистрация
          </a>
        <?php endif;?>
      </div>
    </div>
  </div>
</div>
