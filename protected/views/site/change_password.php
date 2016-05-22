<div>
    <div>

        <h1>修改密码</h1>
        <div class="form">
            <?php $form=$this->beginWidget('CActiveForm', array( 'id'=>'login-form', 'enableClientValidation'=>true, 'clientOptions'=>array( 'validateOnSubmit'=>true, ), )); ?>
            <div>
                <?php echo $form->labelEx($model,'旧密码'); ?>
                <?php echo $form->passwordField($model,'password'); ?>
                <?php echo $form->error($model,'password'); ?>
            </div>


            <div>
                <?php echo $form->labelEx($model,'新密码'); ?>
                <?php echo $form->passwordField($model,'newPassword'); ?>
                <?php echo $form->error($model,'newPassword'); ?>
            </div>
            <div>
                <?php echo $form->labelEx($model,'重复新密码'); ?>
                <?php echo $form->passwordField($model,'newPasswordAgain'); ?>
                <?php echo $form->error($model,'newPasswordAgain'); ?>
            </div>



            <div class="buttons">
                <?php echo CHtml::submitButton( '提交',$htmlOptions=array ('class'=>'btn btn-primary')); ?>
            </div>

            <?php $this->endWidget(); ?>
        </div>
    </div>
    <!-- form -->
</div>