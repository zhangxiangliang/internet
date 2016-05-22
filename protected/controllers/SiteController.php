<?php
/**
 * Created by PhpStorm.
 * User: admin
 */
class SiteController extends CController
{

    public function actionIndex()
    {
        // 2016-5-22 2:21 PM
        // $this->layout='//layouts/empyt';
        // $this->render('index');

        $model =new StudentLoginForm();
        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['StudentLoginForm']))
        {
            $model->attributes=$_POST['StudentLoginForm'];
            // validate user input and redirect to the previous page if valid.
            if($model->validate() && $model->login())
                $this->redirect(Yii::app()->baseUrl.'/student/index');
        }
        $action = 'StudentLogin';
        $target = 'student';
        // display the login form
        $this->render('index',array('model'=>$model,'action'=>$action,'target'=>$target));
    }


    public function actionStudentLogin()
    {
        $model =new StudentLoginForm();
        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['StudentLoginForm']))
        {
            $model->attributes=$_POST['StudentLoginForm'];
            // validate user input and redirect to the previous page if valid.
            if($model->validate() && $model->login())
                $this->redirect(Yii::app()->baseUrl.'/student/index');

        }
        $action = 'StudentLogin';
        $target = 'student';
        // display the login form
        $this->render('login',array('model'=>$model,'action'=>$action,'target'=>$target));
    }

    public function actionTeacherLogin()
    {
        $model =new TeacherLoginForm();
        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['TeacherLoginForm']))
        {
            $model->attributes=$_POST['TeacherLoginForm'];
            // validate user input and redirect to the previous page if valid.
            if($model->validate() && $model->login())
                $this->redirect(Yii::app()->baseUrl.'/teacher/index');

        }
        $action = 'Teacherlogin';
        $target = 'teacher';
        // display the login form
        $this->render('login',array('model'=>$model,'action'=>$action,'target'=>$target));
    }

    public function actionAdminLogin()
    {
        $model =new AdminLoginForm();
        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['AdminLoginForm']))
        {
            $model->attributes=$_POST['AdminLoginForm'];
            // validate user input and redirect to the previous page if valid.
            if($model->validate() && $model->login())
                $this->redirect(Yii::app()->baseUrl.'/background/index');
        }
        $action = 'AdminLogin';
        $target = 'admin';
        // display the login form
        $this->render('login',array('model'=>$model,'action'=>$action,'target'=>$target));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect('/site/index');
    }
}