<?php

//=============================================================================
// ▼ Context
// ----------------------------------------------------------------------------
//
//=============================================================================
class context
{
	const SUCCESS = "Success";
	const ERROR   = "Error";
	const NONE    = "None";
	private $data;
	private $name;
	private static $instance = null;

	//---------------------------------------------------------------------------
	// * Get instance
	//---------------------------------------------------------------------------
	public static function getInstance()
	{
		if(self::$instance == null)
			self::$instance = new context();
		return self::$instance;
	}

	//---------------------------------------------------------------------------
	// * Constructeur
	//---------------------------------------------------------------------------
	private function __construct()
	{
	}

	//---------------------------------------------------------------------------
	// * Init
	//---------------------------------------------------------------------------
	public function init($name)
	{
		$this->name = $name;
	}
	//---------------------------------------------------------------------------
	// * Get layout
	//---------------------------------------------------------------------------
	public function getLayout()
	{
		return $this->layout;
	}

	//---------------------------------------------------------------------------
	// * Set layout
	//---------------------------------------------------------------------------
	public function setLayout($layout)
	{
		$this->layout = $layout;
	}

	//---------------------------------------------------------------------------
	// * Redirect
	//---------------------------------------------------------------------------
	public function redirect($url)
	{
		header("location:".$url);
	}

	//---------------------------------------------------------------------------
	// * Execute action
	//---------------------------------------------------------------------------
	public function executeAction($action,$request)
	{
		$this->layout = "layout";
		if(!method_exists('mainController',$action))
			return false;
		return mainController::$action($request,$this);
	}

	//---------------------------------------------------------------------------
	// * Get session attribute
	//---------------------------------------------------------------------------
	public function getSessionAttribute($attribute)
	{
		if(!isset($_SESSION[$attribute])) return false;
		return $_SESSION[$attribute];
	}

	//---------------------------------------------------------------------------
	// * Set session attribute
	//---------------------------------------------------------------------------
	public function setSessionAttribute($attribute,$value)
	{
		$_SESSION[$attribute] = $value;
	}

	//---------------------------------------------------------------------------
	// * Unset session attributes
	//---------------------------------------------------------------------------
	public function unsetSession() {
		session_unset();
	}

	//---------------------------------------------------------------------------
	// * Get
	//---------------------------------------------------------------------------
	public function __get($prop)
	{
		if(!array_key_exists($prop,$this->data))
		   return NULL;
		return $this->data[$prop];
	}

	//---------------------------------------------------------------------------
	// * Set
	//---------------------------------------------------------------------------
	public function __set($prop,$value)
	{
		$this->data[$prop] = $value;
	}
}
