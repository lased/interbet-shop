<div class="uk-flex uk-flex-center@s uk-flex-left@m">
  <form class="uk-width-1-3@s uk-width-2-3" method="post">

    <div class="uk-margin">
      <div class="uk-form-label">E-mail:</div>
      <div class="uk-form-controls">
        <input class="uk-input" type="email" placeholder="Почта..." name="email" value="<?=$user[0]["email"];?>" required>
      </div>
    </div>

    <div class="uk-margin">
      <div class="uk-form-label">Логин:</div>
      <div class="uk-form-controls">
        <input class="uk-input" type="text" placeholder="Логин..." name="login" pattern="\w{2,}" value="<?=$user[0]["login"];?>" required>
      </div>
    </div>

    <div class="uk-margin">
      <div class="uk-form-label">Фамилия:</div>
      <div class="uk-form-controls">
        <input class="uk-input" type="text" placeholder="Фамилия..." name="surname" pattern="\D{2,}" value="<?=$user[0]["surname"];?>" required>
      </div>
    </div>

    <div class="uk-margin">
      <div class="uk-form-label">Имя:</div>
      <div class="uk-form-controls">
        <input class="uk-input" type="text" placeholder="Имя..." name="name" pattern="\D{2,}" value="<?=$user[0]["name"];?>" required>
      </div>
    </div>

    <div class="uk-margin">
      <div class="uk-form-label">Адрес доставки:</div>
      <div class="uk-form-controls">
        <input class="uk-input" type="text" placeholder="Адрес..." name="address" value="<?=$user[0]["address"];?>" required>
      </div>
    </div>

    <div class="uk-margin">
      <div class="uk-form-label">Контактный телефон:</div>
      <div class="uk-form-controls">
        <input class="uk-input phone" type="text" placeholder="Телефон..." name="phone" value="<?=$user[0]["phone"];?>" required>
      </div>
    </div>

    <div class="uk-margin">
      <div class="uk-form-label">Пароль:</div>
      <div class="uk-form-controls">
        <input class="uk-input" id="inputPassword" type="password" placeholder="Пароль..." name="password" pattern="\w{1,}" value="<?=$user[0]["password"];?>" required>
        <label><input class="uk-checkbox" type="checkbox" id="showPassword">Показать</label>
      </div>
    </div>

    <div class="uk-margin">
      <button class="uk-button uk-width-1-1 uk-button-danger" name="saveProfile">Сохранить</button>
    </div>

  </form>
</div>
