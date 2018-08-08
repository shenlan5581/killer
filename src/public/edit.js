/*** 编辑器** */

//global
var Edit_Ctr_Type;
var Edit_Ctr_Path;   
// 显示编辑器
function edit(type,Nid){
    Edit_Ctr_Type = type;
    Edit_Ctr_Path =$("#P_"+Nid).html();
    var x =  $('#'+Nid).offset().top+30;
    var y =  $('#'+Nid).offset().left+10;
    //现实相应编辑器
    if(type== 'ctrl'){
            ctr_reset();
            $("#edit_ctr").css({'top':x,'left':y});
            load_ctr(Edit_Ctr_Path);
            $("#edit_ctr").fadeIn();
    return;
    } 
     if(type=='model'){
             //model
    } else {
      alert(type);
    } 
}

/*ctr*/
//加载信息
function load_ctr(path){
        $.ajax({
        type: 'get',
        url: './app.php',
        data: { 'action': 'E_ctr',
                   'path':path,
                },
        success: function (result) {
            var json = JSON.parse(result);
                if(json.status ==true){ 
                $("#edit_ctr_desc_name").html(json.data.class_name); 
                $.each(json.data.action_list,function(index,item){
                var html = "<a  class ='a6' href='#ai' >"+item+" </a><br>";
                $("#edit_ctr_desc_actionlist").append(html); 
                 });
                 } else{
                $("#response").html(json.msg);
              }
            }
    })// ajax end
}
//动态改变控制器描述中的名称
function edit_ctr_name_change() {
    var c_name  = $('#edit_ctr input  ').eq(0).val();
    $.ajax({
        type: 'get',
        url: './app.php',
        data: { 'action': 'E_ctr_change_name',
                   'path':Edit_Ctr_Path,
                   'name':c_name
                },
        success: function (result) {
            var json = JSON.parse(result);
                if(json.status ==true){ 
                    $('#edit_ctr_desc_name').html(c_name);
                    $('#edit_ctr input  ').eq(0).val('');
                 } else{
                    $("#response").html(json.msg);
              }
            }
    })// ajax end
}
//动态添加action list
function edit_ctr_action_add() {
    var c_name  = $('#edit_ctr input  ').eq(1).val();
    if(c_name == ''){
      $("#response").html('请输入新名称');
      return 
    }
    var html = "<a href='#ai'  class ='a6' >"+c_name+" </a>  <a href='#ai'  class ='a3' >-</a> <br>";
    $('#edit_ctr_desc_actionlist').append(html);
    $('#edit_ctr input  ').eq(1).val('');
}
//取消
function edit_ctr_cancel(){
    $("#edit_ctr").fadeOut();
}
//重置
function ctr_reset(){
     $('#edit_ctr_new input  ').eq(0).val('');
     $("#edit_ctr_desc_name").html(' ');
     $("#edit_ctr_desc_actionlist").empty();
}
//为某个actio_list 添加 action(js)
function insert_action_at_list(){


}

/*
function edit_ctr_submit(){
    var c_name = $("#edit_ctr_desc_name").html();
    var a_list    =  $("#edit_ctr_desc_actionlist").val();
    $.ajax({
        type: 'get',
        url: './app.php',
        data: { 'action': 'add_ctrla',
                   'path':NewfileParentPath,
                   'action':a_list
                },
        success: function (result) {
            var json = JSON.parse(result);
                if(json.status ==true){ 
                    $("#response").html(json.msg);
                    $("#edit_ctr_new").fadeOut();
                 } else{
                $("#response").html(json.msg);
              }
            }
    })// ajax end
}*/
   








