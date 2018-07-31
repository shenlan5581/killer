/*
*    常见操作
*/

/**  operate  **/

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
                   Init();//   initialize
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

/**文件创建**/ 
  
// 显示创建文件夹输入框
var NewParentID//global
var Newtype;
var NewPath;
var Model_name;
function add(Nid,type,M_name){
        NewParentID = Nid;
        Newtype=type;
        NewDirtype=Nid;
        Model_name = M_name;
        NewPath = $("#P_"+Nid).html();
        var x =  $('#'+Nid).offset().top+30;
        var y =  $('#'+Nid).offset().left+10;
        $("#new").css({'top':x,'left':y});
        $("#newinput").val('新文件');
        $("#new").fadeIn();
}
//提交
function newsubmit(){
   name  = $("#newinput").val();
   if(name=='新文件') {
    $("#response").html('请输入文件名');
    return;
   }
   $.ajax({
    type: 'get',
    url: './app.php',
    data: { 'action': 'new',
               'path':NewPath,
               'type':Newtype,
               'name':name
            },
    success: function (result) {
        var json = JSON.parse(result);
            if(json.status ==true){ 
                $("#response").html(json.msg);
                id++;
                Fid = id;
                path = NewPath+"/"+name;
                if(Newtype =='dir') {
                insert_new_dir(Fid,path,name,NewParentID,Model_name);
                } else   if (Newtype =='file')   {
                insert_new_file(Fid,path,name,NewParentID,Model_name);
                var obj = $("#"+Fid+" a").eq(0);
                obj.css("color","rgb(247, 88, 88)");
                }
                $("#new").fadeOut()
             } else{
                $("#response").html(json.msg);
                $("#new").fadeOut();
          }
        }
    })// ajax end
}
// private 从父节点插入新文件夹节点   
function insert_new_dir(Fid,path,name,Parent_ID,M_name) { // 唯一id , 路径，文件名 ，父节点 id
    var  html = "<div id = '"+Fid+ "' class = 'dir_node border02'> "; //添加文件夹节点
    html += name+ "<a href='#ai' onclick=add('"+Fid+"','file','"+M_name+"') class ='a2'>+</a> " ;
    html +=  "<a href='#ai' onclick=add_file_temp('"+Fid+"','"+M_name+"') class ='a4'><</a> " ;
    html +="<a href='#ai' onclick=del('"+Fid+"') class ='a3'>-</a>";
    html += "<span id = P_"+Fid+" style='display:none'>" + path+ "</span> ";//文件路径
    html += "<div id =C_"+Fid+"></div>"; //添加子节点
    html += "</div>"; 
    $("#" +Parent_ID).append(html)
}

// 插入新文件节点
function insert_new_file(Fid,path,Fname,Parent_ID,M_name) { // 唯一id , 路径 ,(文件名），父节点 id
    var html   = "<div id  = '" + Fid + "' class ='file_node'>"; 
    html+="<a href='#ai' class ='a5' onclick=edit('"+M_name+"',"+Fid+")  >"+Fname +"<a>"; 
    html+= "<a href='#aei' onclick=del('"+Fid+"')  class ='a3'>-</a><span id = 'P_" + Fid + "' style='display:none'>";
    html+=  path  + "</span> </div> ";
   $("#" + Parent_ID).append(html);
}

//取消创建新文件夹
function newcancel(){
        $("#new").fadeOut();
}
//删除文件夹 或者 文件
 var Did ;    
function del(Nid){
    if(Did != Nid) {
        Did = Nid;
        return;
    }
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