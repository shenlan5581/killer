<?php

abstract class Parse{
  abstract public function ctrl($ctrl);
  abstract public function model();
  abstract public function view();
}

class Drupal extends Parse{
      public function ctrl($ctrl){
           $ClassName = $this->GetClassName($ctrl);
           $ActionList = $this->GetActionList($ctrl);
           $ctrl->class_name= $ClassName? $ClassName:'';
           $ctrl->action_list = $ActionList?$ActionList:'';
      }


      public function model(){}
      public function view(){}

 














     private function GetClassName($ctrl){
        $content = $ctrl->file->file_read($ctrl->path);
   //     global $conf;
        if($content){
              $name =  $this->Getstr('class','extends',$content);
           return $name;          
        }else{
           return false;
        }
     }
     private function GetActionList($ctrl){
        $content = $ctrl->file->file_read($ctrl->path);
        if($content){
              $name =  $this->GetstrList('public function ','()',$content);
           return $name;          
        }else{
           return false;
        }
     }
  private function Getstr($begin,$end,$str,$offset=0){
      $name;
      $pattern = " /class (.*Controller) /";
      preg_match($pattern, $str,$name);
   //   print_r($name);
      return $name[1];
  }
  private function GetstrList($begin,$end,$str,$offset=0){
             $list = array();
             $pattern = " /public function (.*)Action/";
             preg_match_all($pattern, $str,$list);
        //     print_r($list);
             return $list[1];
  }
}