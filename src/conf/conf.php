<?php
$baseDIR ="/home/ki/nginx/www";
$conf = array(
   'app' => array( 

     ),
   'db' => array( 
        'db_name'=>"yunzhe",
        'host'=>'127.0.0.1',
        'type'=>'mysql',
        'uname'=>'root',
        'pwd'=>'xingke',
     ),
   'user' => array( 
        'admin'=>'k',   
        'pwd'   =>'k',   
     ),
     'path'=>array(
          'ctrl'             =>$baseDIR.'/yunzhe/sites/app/controller',
          'model'         =>$baseDIR.'/yunzhe/sites/app/model',
          'view'           =>$baseDIR.'/yunzhe/sites/app/view/template',
          'template'      =>$baseDIR.'/killer/template',
          'MD'              =>$baseDIR.'/killer/src/MD',
     ),
    'parse'=>array(
            'parsename'=> 'Drupal',
         //   'ctr_pre'=>'App_Controller_'      //控制器类名前缀
     ),

);

?>
