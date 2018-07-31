<?php 

// 模型(这里模型指文件模型 非mvc中的模型）抽象基类
abstract class model {
   public      $file; //文件对象
   protected $parse;
   
   abstract public function GetJson(); //获取json数据
   public function __construct(){
    global $conf;
    $parse = $conf['parse']['parsename'];
    $this->file =new file();
    $this->parse=new $parse;// 从配置文件中获取解析器类
   }
}
// 控制器模型
class ctrl extends model {
    public $class_name;
    public $action_list;
    public $path;
    public $content;
    public function __construct($path){
        parent::__construct();
         $this->path=$path;
         $this->parse->ctrl($this);
    }
    
    public  function add_action(){

     }
    public  function del_action(){

     }
    public function GetJson(){
        return array(
             'class_name'=>$this->class_name,
             'action_list'=>$this->action_list,
        );
    }

  
}