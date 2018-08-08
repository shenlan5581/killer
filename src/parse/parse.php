<?php

/*
*   解析器: 解析器作为模型(此处指文件操作模型)的内置对象 
*               为模型提供了统一的(针对）文件操作接口
*                解析器应该可扩展为不同的框架提供具体策略
*                例: Drupal子类处理drupal框架的项目代码
*                     则tp子类处理thinkphp框架的具体项目代码
*                     (如 正则对文件内容的匹配）
*/

abstract class Parse{
  protected  $file; //文件对象
  protected  $regex; //文件对象
   public function __construct(){
    $this->file =new file();
    $this->regex=include_once "drupal_regex.php";
   }

}


     /*  正则匹配  */


 
     
class Drupal extends Parse{
  //获取控制器名称及action列表
      public function ctrl_info($path){
           $ClassName = $this->GetClassName($path);
           $ActionList = $this->GetActionList($path);
        return array(
             'class_name'=>$ClassName?$ClassName:'',
             'action_list'=>$ActionList?$ActionList:'',
           );
      }
    //更改或创建类名
     public function change_name($path,$name){
          $content = $this->file->file_read($path);
          if($content){  //旧文件 
              $o_name = $this->GetClassName($path);
              $seek = strpos($content,$o_name); 
             $ret =  $this->file->file_change_str($path,$o_name,$name,$seek);
          } else { //新文件
             $ret =  $this->file->file_change_str($path,$name,$seek);
          }
          return $ret;
     }

/*获取控制器类名*/
     private function GetClassName($path){
        $content = $this->file->file_read($path);
        if($content){
              $name =  $this->Getstr($content,$this->regex['class_name']);
           return $name;          
        }else{
           return false;
        }
     }
/*获取action 列表*/
     private function GetActionList($path){
        $content = $this->file->file_read($path);
        if($content){
              $name =  $this->GetstrList($content,$this->regex['action_list']);
           return $name;          
        }else{
           return false;
        }
     }
     /*  正则匹配  */

   // 获取某一字符串(需要正则）
  private function Getstr($str,$regex){
      $name;
      $pattern = $regex;
      preg_match($pattern, $str,$name);
      return $name[1];
  }
  // 某字符串多次匹配 (需要正则）
  private function GetstrList($str,$regex){
             $list = array();
             $pattern = $regex;
             preg_match_all($pattern, $str,$list);
             return $list[1];
  }
}