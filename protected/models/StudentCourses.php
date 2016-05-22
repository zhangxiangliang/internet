<?php
class StudentCourses extends CActiveRecord
{

    public function tableName()
    {
        return 'student_courses';
    }

    public function rules()
    {
        return array(
        );
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public static function getIdByStudentIdAndCoursesId($student_id,$courses_id){
        $cri = new CDbCriteria();
        $cri->compare('student_id',$student_id);
        $cri->compare('courses_id',$courses_id);
        $model = self::model()->find($cri);
        return $model->id;
    }

    public static function getScoreByStudentIdAndCoursesId($student_id,$courses_id){
        $cri = new CDbCriteria();
        $cri->compare('student_id',$student_id);
        $cri->compare('courses_id',$courses_id);
        $model = self::model()->find($cri);
        return $model->score;
    }
}

