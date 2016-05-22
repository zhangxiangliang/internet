<!DOCTYPE html>
<html lang="en">
<?php $baseUrl = Yii::app()->request->baseUrl;?>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1.0, width=device-width, user-scalable=no">
	<link rel="stylesheet" href="<?php echo $baseUrl;?>/css/internet.css">
	<title>互联网 - 带你探索代码的世界</title>
</head>
<body>
	<header id="header">
        <div class="container">
            <h2>互联网+ 实践基地实训后台管理系统</h2>
        </div>
    </header>
	<div class="body">
        <div class="btns inline">
        	<?php if($action == 'StudentLogin') { ?>
	            <a href="studentLogin" class="btn three active">学生登陆</a>
	            <a href="teacherLogin" class="btn three">教师登陆</a>
	            <a href="adminLogin" class="btn three">管理员登陆</a>
			<?php } else if($action == 'Teacherlogin') {?>
	            <a href="studentLogin" class="btn three">学生登陆</a>
	            <a href="teacherLogin" class="btn three active">教师登陆</a>
	            <a href="adminLogin" class="btn three">管理员登陆</a>
			<?php } else if($action == 'AdminLogin') {?>
	            <a href="studentLogin" class="btn three">学生登陆</a>
	            <a href="teacherLogin" class="btn three">教师登陆</a>
	            <a href="adminLogin" class="btn three active">管理员登陆</a>
			<?php } ?>
        </div>
        <?php $form=$this->beginWidget('CActiveForm', array( 'id'=>'login-form', 'enableClientValidation'=>true, 'clientOptions'=>array( 'validateOnSubmit'=>true, ), 'action'=>'/site/'.$action)); ?>
	        <?php echo $form->error($model,'username'); ?>
            <?php echo $form->error($model,'password'); ?>
            <div class="form-group">
                <?php echo $form->textField($model,'username', ['placeholder' => '请输入帐号']); ?>
            </div>
            <div class="form-group">
                <?php echo $form->passwordField($model,'password', ['placeholder' => '请输入密码']); ?>
            </div>
            <div class="btns">
                <?php echo CHtml::submitButton( '登陆',$htmlOptions=array ('class'=>'btn inline')); ?>
            </div>
        <?php $this->endWidget(); ?>
    </div>
</body>
</html>