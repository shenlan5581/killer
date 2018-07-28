
<?php

class display {
   public function Json($msg=' ',$data=array(),$status=true){
       $arr = array();
       $arr['msg'] =$msg ;
       $arr['data'] =$data ;
       $arr['status'] =$status ;
       echo json_encode($arr);       
   }
}
