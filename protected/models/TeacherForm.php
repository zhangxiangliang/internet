<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class TeacherForm extends CFormModel
{
	public $username;
    public $password;
    public $job_number;
    public $introduction;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username,password,job_number,introduction', 'safe'),
		);
	}

}
