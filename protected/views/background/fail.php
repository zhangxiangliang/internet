<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0, width=device-width, user-scalable=no">
    <link rel="stylesheet" href="/css/internet-back.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <title>互联网+ 后台管理系统</title>
</head>
<body>
    <?php $baseUrl = Yii::app()->request->baseUrl;?>
    <div id="content">
        <header id="header">
            <div class="container">
                <h1>互联网+</h1>
                <h2>实践基地实训后台管理系统</h2>
            </div>
        </header>
        <div class="container">
            <a href="#nav" class="open toggle-btn">
                <i class="fa fa-reorder"></i>
            </a>
            <nav id="nav">
                <ul>
                    <li><a href="/background/StudentInfo/">学生管理</a></li>
                    <li><a href="/background/TeacherInfo/">教师管理</a></li>
                    <li><a href="/background/CoursesList/">课程管理</a></li>
                    <li><a href="/background/index/">个人信息</a></li>
                    <li><a href="/site/logout/">退出</a></li>
                    <a href="#top" class="close toggle-btn"><i class="fa fa-remove"></i></a>
                </ul>
            </nav>
            <!-- 主体 -->
            <div id="mainbody" class="clean">
                <div class="message red">
                    <h3>错误行为</h3>
                    <p><?php echo isset($message)?$message:'操作失败！' ?></p>
                    <p>该页将在 <span id='setouttime'>3</span>秒后自动跳转!</p>
                    <div class="btns">
                        <a href="<?php echo $baseUrl.$url;?>" class="btn red">原页面</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer id="footer" style="clear: both;">
        <div class="container">
            <h5>&copy; Copyright 互联网+ </h5>
        </div>
    </footer>
    <script language=javascript>
        var int=self.setInterval("countdown()",1000);
        function countdown(){
            var t=document.getElementById("setouttime").innerHTML-1;
            document.getElementById("setouttime").innerHTML=t;
            if(t===0){
                location='<?php echo $baseUrl.$url?>';
            }
        }
    </script>
</body>
</html>