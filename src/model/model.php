<?php 
/*
*   模型(这里模型指文件模型 非mvc中的模型）抽象基类
*   为文件操作提供了封装层
*    内置的解析器对象提供了具体的文件操作策略
*/
abstract class model {
   protected $parse;

   public function __construct(){
    global $conf;
    $parse = $conf['parse']['parsename'];
    $this->parse=new $parse;// 从配置文件中获取解析器类
   }
}
// 控制器模型
class ctrl extends model {
    public function __construct(){
        parent::__construct();
    }
    public  function change_name($path,$name){
         return $this->parse->change_name($path,$name);
     }
    public  function add_action(){

     }
    public  function del_action(){

     }
    public function Get_Ctr_Info($path){
          return $this->parse->ctrl_info($path);
    }

  
}