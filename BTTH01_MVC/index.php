<?php
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

$controllerClass = ucfirst($controller) . 'Controller';
$controllerPath = __DIR__ . '/app/controllers/' . $controllerClass . '.php';

if (file_exists($controllerPath)) {
  require_once $controllerPath;
  $controllerObj = new $controllerClass();

  if (method_exists($controllerObj, $action)) {
    $controllerObj->{$action}();
  } else {
    echo "Action '$action' không tồn tại trong controller '$controllerClass'";
  }
} else {
  echo "Controller '$controllerClass' không tồn tại";
}
