<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 16-5-1
 * Time: 下午2:48
 */
class TeacherController extends CController{

    public function beforeValidate(){
        if(isset(Yii::app()->user->level)){
            if(Yii::app()->user->level === 'Teacher'){
                return true;
            }
        }
        $this->render('fail',array('message'=>'对不起，您没有权限','url'=>'/site/index'));
        Yii::app()->end();
    }


    public function actionIndex(){
        //后台验证权限
        $this->beforeValidate();
        $user = Teacher::getModelByName(Yii::app()->user->__id);
        $this->render('index',array('user'=>$user));
    }

    /**
     * 修改密码
     */
    public function actionChangePassword(){
        $model = new ChangePasswordForm();
        if(isset($_POST['ChangePasswordForm'])){
            //获取当前用户数据
            $user = Teacher::model()->findByPk(Yii::app()->user->id);
            //表单填充
            $model->setAttributes($_POST['ChangePasswordForm']);
            //验证
            if(md5($model->password) != $user->password){
                $this->render('fail',array('message'=>'抱歉！密码错误！','url'=>'/Teacher/index'));
                Yii::app()->end();
            }
            if($model->newPassword != $model->newPasswordAgain){
                $this->render('fail',array('message'=>'抱歉！新密码不一致！','url'=>'/Teacher/index'));
                Yii::app()->end();
            }
            //保存新密码
            $user->password = md5($model->newPassword);
            if(!$user->update()){
                $this->render('fail',array('message'=>'抱歉！密码修改失败，请重试！','url'=>'/Teacher/index'));
                Yii::app()->end();
            }
            $this->render('success',array('message'=>'密码修改成功！','url'=>'/Teacher/index'));
            Yii::app()->end();

        }
        $this->render('change_password',array('model'=>$model));
    }
    /*
     * 查询教师信息
     */
    public function actionInfoTeacher() {
        // 权限验证
        $this->beforeValidate();
        
        // 获取教师信息
        $teacher_id = $_GET['id'];
        $teacher = Teacher::model()->findByPk($teacher_id);

        // 获取教师的课程信息
        $criteria = new CDbCriteria();
        $criteria->compare('teacher_id',$teacher_id);
        $courses = Courses::model()->findAll($criteria);

        // 渲染
        $this->render('teacher_info',array(
            'teacher' => $teacher,
            'courses' => $courses,
        ));
    }
    //录入成绩列表
    public function actionNeedEnterScoreList(){
        //后台验证权限
        $this->beforeValidate();

        //每页数据量
        $pageSize = 10;
        //分页插件配置
        $criteria = new CDbCriteria();
        $form = new CoursesForm();
        if(isset($_POST['CoursesForm'])){
            if(isset($_POST['CoursesForm']['name'])){
                $criteria->compare('name',$_POST['CoursesForm']['name'],true);
            }
        }
        $teacher_id = Yii::app()->user->id;
        $criteria->join = 'JOIN `courses` ON `courses`.`id` = `t`.`courses_id`';
        $criteria->compare('courses.teacher_id',$teacher_id);
        $criteria->compare('teacher_id',$teacher_id);
        $count = StudentCourses::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = $pageSize;
        $pager->applyLimit($criteria);
        $courses = StudentCourses::model()->findAll($criteria);

        $this->render('need_enter_score_list',array(
            'courses'=>$courses,
            'pages'=>$pager,
            'count'=>$count,
            'model'=>$form
        ));
    }

    /*
     * 教师录入成绩
     */
    public function actionEnterScore(){
        //后台验证权限
        $this->beforeValidate();
        //获取当前操作的数据
        $id = $_GET['id'];
        //学生课程关联数据
        $studentCourses = StudentCourses::model()->findByPk($id);
        //课程
        $courses = Courses::model()->findByPk($studentCourses->courses_id);
        //学生
        $student = Student::model()->findByPk($studentCourses->student_id);
        //表单
        $formModel = new StudentCoursesForm();
        if(isset($_POST['StudentCoursesForm'])){
            $formModel->setAttributes($_POST['StudentCoursesForm']);
            $studentCourses->score = $formModel->score;
            if(!$studentCourses->save()){
                $this->render('fail',array('message'=>'保存成绩失败，请重试','url'=>'/Teacher/SearchCoursesStudent?id='.$studentCourses->courses_id));
                Yii::app()->end();
            }
            $this->render('success',array('message'=>'保存成绩成功','url'=>'/Teacher/SearchCoursesStudent?id='.$studentCourses->courses_id));
            Yii::app()->end();

        }
        if($studentCourses->score != null){
            $formModel->score = $studentCourses->score;
        }
        $this->render('enter_score',array(
            'model'=>$formModel,
            'student'=>$student,
            'courses'=>$courses
        ));
    }

