<?php
class HomeController
{
  public function index()
  {
    include(realpath(__DIR__ . '/../views/home/index.php'));
  }
}
