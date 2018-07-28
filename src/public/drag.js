/*  拖放
*/
$(document).ready(function(){
 $( "#ctrl" ).draggable(); 
$( "#model" ).draggable(); 
$( "#template" ).draggable(); 
$( "#db" ).draggable(); 
$( "#view" ).draggable(); 
$( "#edit" ).draggable(); 
 });


 /*
  拖拽实现
 思路1 当拖动某元素离开其父元素范围时 触发删除
 思路1 当拖动某元素进入某范围时 触发 添加
 （未实现）
 */
function drag(id,event){
   $(document).mousemove(function(event){
           x=event.clientX;
           y=event.clientY;
   $("#"+id).css({"position":"fixed", "left":x,"top":y});
   });
    $(document).mouseup(function(event){
    $(document).unbind('mousemove');
   })
}


