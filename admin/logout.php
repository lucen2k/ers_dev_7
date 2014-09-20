<?php
#- default include
include(__DIR__.'/../common/config/default.inc.php');

# logout
unset($_SESSION['Auth']);
redirect('admin/login.php');