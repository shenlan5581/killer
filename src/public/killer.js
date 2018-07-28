/*
*   初始化相关
*/
$(document).ready(function () {
    load_md();

});
var id = 0;
function Init() {
    $.ajax({
        type: 'get',
        url: './app.php',
        data: { 'action': 'init' },
        success: function (result) {
            var json = JSON.parse(result);
            if (json.status == true) { //success 
                $("#response").html(json.msg); 
                $.each(json.data.file,function(index,item){
                    draw(index,item,index);    //文件
                })
                db("db",json.data.DB); //数据库
                SetRootPath(json.data.path);//设置几个根文件路径
            } else {  //failed
                $("#response").html(json.msg);
            }
        }
    })// ajax end
}
/*
*  文件递归函数
*/
function draw(Nid,node,type){   //文件名 节点   Nname:要添加的节点名
      var file_type=type;// 用来记录当前文件类型例如文件或者文件夹 是 控制器或者模型视图
    $.each(node, function (Fname, item) {   // 
           id++;
           var Fid =id;
        if (item.type == "dir") {
               insert_new_dir(Fid,item.path,Fname,Nid,file_type);
               draw( "C_"+Fid,item.child,file_type);
        }
        if (item.type == "file") {
            insert_new_file(Fid,item.path,Fname,Nid,file_type ) ;
        } 
    });
}
/*  建立数据库表 
*/
function db(Nid,node){
       $.each(node,function(index,item){  //表
             var Did = index+(id++);
             var  html = "<div id = '"+Did+ "' class = 'dir_node border02'> "+index+"</div>"; //添加节点
             $("#" +Nid).append(html)
             $.each(item,function(ind,ite){  // 字段
                  var  wid = Did+ite[0];
                  var  info = "<div id ='W_"+wid+"'  onmouseover=show_db_word('desc_"+wid+"') onmouseout = hidde_db_word('desc_"+wid+"') class = 'file_node'>"; 
                        info += ite[0]+"</div>"; //添加节点
                        info+= "<div id ='desc_"+wid+ "' style='display:none' class = 'db_info_node '>" ; //添加隐藏节点
                        $.each(ite,function(ins,its ){                                              //循环字段详细信息
                           info+="<span>"+ins+":"+its+"</span><br>";
                        })
                        info+="</div>";
                  $("#" +Did).append(info);
             })
       })
}
/* 为几个根文件目录添加路径
*/
function  SetRootPath(path){       //设置几个根文件路径
   $.each(path,function(index,item){  // 字段
         html="<span id = 'P_"+index+"'  style='display:none'>"+item+"</span>";
         $("#"+index).append(html);
    })
}
// 当鼠标悬停时显示字段信息
function show_db_word(id){
$("#"+id).css({                  });
$("#"+id).fadeIn(50);
}
function hidde_db_word(id){
$("#"+id).fadeOut(50);
}
// 加载说明文档
function load_md(){
    $.ajax({
        type: 'get',
        url: './app.php',
        data: { 'action': 'MD' },
        success: function (result) {
            var json = JSON.parse(result);
            if (json.status == true) { //success 
                $("#desc").append(json.data); 
            } else {  //failed
                $("#response").html(json.msg);
            }
        }
    })// ajax end
}