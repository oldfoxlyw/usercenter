<?php

class UserController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	const USER_LOGIN_SUCCESS = 1;
	const USER_LOGIN_ERROR_AUTH_FAIL = 1008;
	const USER_LOGIN_ERROR_NO_PARAM = 1009;

	const USER_REGISTER_SUCCESS = 1;
	const USER_REGISTER_ERROR_DUPLICATED = 2007;
	const USER_REGISTER_ERROR_AUTH_FAIL = 2008;
	const USER_REGISTER_ERROR_NO_PARAM = 2009;

	public function login()
	{
		$username = Input::get('username');
		$password = Input::get('password');

		if(!empty($username) && !empty($password))
		{
			if(Auth::attempt(array(
				'username'		=>	$username,
				'password'		=>	$password
			)))
			{
				$user = Auth::user();
				$user->login_at = time();
				$user->save();

				return Response::json(array(
					'success'	=>	1,
					'code'		=>	UserController::USER_LOGIN_SUCCESS,
					'user'		=>	$user
				));
			}
			else
			{
				return Response::json(array(
					'success'	=>	0,
					'code'		=>	UserController::USER_LOGIN_ERROR_AUTH_FAIL
				));
			}
		}
		else
		{
			return Response::json(array(
				'success'	=>	0,
				'code'		=>	UserController::USER_LOGIN_ERROR_NO_PARAM
			));
		}
	}

	public function register()
	{
		$username = Input::get('username');
		$password = Input::get('password');

		if(!empty($username) && !empty($password))
		{
			$userCount = User::where('username', '=', $username)->count();
			if(empty($userCount))
			{
				$time = time();
				$user = new User;
				$user->username = $username;
				$user->password = Hash::make($password);
				$user->email = '';
				$user->login_at = $time;
				$user->register_at = $time;
				$user->save();

				return Response::json(array(
					'success'	=>	1,
					'code'		=>	UserController::USER_REGISTER_SUCCESS,
					'user'		=>	$user
				));
			}
			else
			{
				return Response::json(array(
					'success'	=>	0,
					'code'		=>	UserController::USER_REGISTER_ERROR_DUPLICATED
				));
			}
		}
		else
		{
			return Response::json(array(
				'success'	=>	0,
				'code'		=>	UserController::USER_REGISTER_ERROR_NO_PARAM
			));
		}
	}

}
