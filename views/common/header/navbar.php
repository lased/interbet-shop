<div class="dark">
  <div class="uk-container">
    <nav class="uk-navbar-container main-navbar" uk-navbar>
      <div class="uk-navbar-left">
        <ul class="uk-navbar-nav">
          <li class=""><a href="/">Главная</a></li>

          <li>
            <a href="/category">Категории</a>
            <div class="uk-navbar-dropdown">
              <ul class="uk-nav uk-navbar-dropdown-nav">
                <?
                $navCategory = category::getCategoryAll();
                foreach ($navCategory as $row):
                  ?>
                  <li><a href="/category/<?echo $row["number"];?>"><?echo $row["name"];?></a></li>
                  <?
                endforeach;
                ?>

              </ul>
            </div>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</div>
