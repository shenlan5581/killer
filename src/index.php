 
<!DOCTYPE HTML>
<html lang="en">
<head>
<script src="./public/jquery.js"></script>
<link href="./public/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
 <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link href="./public/killer.css" rel="stylesheet" />
<link href="./public/edit.css" rel="stylesheet" />
<script src="./public/killer.js"></script>
<script src="./public/operate.js"></script>
<script src="./public/drag.js"></script>
<script src="./public/edit.js"></script>

 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

<title>killer</title>
</head> 
<body >
<h3   id ='title' onmousedown=drag('title',event) > K-KILLER</h3>
<div id = "status"> <span id ="response">WELCOME</span>
<a class='a1'   href = "#ai" id='signin' onclick=display_signin()>SIGNIN</a>
<div id='signin_tb' class ='signin broder02'>请输入用户名和密码 <br>
     <input type='text' id='signin_tb_user' value ='USER NAME'></input><br>
     <input type='text' id='signin_tb_pwd' value='PASSWORD'></input><br>
     <a href ='#ai' class ='a1'  onclick=signin_commit() >COMMIT </a>
     <a href ='./app.php?action=signout'class ='a1' >如果重复登陆点击这里 </a>
</div>
</div>



<!--描述-->
<pre>
<div id="desc"> DESCRIPTOR :  </div>
</pre>



<!--文件夹列表-->
<div id="project">
      <div id="ctrl"class="item" > CONTROLLER
            <a href="#" onclick=add_dir('ctrl') class="a2">+</a>
      </div> 
     <div id="model" class="item">MODLE 
            <a href="#" onclick=add_dir('model') class="a2">+</a>
      </div>
     <div id="view" class="item">VIEW 
            <a href="#" onclick=add_dir('view') class="a2">+</a>
      </div>
     <div id="db"class="item">DB <a href="#" class="a2">+</a>
     </div>

</div>
<!-- 编辑器 -->
         <!-- 编辑器ctrl  new -->
             <div id ='edit_ctr_new' > 
                        <span class ='span2' >Name</span> 
                              <input class ='input2'  onchange= edit_ctr_name_change()  type='text'></input> <br>                
                        <span class ='span2'> Action</span>
                               <input class ='input2'  type='text'></input> <a href="#ai"  onclick =edit_ctr_action_add() class = 'a2' >+</a><br>
                        <span class ='span2'> Descriptor</span>
                               <input class ='input2'  type='text'></input> 
                        <br>
                   <div id = 'edit_ctr_desc'> <!-- ctr 描述 -->
                        <a class = 'a4' > CTRL NAME:</a>
                        <span id ='edit_ctr_desc_name'>
                        </span><br>
                        <a class = 'a4' > ACTION LIST:</a><br>
                                <textarea id = 'edit_ctr_desc_action'> 
                                      <!--记录 action list -->
                                </textarea>
                 </div>
                 <a href="#ai"  class = 'a2' onclick = new_file_submit()    >OK</a>
                 <a href="#ai"  class = 'a2' onclick = ctr_reset()              >RESET</a>
                 <a href="#ai"  class = 'a2' onclick = newfilecancel()       >CANCEL</a>
            </dir>
   <!--     <div id = "E_action" class ="border02 edit"> ACTION<br>
                <toolbar>
                      <a href="#ai"  class="a2">NEW</a>
                      <a href="#ai"  class="a2">SAVE</a>
                      <a href="#ai"  class="a2">REST</a>
                </toolbar>

        </div>
        <div id = "E_db" class ="border02 edit ">
            DB
        </div>
        <div id = "E_model" class ="border02 edit">
             MODLE
        </div>

        <div id = "E_tem" class ="border02 edit ">
           TEMPLATE 
        </div> -->
    </div>  
<!--   模板   -->
     <div id="template"class="item">TEMPLATE
            <a href="#" onclick=add_dir('template') class="a2">+</a>
      </div>

</div>
<br> 
<!-- 隐藏窗口-->
<div id = "newdir" >NEW DIR<br>
     <input id ="newdirinput" value ="新文件夹"> </input>
     <input id ="newdirinputpath" type =' hidden' value =""> </input>
     <a href="#ai" class ='a1' onclick = newdirsubmit();>OK</a>
     <a href="#ai" class ='a1' onclick = newdircancel();>CANCEL</a>
</div>





</body>
</html>
