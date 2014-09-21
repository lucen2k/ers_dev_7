<?php
#- default include
include(dirname(__FILE__).'/../common/config/default.inc.php');

# logout
unset($_SESSION['Auth']);
redirect('admin/login.php');