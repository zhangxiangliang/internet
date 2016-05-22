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
    <div class="header">
        <div class="banner">
            <h1 class="white">互联网+</h1>
            <h3 class="white">修改密码</h3>
            <div class="login">
                <?php $form=$this->beginWidget('CActiveForm', array( 'id'=>'login-form', 'enableClientValidation'=>true, 'clientOptions'=>array( 'validateOnSubmit'=>true, ), )); ?>
                <div class="form-group">
                    <?php echo $form->passwordField($model,'password',['placeholder'=>'旧密码']); ?>
                    <?php echo $form->error($model,'password'); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->passwordField($model,'newPassword',['placeholder'=>'新密码']); ?>
                    <?php echo $form->error($model,'newPassword'); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->passwordField($model,'newPasswordAgain',['placeholder'=>'重复新密码']); ?>
                    <?php echo $form->error($model,'newPasswordAgain'); ?>
                </div>
                <div class="btns">
                    <?php echo CHtml::submitButton( '提交',$htmlOptions=array ('class'=>'btn blue')); ?>
                </div>
                <?php $this->endWidget(); ?>          
            </div>
        </div>
    </div>
</body>
</html>