<?php
class Courses extends CActiveRecord
{
    public $name;
    public $begintime;
    public $endtime;
    public $address;
    public $teacher_id;
    public $num;
    public $has_num;

    public $job_number;

    public function tableName()
    {
        return 'courses';
    }

    public function rules()
    {
        return array(
            array('name,begintime,endtime,address,teacher_id,job_number,num,has_num','safe')
        );
    }

    //根据主键id获取名称
    public static function getNameById($id){
        $model = self::model()->findByPk($id);
        if(!empty($model)){
            return $model->name;
        }
        return null;
    }

    //根据主键id获取名称
    public static function getAddressById($id){
        $model = self::model()->findByPk($id);
        if(!empty($model)){
            return $model->address;
        }
        return null;
    }

    public static function getTeachNameByCoursesId($id){
        $model = self::model()->findByPk($id);
        if(empty($model)){
            return null;
        }
        return $teacher = Teacher::getNameById($model->teacher_id);
    }

    public static function getModelById($id){
        $cri = new CDbCriteria();
        $cri->compare('id',$id);
        return $model = self::model()->find($cri);
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }


}

