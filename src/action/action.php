<?php
class action{
     private $json;
     public function __construct(){
        $this->json  =  new display;
     }

    public function Run($app){
        $action = $_GET['action'];
        if($action){
            if($action == 'signin'){
                if($this->signin() == true ){
                   $this->json->Json('LogIn success.',null,true);
                } else {
                   $this->json->Json('LogIn failed.',null,false);
                }
             }elseif($action == 'MD'){
                   $action = "A_".$action;                     
                   $handler = @new $action;                     
                   @$handler ->perform();
             }else {
                if(empty($_SESSION['user'])){
                    $this->json->Json('Plase login frist.',null,false);
                } else {    
                   $action = "A_".$action;                     
                   $handler = @new $action;                    
                   @$handler ->perform();
                }
            }
       }
    }

    public function signin(){
        global $conf;
         $admin = $_GET['user'];        
         $pwd   = $_GET['pwd'];       
  //      if(empty($_SESSION['user'])){
          if($admin == $conf['user']['admin']  &&
             $pwd    ==$conf['user']['pwd']){
             $_SESSION['user'] =$admin;
             return true;
             } else {
             return false;
             }
 //        }else{
   //         return false;
//           }
      }
}
?>