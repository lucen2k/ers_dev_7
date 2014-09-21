<?php
session_start();

#- HTML
include(dirname(__FILE__).'/header.inc.php');

#- DB Class
include(dirname(__FILE__).'/db.inc.php');

#- Table Class
include(dirname(__FILE__).'/../class/class.table.php');
$tbl = new Array_View_Table;

#- Pager Class
include(dirname(__FILE__).'/../class/class.pager.php');

#- CSV Class
include(dirname(__FILE__).'/../class/class.csv.php');

#- Auth Class
include(dirname(__FILE__).'/../class/class.auth.php');
$session_auth = array();
//debug($_SESSION);
if (!empty($_SESSION['Auth'])) {
	$session_auth = $_SESSION['Auth'];
}
$auth = new Auth($db, $session_auth);

#- Config
include(dirname(__FILE__).'/config.inc.php');

#- define
define('CSV_PATH',	dirname(__FILE__).'/../../csv/');

#- Debug info
Class ERS_Dev
{
   public $version 		= "ers.dev.v.0.7";
   public $date 		= "2014.09.20";
   public $author 		= "Lucen(7),Wataru(0)";
   public $db_class 	= "<a href='/common/doc/class.db.php' target='_blank'>DB Class Discription</a>";
   public $other_class 	= "<a href='/common/doc/class.other.php' target='_blank'>Other Class Discription</a>";
}
$set = new ERS_Dev();

#- params
$params = get_params();
$set->Params = $params;

#- Auth
$set->Auth = array();
# ログインフォームから遷移した場合の処理
if (!empty($params['post']['Login'])) {
	# Login
	$user_info = $auth->login($params['post']['Login']);
	debug($user_info);

	# ログイン情報確認
	if (!empty($user_info['id'])) {
		$set->Auth = $user_info;
		$_SESSION['Auth'] = $user_info;
		redirect('admin');
	}
	error('ログイン失敗！');
} else {
	if (!empty($params['session']['Auth'])) {
		# ログイン状態の場合、セッションから取得
		$set->Auth = $params['session']['Auth'];
	}
}

#- View
function view($name=null, $set=array())
{
	#- page title & view class set
	global $title, $tbl;
	$set->title = $title;

	#- view file not exist error
	if (empty($name)) {
		return false;
	}

	#- View file
	$view_file = VIEW_PATH.$name.'.phtml';
	if (file_exists($view_file)) {
		require_once($view_file);

		#- html footer
		echo "<br><br><br><br><br>\n";
		# Config USE_DEBUGがtrueの場合デバックモード
		if (defined('USE_DEBUG') && USE_DEBUG) {
			echo "<hr>";
			debug($set);
		}
		html_footer();

		return true;
	}
	error($view_file, 'ERS_Dev_Msg: File not found.');

	return false;
}

/**
 *　Version discription list
 *
 * ers.dev.v.0.7 - 2014.9.20
 * @author Lucen(7): ADMIN page　&　Login機能追加
 *
 * ers.dev.v.0.6 - 2014.9.18
 * @author Lucen(6): CSV Class追加
 *
 * ers.dev.v.0.5 - 2014.9.14
 * @author Lucen(5): Pager Class追加
 *
 * ers.dev.v.0.4 - 2014.9.12
 * @author Lucen(4): 開発スピードのために Table Class追加
 *
 * ers.pdo.v.0.3 - 2014.7.16
 * @author Lucen(3): View Object追加
 *
 * ers.php.v.0.2 - 2014.7.2
 * @author Lucen(2): Debug機能, CSS
 *
 * pod.view.v.0.1 - 2014.7.1 
 * @author Lucen(1): DB Class, ControllerとViewを分ける
 */

#- function ---------------------------------------------------------

# Params取得
function get_params()
{
	$params = array();
	if (!empty($_POST)) {
		$params['post'] = $_POST;
	}
	if (!empty($_GET)) {
		$params['get'] = $_GET;
	}	
	if (!empty($_SESSION)) {
		$params['session'] = $_SESSION;
	}
	if (!empty($_COOKIE)) {
		$params['cookie'] = $_COOKIE;
	}

	return $params;
}

# リダイレクト
function redirect($url)
{
	echo('<script language="JavaScript"> location = "'.HOME_URL.$url.'" </script>');
}