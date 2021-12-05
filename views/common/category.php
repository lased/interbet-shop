<aside class="left-sidebar">
  <div class="sidebar--header">
    <a class="uk-button uk-button-primary" href="/category">
      <span uk-icon="icon: menu" style="vertical-align: text-bottom;"></span>Категории
    </a>
  </div>
  <div class="sidebar--list">
    <ul class="uk-list uk-list-striped uk-nav">
      <?
      foreach ($category as $row):
        ?>
        <li><a href="/category/<? echo $row["number"];?>" class="uk-button uk-button-text"><?echo $row["name"]?></a></li>
        <?
      endforeach;
      ?>
    </ul>
  </div>
</aside>
