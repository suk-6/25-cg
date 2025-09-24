<?php
session_start();
define("USER_PATH", "/app/users/");
function do_signin($user, $pass){
	if (!$user || !$pass) return "missing user or pass";
	$_SESSION = ["win" => $GLOBALS['flag']];
	$pass_map = [
		"user" => trim(file_get_contents(USER_PATH.$user)), 
		"admin" => $GLOBALS['flag']
	];
	echo($pass);
	if ($pass_map['user'] != $pass_map['admin'] || $pass != $pass_map['admin']) {
		$_SESSION = ["win" => false];
		if ($pass == $pass_map['user']) return "login success, but you are not admin";
		return "login failed";
	}
	return "login success";
}
function do_signup($user, $pass){
	if (!$user || !$pass) return "missing user or pass";
	if (file_exists(USER_PATH.$user)) return "user already exists";
	return file_put_contents(USER_PATH.$user, $pass) !== false ? "register success" : "register failed";
}
function get_flag(){
	return $_SESSION['win'] == $GLOBALS['flag'] ? $GLOBALS['flag'] : "has yet to win";
}

sleep(1); // goodbye, TOCTOU
$flag = trim(getenv('FLAG'));
$page = $_REQUEST['page'];
$user_map = [
	"user" => substr($_REQUEST['user'], 0, 21), 
	"pass" => $_REQUEST['pass']
];
die(
	$page == "signin" ? do_signin($user_map['user'], $user_map['pass']) : 
	(
		$page == "signup" ? do_signup($user_map['user'], $user_map['pass']) : 
		(
			$page == "flag" ? get_flag() : show_source(__FILE__, true)
		)
	)
);