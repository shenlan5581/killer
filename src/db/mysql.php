<?php

class mysql{
    private $myaql;
    public function __construct(){ 
        global $conf;
        $db_name      = $conf["db"]["db_name"];
        $host    = $conf["db"]["host"];
        $type    = $conf["db"]["type"];
        $uname = $conf["db"]["uname"];
        $pwd    = $conf["db"]["pwd"];
        $db      ="$type:host=$host;dbname=$db_name;charset=UTF8";
        $this->mysql = new PDO($db,$uname,$pwd);      
    }
    public function DB_List(){
       $List=array();
       $sql = "show tables";
       $stmt = $this->mysql->query($sql);
       $count = $stmt->rowCount();
       $rows =  $stmt->fetchAll();
       foreach($rows as $k=>$v){
           $tb_name= $v[0];
           $flag =substr_compare($tb_name,"dpl",0,3); //过滤掉dpl 表
            if($flag===0){
                continue;         
            } else {
                $sql = "desc ".$tb_name;
                $tb = $this->mysql->query($sql);
                $tb_rows = $tb->fetchAll();
                $table = array();
                foreach($tb_rows as $tk =>$tv){
                            $table[$tk] = $tv;
                $List[$tb_name]=$table;
           }
       }
    }
      return  $List;
}

}//class end