<?php
/**
 * 轮播Url生成器
 * User: zbl
 * Date: 15-3-27
 * Time: 上午11:58
 */
class CarouselUrlFunction
{

    public function Url($model)
    {
        $type = null;
        $baseUrl = Yii::app()->request->baseUrl;

        if($model)
            $type = CommonFunction::videoType($model->mstv_type);
        if($type)
            $url = $baseUrl.'/'.$type.'/video/mstvId/'.$model->mstv_id;
        else
            $url = $baseUrl;
        return $url;
    }


}