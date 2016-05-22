<?php
class Student extends CActiveRecord
{
    public $username;
    public $password;

    public function tableName()
    {
        return 'student';
    }

    public function rules()
    {
        return array(
            array('username,password,student_id','safe'),
        );
    }

    public function getModelByName($name){
        $cri = new CDbCriteria();
        $cri->compare('username',$name);
        return $model = self::model()->find($cri);
    }

    //根据主键id获取名称
    public static function getNameById($id){
        $model = self::model()->findByPk($id);
        if(!empty($model)){
            return $model->username;
        }
        return null;
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

}

