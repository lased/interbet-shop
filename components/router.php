<?php


class router
{
  private $routes;
  public function __construct()
  {
    $routesPath = ROOT . "/config/routes.php";
    $this->routes = include($routesPath);
  }

  //Возвращает массив роутеров
  private function getURI()
  {
    if (!empty($_SERVER["REQUEST_URI"])) {
      return trim($_SERVER["REQUEST_URI"], "/");
    }
  }

  public function run()
  {
    $uri = $this->getURI();
    foreach ($this->routes as $urlPattern => $path) {
      if (preg_match("#$urlPattern#", $uri)) {
        $internalRoute = preg_replace("~$urlPattern~", $path, $uri);

        $segment = explode("/", $internalRoute);

        $controllerName = array_shift($segment) . "Controller"; //Имя класса контроллера

        $actionName = "action" . ucfirst(array_shift($segment)); // Имя метода в классе (ucfirst делает заглавную букву у 1 символа в строке)

        $parameters = $segment;

        $controllerObject = new $controllerName;

        /* Вызываем необходимый метод ($actionName) у определенного
        * класса ($controllerObject) с заданными ($parameters) параметрами
        */
        $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

        // Если метод контроллера успешно вызван, завершаем работу роутера
        if ($result != null) {
          exit;
        }
      }
    }

    $error = new errorsController();
    $error->page404();
  }
}
