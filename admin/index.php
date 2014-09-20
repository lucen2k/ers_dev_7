<?php
#- default include
include(__DIR__.'/../common/config/default.inc.php');


#- Html header
$title = 'Admin' ;
html_header($title);


#- Controller =======================================================
//debug($auth);

# Login check
$auth->login_check();





#- View =============================================================
view('admin/index', $set);



#- Function =========================================================

