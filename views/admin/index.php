<?php
$title = "Админ панель";
require_once ROOT."/views/admin/header.php";
$statistics["ORDERS"] = orders::getCountOrders();
$statistics["PROFIT"] = orders::getProfitOrders();
?>

<script src="/public/js/chart.js"></script>
<script>
$(document).ready(function(){
  google.charts.load('current', {'packages':['corechart', 'bar']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    drawChartOrders();
    drawChartProfit();
  }

  function drawChartOrders() {
    var data = google.visualization.arrayToDataTable([
      ['Дата', 'Кол-во заказов'],
      <?
      foreach ($statistics["ORDERS"] as $row):
        ?>
        ["<?=$row["date"]?>",  <?=$row["count"]?>],
        <?
      endforeach;
      ?>
    ]);

    var options = {
      title: 'Статистика заказов',
      hAxis: {title: 'Дата',  titleTextStyle: {color: '#333'}},
      vAxis: {minValue: 0}
    };

    var chart = new google.visualization.AreaChart(document.getElementById('chart_orders'));
    chart.draw(data, options);
  }

  function drawChartProfit() {
    var data = google.visualization.arrayToDataTable([
      ['Дата', 'Доход'],
      <?
      foreach ($statistics["PROFIT"] as $row):
        ?>
        ["<?=$row["date"]?>",  <?=$row["profit"]?>],
        <?
      endforeach;
      ?>
    ]);

    var options = {
      chart: {
        title: 'Посуточный доход'
      }
    };

    var chart = new google.charts.Bar(document.getElementById('chart_profit'));

    chart.draw(data, google.charts.Bar.convertOptions(options));
  }

});
</script>

<div uk-grid class="max-height">
  <div class="uk-width-1-4">
    <?php
    require_once ROOT."/views/admin/sidebar.php";
    ?>
  </div>
  <div class="uk-width-3-4">
    <div id="chart_orders" style="width: 100%; height: 500px;"></div>
    <div id="chart_profit" style="width: 100%; height: 500px;"></div>
  </div>
</div>

<?php
require_once ROOT."/views/admin/footer.php";
?>
