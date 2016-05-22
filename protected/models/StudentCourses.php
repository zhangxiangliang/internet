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
}

