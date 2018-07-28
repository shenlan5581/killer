/*
*     用户交互
*/
$(document).ready(function () {

  closeF5();
});

//显示登陆框
function display_signin(e){
 if($("#signin").html() ==="SIGNIN"){
         $("#signin_tb").fadeIn();
    } 
}
// 提交登陆
function signin_commit(){
    var user = $("#signin_tb_user").val();
    var pwd = $("#signin_tb_pwd").val();
    $.ajax({
        type: 'get',
        url: './app.php',
        data: { 'action': 'signin',
                   'user':user,
                   'pwd':pwd   
                },
        success: function (result) {
            var json = JSON.parse(result);
                if(json.status ==true){
                   $("#response").html(json.msg);
                   $('#signin_tb').fadeOut();
                   $('#signin').html(user);
                   $('#project').fadeIn(1000);
                   var html =" <a href = '#ai' class = 'a1' id ='signout' onclick=signout() >SIGNOUT</a>";
                   $('#signin').after(html);
                   $('#status').animate({top:'10px',height:'20px'});
                   Init();
              } else{
                $("#response").html(json.msg);
              }
            }
    })// ajax end
}
//登出
function signout(){
    var user = $("#signin_tb_user").val();
    var pwd = $("#signin_tb_pwd").val();
    $.ajax({
        type: 'get',
        url: './app.php',
        data: { 'action': 'signout',
                },
        success: function (result) {
            var json = JSON.parse(result);
                if(json.status ==true){
                   $("#response").html(json.msg);
                   $('#signin').html("SIGNIN");
                   $('#signout').remove();
                   $('#signin').remove();
                   $('#project').fadeOut();
                   $('#status').animate({top:'300px',height:'200px'});
              } else{
                $("#response").html(json.msg);
              }
            }
    })// ajax end
}
/*          文件夹相关      */ 
 
//a2 显示创建文件夹输入框
var NewDirParentID//global
function add_dir(Nid){
        NewDirParentID = Nid;
        var path =$("#P_"+Nid).html();
        var x =  $('#'+Nid).offset().top+30;
        var y =  $('#'+Nid).offset().left+10;
        $("#newdir").css({'top':x,'left':y});
        $("#newdir").fadeIn();
        $("#newdirinputpath").val(path);
}
//提交
function newdirsubmit(){
   name  = $("#newdirinput").val();
   path   = $("#newdirinputpath").val();
   $.ajax({
    type: 'get',
    url: './app.php',
    data: { 'action': 'newdir',
               'path':path,
               'name':name
            },
    success: function (result) {
        var json = JSON.parse(result);
            if(json.status ==true){ 
                $("#response").html(json.msg);
                id++;
                Fid = id;
                insert_new_dir(Fid,path,name,NewDirParentID);
                $("#newdir").fadeOut();
             } else{
                $("#response").html(json.msg);
                $("#newdir").fadeOut();
          }
        }
    })// ajax end
}
// private 从父节点插入新文件夹节点   
function insert_new_dir(Fid,path,name,Parent_ID,type) { // 唯一id , 路径，文件名 ，父节点 id
    var  html = "<div id = '"+Fid+ "' class = 'dir_node border02'> "; //添加文件夹节点
    html += name+ "<a href='#ai' onclick=add_file_new('"+Fid+"','"+type+"') class ='a2'>+</a> " ;
    html +=  "<a href='#ai' onclick=add_file_temp('"+Fid+"','"+type+"') class ='a2'>Temp</a> " ;
    html +="<a href='#ai' onclick=del('"+Fid+"') class ='a3'>-</a>";
    html += "<span id = P_"+Fid+" style='display:none'>" + path+ "</span> ";//文件路径
    html += "<div id =C_"+Fid+"></div>"; //添加子节点
    html += "</div>"; 
    $("#" +Parent_ID).append(html)
}
//取消创建新文件夹
function newdircancel(){
        $("#newdir").fadeOut();
}
//删除文件夹 或者 文件
function del(Nid){
    var path =$("#P_"+Nid).html();
    $.ajax({
        type: 'get',
        url: './app.php',
        data: { 'action': 'del',
                   'path':path
                },
        success: function (result) {
            var json = JSON.parse(result);
                if(json.status ==true){ 
                    $("#"+Nid).remove();
                 } else{
                $("#response").html(json.msg);
              }
            }
    })// ajax end
}
 
/*              文件相关          */ 
  
//插入新文件节点
function insert_new_file(Fid,path,Fname,Parent_ID,type) { // 唯一id , 路径 ,(文件名），父节点 id
    var html   = "<div id  = '" + Fid + "' class ='file_node'>"; 
    html+=  Fname+"<a href='#ai' onclick=del('"+Fid+"')  class ='a3'>-</a><span id = 'P_" + Fid + "' style='display:none'>";
    html+=  path  + "</span> </div> ";
   $("#" + Parent_ID).append(html);
}
//取消创建新文件
function newfilecancel(){
    $("#edit_ctr_new").fadeOut();
}

/*添加文件依据类型(新文件）
     其中类型指定要添加的是   ctrl,model或者view
    该类型的值为初始化时获取到的 json字段名file 中 对象名
    依据相应的类型显示编辑器
*/
var NewfileParentID;
var NewfileParentPath;
function add_file_new(Nid,type){
        NewfileParentID = Nid;
        NewfileParentPath =$("#P_"+Nid).html();
        var x =  $('#'+Nid).offset().top+30;
        var y =  $('#'+Nid).offset().left+10;
        //现实相应编辑器
        if(type== 'ctrl'){
        ctr_reset();
        $("#edit_ctr_new").css({'top':x,'left':y});
        $("#edit_ctr_new").fadeIn();
        return;
        } 
         if(type=='model'){
                 //model
        } else {
          alert(type);
        }
}
function ctr_reset(){
     $("#edit_ctr_desc_name").html('');
     $("#edit_ctr_desc_action").val('');
}
/*添加文件依据类型(从文件）
     其中类型指定要添加的是   ctrl,model或者view
    该类型的值为初始化时获取到的 json字段名file 中 对象名
    依据相应的类型显示编辑器
*/
function add_file_temp(id,type){
    
    
}
function new_file_submit(){
   alert(NewfileParentID+":"+NewfileParentPath);

}
   

//  禁用刷新
function closeF5(){
    document.oncontextmenu=function(){return false;}
    document.onkeydown=function(event){
    var e = event || window.event || arguments.callee.caller.arguments[0];
    if(e && e.keyCode==116){
    return false;
    }
    } 
}