    /**
     * 教师查询课程
     */
    public function actionSearchCourses(){
        //后台验证权限
        $this->beforeValidate();
        //每页数据量
        $pageSize = 10;
        //分页插件配置
        $criteria = new CDbCriteria();
        $form = new CoursesForm();
        if(isset($_POST['CoursesForm'])){
            if(isset($_POST['CoursesForm']['name'])){
                $criteria->compare('name',$_POST['CoursesForm']['name'],true);
            }
        }
        $teacher_id = Yii::app()->user->id;
        $criteria->compare('teacher_id',$teacher_id);
        $count = Courses::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = $pageSize;
        $pager->applyLimit($criteria);
        $courses = Courses::model()->findAll($criteria);

        $this->render('courses_show',array(
            'courses'=>$courses,
            'pages'=>$pager,
            'count'=>$count,
            'model'=>$form
        ));
    }

    // 课程信息
    public function actionInfoCourse() {
        //后台验证权限
        $this->beforeValidate();

         //获取课程
        $course_id = $_GET['id'];
        $course = Courses::getModelById($course_id);

        // 获取教师信息
        $teacher = Teacher::model()->findByPk($course->teacher_id);

        $this->render('course_info',array(
            'course' => $course,
            'teacher' => $teacher
        ));
    }

    /**
     * 查询某个课程的学生
     */
    public function actionSearchCoursesStudent(){
        //后台验证权限
        $this->beforeValidate();
        $coursesId  = $_GET['id']; //获取课程id
        $cri = new CDbCriteria();
        $cri->compare('courses_id',$coursesId);
        $model = StudentCourses::model()->findAll($cri);
        $studentArr = array();
        foreach($model as $key => $val){
            $studentArr[] = $val->student_id;
        }
        //每页数据量
        $pageSize = 10;
        //分页插件配置
        $criteria = new CDbCriteria();
        $form = new StudentForm();
        if(isset($_POST['StudentForm'])){
            if(isset($_POST['StudentForm']['username'])){
                $criteria->compare('username',$_POST['StudentForm']['username'],true);
            }
        }
        $criteria->addInCondition('id',$studentArr);
        $count = Student::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = $pageSize;
        $pager->applyLimit($criteria);
        $student = Student::model()->findAll($criteria);

        $this->render('student',array(
            'student'=>$student,
            'coursesId'=>$coursesId,
            'pages'=>$pager,
            'count'=>$count,
            'model'=>$form
        ));

    }

    /**
     * 教师退选学生
     */
    public function actionDeleteStudent(){
        //后台验证权限
        $this->beforeValidate();
        $studentId = $_GET['student_id'];
        $coursesId = $_GET['courses_id'];
        $cri = new CDbCriteria();
        $cri->compare('t.courses_id',$coursesId);
        $cri->join = "Join `student` as `s` on `s`.`student_id` = $studentId ";
        $cri->addCondition('t.student_id = s.id');
        $model = StudentCourses::model()->find($cri);
        if(empty($model)){
            $this->render('fail',array('message'=>'退选失败,请重试','url'=>'/Teacher/SearchCoursesStudent?id='.$coursesId));
            Yii::app()->end();
        }
        if(!$model->delete()){
            $this->render('fail',array('message'=>'退选失败,请重试','url'=>'/Teacher/SearchCoursesStudent?id='.$coursesId));
            Yii::app()->end();
        }
        $courses = Courses::getModelById($coursesId);
        $courses->has_num -= 1;
        $courses->save();

        $this->render('success',array('message'=>'退选成功','url'=>'/Teacher/SearchCoursesStudent?id='.$coursesId));
        Yii::app()->end();

    }

    /**
     * 教师查询学生
     */
    public function actionSearchStudent(){
        //后台验证权限
        $this->beforeValidate();
        //每页数据量
        $pageSize = 10;
        //分页插件配置
        $criteria = new CDbCriteria();
        $form = new StudentForm();
        if(isset($_POST['StudentForm'])){
            if(isset($_POST['StudentForm']['username'])){
                $criteria->compare('username',$_POST['StudentForm']['username'],true);
            }
        }
        $count = Student::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = $pageSize;
        $pager->applyLimit($criteria);
        $student = Student::model()->findAll($criteria);

        $this->render('student_show',array(
            'student'=>$student,
            'pages'=>$pager,
            'count'=>$count,
            'model'=>$form
        ));

    }

}