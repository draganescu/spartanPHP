<?php
include dirname(__FILE__) . '/../system/controller.php';
class my extends the
{
	
	// singleton is the state of the app
	public static $instance;
	private $html = false;

	// add here any startup stuff you may need
	// the same can be accomplished with events (before_*)
	function json_header()
	{
		// in case i am lazy, this doesnt help in a json file
		$app = my::app();
		$app->lazy_debug = false;

		header('Cache-Control: no-cache, must-revalidate');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Content-type: application/json');
	}

	static function crypt_compare($encrypter, $encrypted, $decrypted)
	{
		$app = my::app();
		$app->log($encrypter($encrypted));
		$app->log($decrypted);
		if(!$encrypted or !$decrypted) return false;
		if($encrypted and $decrypted)
			if($encrypter($encrypted) == $decrypted) return true;
		return false;
	}

	/**
	* post data helper function
	* does not depend on curl
	*/
	static function do_post_request($url, $data, $optional_headers = null)
	{
		$params = array('http' => array(
		          'method' => 'POST',
		          'Content-type' => 'application/x-www-form-urlencoded',
		          'content' => $data
				));
		if ($optional_headers !== null)
			$params['http']['header'] = $optional_headers;
		
		$ctx = stream_context_create($params);
		$fp = @fopen($url, 'rb', false, $ctx);
		if (!$fp)
			throw new Exception("Problem with $url, $php_errormsg");
		
		$response = @stream_get_contents($fp);
		if ($response === false)
			throw new Exception("Problem reading data from $url, $php_errormsg");
		
		return $response;
	}
	
	/**
	* Extending the app base for adding app wide functionality
	* needs overloading app and database
	**/
	public static function app()
	{
		parent::app(true);
		if (!self::$instance)
			self::$instance = new my();
		parent::$instance = self::$instance;
		return self::$instance;
	}

	static function database($model = null, $profile = false)
	{
		$instance = self::$instance;
		$database = $instance->database;
		if($model == null)
			$database->model = parent::$model;
		else
			$database->model = $model;

		$database->profile = $profile;
		return $database;
	}
	
}
