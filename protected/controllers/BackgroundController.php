<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 16-5-1
 * Time: 下午5:21
 */
class BackgroundController extends CController{


    public function actionIndex(){
        //后台验证权限
        $this->beforeValidate();
        $user = Admin::getModelByName(Yii::app()->user->__id);
        $this->render('index',array('user'=>$user));
    }


    public function actionCoursesList(){
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
        ));

    }

    /**
     * 管理员退选学生
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
            $this->render('fail',array('message'=>'退选失败,请重试','url'=>'/Background/SearchCoursesStudent?id='.$coursesId));
            Yii::app()->end();
        }
        if(!$model->delete()){
            $this->render('fail',array('message'=>'退选失败,请重试','url'=>'/Background/SearchCoursesStudent?id='.$coursesId));
            Yii::app()->end();
        }
        $courses = Courses::getModelById($coursesId);
        $courses->has_num -= 1;
        $courses->save();

        $this->render('success',array('message'=>'退选成功','url'=>'/Background/SearchCoursesStudent?id='.$coursesId));
        Yii::app()->end();

    }

    /*
     * 学生信息
     */
    public function actionStudentInfo(){
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

    /*
     * 教师信息
     */
    public function actionTeacherInfo(){
        //后台验证权限
        $this->beforeValidate();
        //每页数据量
        $pageSize = 10;
        //分页插件配置
        $criteria = new CDbCriteria();
        $form = new TeacherForm();
        if(isset($_POST['TeacherForm'])){
            if(isset($_POST['TeacherForm']['username'])){
                $criteria->compare('username',$_POST['TeacherForm']['username'],true);
            }
        }
        $count = Teacher::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = $pageSize;
        $pager->applyLimit($criteria);
        $teacher = Teacher::model()->findAll($criteria);

        $this->render('teacher_show',array(
            'teacher'=>$teacher,
            'pages'=>$pager,
            'count'=>$count,
            'model'=>$form,
        ));
    }

    public function actionUpdateTeacherInfo(){
        //后台验证权限
        $this->beforeValidate();
        //更新教师信息
        $teacherId = $_GET['id'];
        $model = Teacher::model()->findByPk($teacherId);

        $formModel = new TeacherForm();
        if(isset($_POST['TeacherForm'])){
            $formModel->setAttributes($_POST['TeacherForm']);
            $model->username = $formModel->username;
            $model->job_number = $formModel->job_number;
            $model->introduction = $formModel->introduction;
            // var_dump($formModel->introduction);die();

            if(!empty($formModel->password)){
                $model->password = md5($formModel->password);
            }
            if(!$model->update()){
                $this->render('fail',array('message'=>'更新失败，请重试','url'=>'/background/teacherInfo'));
                Yii::app()->end();
            }
            $this->render('success',array('message'=>'更新成功','url'=>'/background/teacherInfo'));
            Yii::app()->end();

        }
        //获取旧数据
        $formModel->username = $model->username;
        $formModel->job_number = $model->job_number;
        $formModel->introduction = $model->introduction;
        $this->render('teacher_create',array('model'=>$formModel));
    }

    public function actionUpdateStudentInfo(){
        //后台验证权限
        $this->beforeValidate();
        //更新学生信息
        $studentId = $_GET['id'];
        $model = Student::model()->findByPk($studentId);
        $formModel = new StudentForm();
        if(isset($_POST['StudentForm'])){
            $formModel->setAttributes($_POST['StudentForm']);
            $model->username = $formModel->username;
            $model->student_id = $formModel->student_id;
            if(!empty($formModel->password)){
                $model->password = md5($formModel->password);
            }
            if(!$model->update()){
                $this->render('fail',array('message'=>'更新失败，请重试','url'=>'/background/StudentInfo'));
                Yii::app()->end();
            }
            $this->render('success',array('message'=>'更新成功','url'=>'/background/StudentInfo'));
            Yii::app()->end();

        }
        //获取旧数据
        $formModel->username = $model->username;
        $formModel->student_id = $model->student_id;
        $this->render('student_create',array('model'=>$formModel));
    }

    public function actionDelStudentInfo(){
        //后台验证权限
        $this->beforeValidate();
        //删除学生信息
        $studentId = $_GET['id'];
        $student = Student::model()->findByPk($studentId);
        if(!$student->delete()){
            $this->render('fail',array('message'=>'删除失败，请重试','url'=>'/background/StudentInfo'));
            Yii::app()->end();
        }
        $this->render('success',array('message'=>'删除成功','url'=>'/background/StudentInfo'));
        Yii::app()->end();
    }

    public function actionDelTeacherInfo(){
        //后台验证权限
        $this->beforeValidate();
        //删除教师信息
        $teacherId = $_GET['id'];
        $teacher = Teacher::model()->findByPk($teacherId);

        if(!$teacher->delete()){
            $this->render('fail',array('message'=>'删除失败，请重试','url'=>'/background/TeacherInfo'));
            Yii::app()->end();
        }
        $this->render('success',array('message'=>'删除成功','url'=>'/background/TeacherInfo'));
        Yii::app()->end();
    }

    public function actionAddTeacherInfo(){
        //后台验证权限
        $this->beforeValidate();
        $formModel = new TeacherForm();
        if(isset($_POST['TeacherForm'])){
            $model = new Teacher();
            $model->setAttributes($_POST['TeacherForm']);
            $model->password = md5($model->password);  
            if(!$model->save()){
                $this->render('fail',array('message'=>'新增失败，请重试','url'=>'/background/TeacherInfo'));
                Yii::app()->end();
            }
            $this->render('success',array('message'=>'新增成功','url'=>'/background/TeacherInfo'));
            Yii::app()->end();
        }
        $this->render('teacher_create',array('model'=>$formModel));
    }

    /**
     * 导入学生信息
     */
    public function actionAddStudentInfo(){
        //后台验证权限
        $this->beforeValidate();
        $formModel = new StudentForm();
        if(isset($_POST['StudentForm'])){
            $model = new Student();
            $model->setAttributes($_POST['StudentForm']);
            $model->password = md5($model->password);
            if(!$model->save()){
                $this->render('fail',array('message'=>'新增失败，请重试','url'=>'/background/StudentInfo'));
                Yii::app()->end();
            }
            $this->render('success',array('message'=>'新增成功','url'=>'/background/StudentInfo'));
            Yii::app()->end();
        }
        $this->render('student_create',array('model'=>$formModel));
    }



    /**
     * 修改密码
     */
    public function actionChangePassword(){
        $model = new ChangePasswordForm();
        if(isset($_POST['ChangePasswordForm'])){
            //获取当前用户数据
            $user = Admin::model()->findByPk(Yii::app()->user->id);
            //表单填充
            $model->setAttributes($_POST['ChangePasswordForm']);
            //验证
            if(md5($model->password) != $user->password){
                $this->render('fail',array('message'=>'抱歉！密码错误！','url'=>'/background/index'));
                Yii::app()->end();
            }
            if($model->newPassword != $model->newPasswordAgain){
                $this->render('fail',array('message'=>'抱歉！新密码不一致！','url'=>'/background/index'));
                Yii::app()->end();
            }
            //保存新密码
            $user->password = md5($model->newPassword);
            if(!$user->update()){
                $this->render('fail',array('message'=>'抱歉！密码修改失败，请重试！','url'=>'/background/index'));
                Yii::app()->end();
            }
            $this->render('success',array('message'=>'密码修改成功！','url'=>'/background/index'));
            Yii::app()->end();

        }
        $this->render('change_password',array('model'=>$model));
    }

    public function beforeValidate(){
        if(isset(Yii::app()->user->level)){
            if(Yii::app()->user->level === 'Admin'){
                return true;
            }
        }
        $this->render('fail',array('message'=>'对不起，您没有权限','url'=>'/site/index'));
        Yii::app()->end();
    }

    public function actionAddCourses(){
        //新增课程
        $formModel = new CoursesForm();
        if(isset($_POST['CoursesForm'])){
            $courses = new Courses();
            $courses->setAttributes($_POST['CoursesForm']);
            $courses->teacher_id = Teacher::getIdByJobNumber($_POST['CoursesForm']['job_number']);
            if(empty($courses->teacher_id)){
                $this->render('fail',array('message'=>'查询不到教师信息，请重试','url'=>'/background/CoursesList'));
                Yii::app()->end();
            }
            if(!$courses->save()){
                $this->render('fail',array('message'=>'新增失败，请重试','url'=>'/background/CoursesList'));
                Yii::app()->end();
            }
            $this->render('success',array('message'=>'新增成功','url'=>'/background/CoursesList'));
            Yii::app()->end();
        }
        $this->render('courses_create',array('model'=>$formModel));
    }

    public function actionUpdateCourses(){
        //后台验证权限
        $this->beforeValidate();
        //修改课程信息
        $coursesId = $_GET['id'];
        $model = Courses::model()->findByPk($coursesId);
        $formModel = new CoursesForm();
        if(isset($_POST['CoursesForm'])){
            $model->setAttributes($_POST['CoursesForm']);
            //赋值
            $model->teacher_id = Teacher::getIdByJobNumber($_POST['CoursesForm']['job_number']);
            if(!$model->update()){
                $this->render('fail',array('message'=>'更新失败，请重试','url'=>'/background/CoursesList'));
                Yii::app()->end();
            }
            $this->render('success',array('message'=>'更新成功','url'=>'/background/CoursesList'));
            Yii::app()->end();

        }
        //获取旧数据
        $formModel->setAttributes($model->getAttributes());
        $formModel->job_number = Teacher::model()->findByPk($formModel->teacher_id)->job_number;
        $this->render('courses_create',array('model'=>$formModel));
    }

    public function actionDelCourses(){
        //后台验证权限
        $this->beforeValidate();
        //删除课程信息
        $coursesId = $_GET['id'];
        $courses = Courses::model()->findByPk($coursesId);

        if(!$courses->delete()){
            $this->render('fail',array('message'=>'删除失败，请重试','url'=>'/background/CoursesList'));
            Yii::app()->end();
        }
        $this->render('success',array('message'=>'删除成功','url'=>'/background/CoursesList'));
        Yii::app()->end();
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
}