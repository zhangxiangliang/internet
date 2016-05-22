<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class TeacherUserIdentity extends UserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
        if(strlen($this->password) > 0)
            $this->password = md5($this->password);
        $user = Teacher::model()->findByAttributes(array('username' => $this->username));
        if($user == null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        elseif($user->password != $this->password)
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
        {
            $this->setState('id', $user->id);
            $this->setState('username', $user->username);
            $this->setState('level', 'Teacher');
            $user->save();
            $this->errorCode=self::ERROR_NONE;
        }
        return !$this->errorCode;
    }
}