<div class="uk-container">

  <div class="uk-text-center" uk-grid><!--Start grid info-->

    <div class="uk-width-1-4@m uk-visible@m">
      <div class="uk-grid-collapse" uk-grid>
        <div class="uk-width-1-4">
          <span uk-icon="icon: clock; ratio: 2.4"></span>
        </div>
        <div class="uk-width-expand uk-text-left">
          <strong>Рабочее время</strong><br>
          Пн-Вс: 8:00-18:00
        </div>
      </div>
    </div>

    <div class="uk-width-1-4@m uk-visible@m">
      <div class="uk-grid-collapse" uk-grid>
        <div class="uk-width-1-4">
          <span uk-icon="icon: home; ratio: 2.4"></span>
        </div>
        <div class="uk-width-expand uk-text-left">
          <strong>Бесплатная доставка</strong><br>
          Для заказов от 5 т.р
        </div>
      </div>
    </div>

    <div class="uk-width-1-4@m uk-visible@m">
      <div class="uk-grid-collapse" uk-grid>
        <div class="uk-width-1-4">
          <span uk-icon="icon: credit-card; ratio: 2.4"></span>
        </div>
        <div class="uk-width-expand uk-text-left">
          <strong>Возврат денег 100%</strong><br>
          После 30 дней доставки
        </div>
      </div>
    </div>

    <div class="uk-width-1-4@m uk-visible@m">
      <div class="uk-grid-collapse" uk-grid>
        <div class="uk-width-1-4">
          <span uk-icon="icon: phone; ratio: 2.4"></span>
        </div>
        <div class="uk-width-expand uk-text-left">
          <strong>Телефон: <a href="tel:0123456789">0123456789</a></strong><br>
          Заказать сейчас
        </div>
      </div>
    </div>

  </div><!--End grid info-->

  <div class="uk-child-width-expand@s uk-text-center" uk-grid><!--Start grid search-->
    <div class="logo uk-width-1-4@m">
      <a href="/">
        <img src="<?php echo LINK."/public/images/logo.png";?>" alt="Logo">
      </a>
    </div>

    <div class="search uk-width-expand@m">
      <form method="post" action="/search">

        <div class="uk-grid-collapse uk-child-width-expand@s" ui-grid>
          <select class="uk-select uk-width-1-4@m category" name="category">
            <option value="">Все категории</option>
            <?
            $categoryList = category::getCategoryAll();
            foreach ($categoryList as $row):
              ?>
              <option value="<? echo $row["number"];?>"><?echo $row["name"]?></option>
              <?
            endforeach;
            ?>
          </select>
          <div class="uk-search uk-search-default uk-width-2-3@m">
            <a href="" class="uk-search-icon-flip" uk-search-icon></a>
            <input class="uk-search-input" type="search" placeholder="Поиск..."  name="search">
          </div>
        </div>

      </form>
    </div>

    <div class="shop uk-width-1-4@m">
      <a href="/cart" class="uk-button uk-button-primary">
        <span uk-icon="icon: cart"></span>
        <span style="vertical-align: inherit;">Корзина (
          <span id="cart_count">
            <?
            if(isset($_COOKIE["shop"])){
              $len = 0;
              $data = json_decode($_COOKIE["shop"], true);
              foreach ($data as $value) {
                $len += $value[0];
              }
              echo $len;
            }
            else{
              echo "0";
            }
            ?>
          </span>
          )</span>
        </a>
      </div>
    </div><!--End grid search-->

  </div>
