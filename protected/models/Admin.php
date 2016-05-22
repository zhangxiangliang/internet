<?php
class Admin extends CActiveRecord
{

    public function tableName()
    {
        return 'admin';
    }

    public function rules()
    {
        return array(
        );
    }

    public function getModelByName($name){
        $cri = new CDbCriteria();
        $cri->compare('username',$name);
        return $model = self::model()->find($cri);
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

}

