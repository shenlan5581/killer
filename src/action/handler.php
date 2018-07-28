<?php
/* 操作接口
*
*/

 class handler{
   protected $DB;  
   protected $file;  
   protected $json;
   public function perform(){}
   public function __construct(){
        $this->DB   =   new  mysql();
        $this->file   =   new  file();
        $this->json  =  new display();
   }
   public function View(){
       global $conf;
       $ctrl    = $this->file->DirList($conf['path']['ctrl']);
       $model= $this->file->DirList($conf['path']['model']);
       $view=   $this->file->DirList($conf['path']['view']);
       $template= $this->file->DirList($conf['path']['template']);
       $mysql= $this->DB ->DB_List();
       $data= array();
       $data['file']['ctrl']         =$ctrl;           
       $data['file']['model']     =$model;   
       $data['file']['view']       =$view;   
       $data['file']['template']  = $template;        
       $data['DB']                  =$mysql;
       $data['path']                = $conf['path'];
       return $data;
   }
}

class A_Init extends handler{
     public function perform(){
        $data =  $this->View();     
        $this->json->Json("Initialize success",$data);
    }
}
// 说明文档
class A_MD extends handler{
     public function perform(){
       global $conf;
        $path=$conf['path']['MD'];
        $data =  $this->file->file_read($path);     
        $this->json->Json("MD",$data);
    }
}
//退出
class A_signout extends handler{
     public function perform(){
       unset($_SESSION['user']);
       $this->json->Json("BYE!");
    }
}
//删除
class A_del extends handler{
     public function perform(){
       $path = $_GET['path'];
       $ret = $this->file->delete($path);
       if($ret){
           $this->json->Json("success!");
       } else {
           $this->json->Json("failed!",null,false);
       }
    }
}
class A_newdir extends handler{
     public function perform(){
       $path = $_GET['path'];
       $name =$_GET['name'];
       $ret = $this->file->add_dir($path,$name);
       if($ret){
           $this->json->Json("success!");
       } else {
           $this->json->Json("failed!",null,false);
       }
    }
}

























?>
