<?php
/*       操作接口: 
*        handler 类 为所有操作的基类 提供了一些基本内置对象
*        其子类为某个具体的操作实例 由 action 对象创建并调用
*/

 class handler{
   protected $DB;  
   protected $file;  
   protected $json;
   public function perform(){}
   public function __construct(){
        $this->DB   =   new  mysql();
        $this->file   =   new  file();
        $this->json  =  new  display();
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
       $data['file']['template']  =$template;        
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
//说明文档
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
//添加新文件或者文件夹
class A_new extends handler{
     public function perform(){
       $path = $_GET['path'];
       $name =$_GET['name'];
       $type  =$_GET['type']; 

       if($type == 'dir'){
       $ret = $this->file->add_dir($path,$name);
       } else if($type == 'file'){
        $ret = $this->file->add_file($path,$name);
       }
       if($ret){
           $this->json->Json("success!");
       } else {
           $this->json->Json("failed!",null,false);
       }
    }
}
//获取控制器文件信息
class A_E_ctr extends handler{
     public function perform(){
       $path = $_GET['path'];
       $ctrl = new ctrl();
       $data =$ctrl->Get_Ctr_Info($path);
       if($data){
           $this->json->Json("success!",$data);
       } else {
           $this->json->Json("failed!",null,false);
       }
     }
}
//更改控制器名称
class A_E_ctr_change_name extends handler{
     public function perform(){
       $path = $_GET['path'];
       $name = $_GET['name'];
       $ctrl = new ctrl($path);
       $ret=$ctrl->change_name($path,$name);
       if($ret){
           $this->json->Json("success!",$data);
       } else {
           $this->json->Json("failed!",null,false);
       }
     }
}










//更改控制器名称(apicoud 测试）
class A_appcloud extends handler{
    public function perform(){
         $this->json->Json("test success!",$data);
    }
}























?>
