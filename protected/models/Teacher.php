<?php
class Teacher extends CActiveRecord
{
    public $username;
    public $password;
    public $job_number;
    public $introduction;

    public function tableName()
    {
        return 'teacher';
    }

    public function rules()
    {
        return array(
            array('username,password,job_number,introduction', 'safe'),
        );
    }

    //根据主键id获取名称
    public static function getNameById($id){
        $model = self::model()->findByPk($id);
        if(!empty($model)){
            return $model->username;
        }
        return null;
    }


    public function getModelByName($name){
        $cri = new CDbCriteria();
        $cri->compare('username',$name);
        return $model = self::model()->find($cri);
    }

    public static function getIdByJobNumber($jobNumber){
        $cri = new CDbCriteria();
        $cri->compare('job_number',$jobNumber);
        $model = self::model()->find($cri);
        if(!empty($model)){
            return $model->id;
        }
        return null;
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

}

