<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="/public/css/uikit.css">
  <link rel="stylesheet" href="/public/css/main.css">
  <script src="/public/js/jquery.js"></script>
  <script src="/public/js/uikit.js"></script>
  <script src="/public/js/uikit-icons.js"></script>
  <title>Успех</title>
</head>
<style media="screen">
body{
  background: #E5E9EC;
  padding-top: 20%;
}
.green-circle{
  background: #2ECC71;
  width: 150px;
  height: 150px;
  border-radius: 50%;
  color: #fff;
}
.green-button:hover{
  color: #fff;
}
</style>
<body>

  <div class="uk-flex uk-flex-column" style="margin:auto;width: 300px;height: 200px;">
    <div class="green-circle" style="margin: auto;">
      <span uk-icon="icon: check; ratio: 7.5"></span>
    </div>

    <span class="uk-margin uk-text-center"><h4>Заказ успешно выполнен</h4></span>
    <a href="/" class="uk-button green-button">На главную</a>
  </div>


</body>
</html>
