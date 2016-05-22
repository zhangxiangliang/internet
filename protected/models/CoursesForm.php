<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class CoursesForm extends CFormModel
{
	public $name;
    public $begintime;
    public $endtime;
    public $address;
    public $teacher_id;
    public $job_number;
    public $num;
    public $has_num;


	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('name,begintime,endtime,address,teacher_id,job_number,num,has_num', 'safe'),
		);
	}

}
