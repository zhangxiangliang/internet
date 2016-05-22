<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 16-5-1
 * Time: 下午2:48
 */
class StudentController extends CController{

    public function beforeValidate(){
        if(isset(Yii::app()->user->level)){
            if(Yii::app()->user->level === 'Student'){
                return true;
            }
        }
        $this->render('fail',array('message'=>'对不起，您未登入或者没有权限','url'=>'/site/index'));
        Yii::app()->end();
    }

    public function actionIndex(){
        //后台验证权限
        $this->beforeValidate();
        $user = Student::getModelByName(Yii::app()->user->__id);
        $this->render('index',array('user'=>$user));
    }

    /**
     * 修改密码
     */
    public function actionChangePassword(){
        $model = new ChangePasswordForm();
        if(isset($_POST['ChangePasswordForm'])){
            //获取当前用户数据
            $user = Student::model()->findByPk(Yii::app()->user->id);
            //表单填充
            $model->setAttributes($_POST['ChangePasswordForm']);
            //验证
            if(md5($model->password) != $user->password){
                $this->render('fail',array('message'=>'抱歉！密码错误！','url'=>'/Student/index'));
                Yii::app()->end();
            }
            if($model->newPassword != $model->newPasswordAgain){
                $this->render('fail',array('message'=>'抱歉！新密码不一致！','url'=>'/Student/index'));
                Yii::app()->end();
            }
            //保存新密码
            $user->password = md5($model->newPassword);
            if(!$user->update()){
                $this->render('fail',array('message'=>'抱歉！密码修改失败，请重试！','url'=>'/Student/index'));
                Yii::app()->end();
            }
            $this->render('success',array('message'=>'密码修改成功！','url'=>'/Student/index'));
            Yii::app()->end();

        }
        $this->render('change_password',array('model'=>$model));
    }

    /*
     * 查询课程
     */
    public function actionSearchCourses(){
        //后台验证权限
        $this->beforeValidate();
        //学生id
        $student_id = Yii::app()->user->id;
        //获取该学生的所有课程
        //每页数据量
        $pageSize = 10;
        //分页插件配置
        $criteria = new CDbCriteria();
        $form = new CoursesForm();
        if(isset($_POST['CoursesForm'])){
            if(isset($_POST['CoursesForm']['name'])){
                $criteria->join = 'JOIN `courses` as `c` on `c`.`id` = `t`.`courses_id`';
                $criteria->compare('c.name',$_POST['CoursesForm']['name'],true);
            }
        }
        $criteria->compare('t.student_id',$student_id);
        $count = StudentCourses::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = $pageSize;
        $pager->applyLimit($criteria);
        $courses = StudentCourses::model()->findAll($criteria);

        $this->render('courses_show',array(
            'courses'=>$courses,
            'pages'=>$pager,
            'count'=>$count,
            'model'=>$form
        ));
    }

    public function actionStudentDelCourses(){
        //后台验证权限
        $this->beforeValidate();
        $coursesId = $_GET['id'];//获取课程
        $studentCourses = StudentCourses::model()->findByPk($coursesId);//选课关系
        $courses = Courses::getModelById($coursesId);//课程
        $courses->has_num -= 1; //已选-1
        if(!$courses->save() || !$studentCourses->delete()){
            $this->render('fail',array('message'=>'抱歉！退选失败，请重试','url'=>'/Student/searchCourses'));
            Yii::app()->end();
        }
        $this->render('success',array('message'=>'退选课程成功！','url'=>'/Student/searchCourses'));
        Yii::app()->end();
    }

    public function actionPublicCoursesList(){
        //后台验证权限
        $this->beforeValidate();
        //学生id
        $student_id = Yii::app()->user->id;
        //获取该学生已经选择的课程
        $cri = new CDbCriteria();
        $cri->compare('student_id',$student_id);
        $hasCourses = StudentCourses::model()->findAll($cri);
        $coursesArr = array();
        foreach($hasCourses as $val){
            $coursesArr[] = $val->courses_id;
        }

        //每页数据量
        $pageSize = 10;
        //分页插件配置
        $criteria = new CDbCriteria();
        $form = new CoursesForm();
        if(isset($_POST['CoursesForm'])){
            if(isset($_POST['CoursesForm']['name'])){
                $criteria->compare('name',$_POST['CoursesForm']['name'],true);
            }
        }else{
            $criteria->addNotInCondition('id',$coursesArr);
        }
        $nowTime = Date('Y-m-d',time());
        $criteria->addCondition(" begintime >= '$nowTime'");
        $count = Courses::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = $pageSize;
        $pager->applyLimit($criteria);
        $courses = Courses::model()->findAll($criteria);

        $this->render('public_courses_list',array(
            'courses'=>$courses,
            'pages'=>$pager,
            'count'=>$count,
            'model'=>$form
        ));
    }

    public function actionSelectCourses(){
        //后台验证权限
        $this->beforeValidate();
        //选择的课程信息
        $coursesId = $_GET['id'];
        $studentId = Yii::app()->user->id;
        $coureses = Courses::getModelById($coursesId);
        if($coureses->has_num>=$coureses->num){
            $this->render('fail',array('message'=>'该课程已无名额，请选择其他课程','url'=>'/Student/PublicCoursesList'));
            Yii::app()->end();
        }
        $model = new StudentCourses();
        $model->courses_id = $coursesId;
        $model->student_id = $studentId;
        if(!$model->save()){
            $this->render('fail',array('message'=>'选课失败，请重试','url'=>'/Student/PublicCoursesList'));
            Yii::app()->end();
        }
        $coureses->has_num += 1; //已选+1
        $coureses->save();
        $this->render('success',array('message'=>'选课成功!','url'=>'/Student/PublicCoursesList'));
        Yii::app()->end();
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
    /*
     * 查询教师
     */
    public function actionSearchTeacher(){
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
            'model'=>$form
        ));
    }


    /*
     * 查询成绩
     */
    public function actionSearchScore(){
        //后台验证权限
        $this->beforeValidate();
                //每页数据量
        $pageSize = 10;
        //分页插件配置
        $criteria = new CDbCriteria();
        $form = new CoursesForm();
        if(isset($_POST['CoursesForm'])){
            if(isset($_POST['CoursesForm']['name'])){
                $criteria->join = 'JOIN `courses` as `c` on `c`.`id` = `t`.`courses_id`';
                $criteria->compare('c.name',$_POST['CoursesForm']['name'],true);
            }
        }
        $student_id = Yii::app()->user->id;
        $criteria->compare('student_id',$student_id);
        $count = StudentCourses::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = $pageSize;
        $pager->applyLimit($criteria);
        $courses = StudentCourses::model()->findAll($criteria);

        $this->render('search_score',array(
            'courses'=>$courses,
            'pages'=>$pager,
            'count'=>$count,
            'model'=>$form
        ));
    }
}