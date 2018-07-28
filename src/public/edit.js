

/********控制器***** */
/*
动态改变控制器描述中的名称
*/
function edit_ctr_name_change() {
    var c_name  = $('#edit_ctr_new input  ').eq(0).val();
    $('#edit_ctr_desc_name').html(c_name);
}
/*
*动态添加action list
*/
function edit_ctr_action_add() {
    var c_name  = $('#edit_ctr_new input  ').eq(1).val();
       var html=$('#edit_ctr_desc_action').val();
            html+=c_name+'\n';
    $('#edit_ctr_desc_action').val(html);
    $('#edit_ctr_new input  ').eq(1).val('');
                                 
}

