<div class="admin-sidebar uk-card uk-card-default uk-card-body uk-width-1-2@s">
  <ul class="uk-nav-default uk-nav-parent-icon" uk-nav>
    <li class="uk-nav-header">
      <a class="uk-button" href="/">
        <span uk-icon="icon: arrow-left" style="vertical-align: text-bottom;"></span>На сайт
      </a>
    </li>
    <?if ($_SESSION["role"] == 1): ?>
    <li class="uk-nav-header">Товары</li>
    <li><a href="/admin/addProduct"><span class="uk-margin-small-right" uk-icon="icon: file"></span>Добавить товар</a></li>
    <li><a href="/admin/category"><span class="uk-margin-small-right" uk-icon="icon: album"></span>Категории</a></li>
    <li><a href="/admin/listProduct"><span class="uk-margin-small-right" uk-icon="icon: database"></span>Список товаров</a></li>

    <li class="uk-nav-header">Поставщики</li>
    <li><a href="/admin/addSupplier"><span class="uk-margin-small-right" uk-icon="icon: user"></span>Добавить поставщика</a></li>

    <li class="uk-nav-header">Склад</li>
    <li><a href="/admin/addOnStock"><span class="uk-margin-small-right" uk-icon="icon: download"></span>Импорт товаров</a></li>
    <li><a href="/admin/listStock"><span class="uk-margin-small-right" uk-icon="icon: database"></span>Склад</a></li>

    <li class="uk-nav-header">Заказы</li>
    <li><a href="/admin/listOrders"><span class="uk-margin-small-right" uk-icon="icon: upload"></span>Список заказов</a></li>
    <li><a href="/admin/addDelivery"><span class="uk-margin-small-right" uk-icon="icon: dribbble"></span>Добавить службу доставки</a></li>

    <?elseif($_SESSION["role"] == 3): ?>
    <li class="uk-nav-header">Поставщики</li>
    <li><a href="/admin/addSupplier"><span class="uk-margin-small-right" uk-icon="icon: user"></span>Добавить поставщика</a></li>

    <li class="uk-nav-header">Склад</li>
    <li><a href="/admin/addOnStock"><span class="uk-margin-small-right" uk-icon="icon: download"></span>Импорт товаров</a></li>
    <li><a href="/admin/listStock"><span class="uk-margin-small-right" uk-icon="icon: database"></span>Склад</a></li>

    <?elseif($_SESSION["role"] == 4): ?>
    <li class="uk-nav-header">Заказы</li>
    <li><a href="/admin/listOrders"><span class="uk-margin-small-right" uk-icon="icon: upload"></span>Список заказов</a></li>
    <li><a href="/admin/addDelivery"><span class="uk-margin-small-right" uk-icon="icon: dribbble"></span>Добавить службу доставки</a></li>

    <?endif; ?>

  </ul>
</div>
