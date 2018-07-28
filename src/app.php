<?php
session_start();
include_once "ini.php";
class app {
   private $action;
   public  $result;

    public function __construct(){
      $this->action = new action();
    }
    public function Run(){
      $this->action->Run($this);
    }
}
 $app   =  new app();
 $app->Run();
?>


