<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- 设置宽度为当前设备宽度，缩放倍数为1，禁止用户缩放 -->
    <meta name="viewport" content="initial-scale=1.0, width=device-width, user-scalable=no">
    <!-- 411er 引入后台专有样式 - internet-back.css -->
    <link rel="stylesheet" href="/css/internet-back.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <!-- 411er 填入当前页面名 -->
    <title>互联网+</title>
</head>
<body>
    <div id="content">
        <!-- 411er 后台页面的头部 -->
        <header id="header">
            <div class="container">
                <h1>互联网+</h1>
                <h2>实践基地实训管理系统</h2>
            </div>
        </header>

        <!-- 411er 后台页面的主体，包含导航 -->
        <div class="container">
            <!-- 小屏幕 导航按钮 -->
            <a href="#nav" class="open toggle-btn"><i class="fa fa-reorder"></i></a>
            <!-- 导航 -->
            <nav id="nav">
                <ul>
                    <li><a href="/background/StudentInfo/">学生管理</a></li>
                    <li><a href="/background/TeacherInfo/" class="active">教师管理</a></li>
                    <li><a href="/background/CoursesList/">课程管理</a></li>
                    <li><a href="/background/index/">个人信息</a></li>
                    <li><a href="/site/logout/">退出</a></li>
                    <a href="#top" class="close toggle-btn"><i class="fa fa-remove"></i></a>
                </ul>
            </nav>
            <!-- 表单 -->
            <div class="table">
                <h2>教师信息</h2>
                <?php $form=$this->beginWidget('CActiveForm', array( 'id'=>'login-form', 'enableClientValidation'=>true, 'clientOptions'=>array( 'validateOnSubmit'=>true, ), )); ?>
                <div>
                    <?php echo $form->labelEx($model,'姓名'); ?>
                    <?php echo $form->textField($model,'username'); ?>
                    <?php echo $form->error($model,'username'); ?>
                </div>
                <div>
                    <?php echo $form->labelEx($model,'工号'); ?>
                    <?php echo $form->textField($model,'job_number'); ?>
                    <?php echo $form->error($model,'job_number'); ?>
                </div>
                <div>
                    <?php echo $form->labelEx($model,'个人简介'); ?>
                    <?php echo $form->textArea($model,'introduction'); ?>
                    <?php echo $form->error($model,'introduction'); ?>
                </div>
                <div>
                    <?php echo $form->labelEx($model,'密码'); ?>
                    <?php echo $form->passwordField($model,'password'); ?>
                    <?php echo $form->error($model,'password'); ?>
                </div>
                <div class="btns">
                    <?php echo CHtml::submitButton( '提交',$htmlOptions=array ('class'=>'btn blue')); ?>
                </div>

                <?php $this->endWidget(); ?>           
            </div>
        </div>
    </div>
    <!-- 411er 后台页面的尾部 -->
    <footer id="footer" style="clear: both;">
        <div class="container">
            <h5>&copy; Copyright 互联网+ </h5>
        </div>
    </footer>
</body>
</html>