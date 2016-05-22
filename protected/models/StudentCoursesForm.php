<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class StudentCoursesForm extends CFormModel
{
	public $student_id;
    public $courses_id;
    public $score;


	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('student_id,courses_id,score', 'safe'),
		);
	}

}
