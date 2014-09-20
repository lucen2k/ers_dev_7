<?php

#- html header
function html_header($title=null)
{
	global $set;

	if (empty($title)) {
		$title = SITE_NAME;
	} else {
		$title .= " - ".SITE_NAME;
	}

	# Login link
	if (!empty($set->Auth['name'])) {
		$user_name = '['.$set->Auth['name'].'] ';
		$login_link = '<a href="'.HOME_URL.'admin/logout.php">LOGOUT</a>';
	} else {
		$user_name = null;
		$login_link = '<a href="'.HOME_URL.'admin/login.php">LOGIN</a>';
	}

	print '
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>'.$title.'</title>
<link rel="stylesheet" type="text/css" href="'.HOME_URL.'common/css/lucen2.css">
</head>
<body>
'.$user_name.'
<a href="'.HOME_URL.'">INDEX</a>&nbsp;
<a href="'.HOME_URL.'csv/">CSV</a>&nbsp;
<a href="'.HOME_URL.'admin/">ADMIN</a>&nbsp;
'.$login_link.'&nbsp;
<hr>
';
	return true;
}

#- Html footer
function html_footer()
{
	print '
</body>
</html>
';
	return true;
}

#- csv header
function csv_header($filename)
{
	header('X-Content-Type-Options: nosniff');
	header('Content-Disposition: attachement; filename='.$filename);
	header('Content-Type: application/octet-stream; name='.$filename);
}

