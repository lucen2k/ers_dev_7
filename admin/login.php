<?php
#- default include
include(__DIR__.'/../common/config/default.inc.php');


#- Html header
$title = 'Login';
html_header($title);


#- Controller =======================================================
//echo md5('pass');





#- View =============================================================
view('admin/login', $set);



#- Function =========================================================

