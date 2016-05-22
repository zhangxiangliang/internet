<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-3-27
 * Time: 下午4:48
 */class LinkPage extends CLinkPager
{
    public function run()
    {
        $pageLinks = $this->createPagePreAndNext();
        $topPage = CHtml::tag('div', array('class'=>'topPage'), $pageLinks);
        $form = $this->createForm();
        $toPage = CHtml::tag('div', array('class'=>'toPage'), $form);
        echo CHtml::tag('div', array('class'=>'page'), $topPage.$toPage);
    }
    /**
     * @desc 创建向前和向后的链接
     * @return string a标签和span标签的html代码
     */
    private function createPagePreAndNext()
    {
        $links = '';
        if ($this->pages->getCurrentPage()>=1) {
            $links .= CHtml::link($this->prevPageLabel, $this->createPageUrl($this->pages->getCurrentPage()-1), array('class'=>'prePage'));
        } elseif (0 == $this->pages->getCurrentPage()) {
            $links .= CHtml::tag('span', array('class'=>'prePage'), $this->prevPageLabel);
        }
        $links .= CHtml::tag('span', array('class'=>'pageNum'), $this->pages->getCurrentPage()+1 . '/' . ($this->pages->getPageCount()?$this->pages->getPageCount():1));
        if ($this->pages->getCurrentPage()+1 < $this->pages->getPageCount()) {
            $links .= CHtml::link($this->nextPageLabel, $this->createPageUrl($this->pages->getCurrentPage()+1), array('class'=>'pgNxt'));
        } elseif($this->pages->getCurrentPage()+1 >= $this->pages->getPageCount()) {
            $links .= CHtml::tag('span', array('class'=>'pgNxt'), $this->nextPageLabel);
        }
        return $links;
    }
    /**
     * @desc 创建跳转表单
     * @return string form的html代码
     */
    private function createForm()
    {
        $form = '';
        $url = $this->createPageUrl(0);
        $form .= CHtml::beginForm($url, 'get');
        $form .= CHtml::tag('span', array(), '跳转到');
        $form .= CHtml::textField('page', '', array('class'=>'pageIn'));
        $form .= CHtml::tag('span', array(), '页');
        $form .= CHtml::tag('input', array('type'=>'submit', 'class'=>'pageSubBtn', 'value'=>'确定'));
        $form .= CHtml::endForm();
        return $form;
    }
    /**
     * @desc 创建分页url链接
     * @param int $page  链接指向的页数
     * @return string   url链接
     */
    public function createPageUrl($page)
    {
        if (is_null($this->pages->params)) {
            $this->pages->params = $_GET;
            foreach($this->pages->params as $key=>$value){
                if (stripos($key, '/') || stripos($key, '\\')) {//去掉键中包含有 / 或者 \ 的param
                    unset($this->pages->params[$key]);
                }
            }
        }
        return $this->pages->createPageUrl($this->getController(), $page);
    }
}