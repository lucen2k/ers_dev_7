<?php
#- default include
include(dirname(__FILE__).'/common/config/default.inc.php');


#- Html header
$title = 'Sample' ;
html_header($title);


#- Controller =======================================================

#- 検索結果 -------
$bind = array(":search" => "a%");
$set->search = $db->select('list', 'name LIKE :search', $bind);

#- Pager example of use -------
$sql = "SELECT * FROM list WHERE 1 ORDER BY id DESC"; 
$pager = new Pager($sql, PAGER_LIMIT);
//debug($pager);

# list 取得
$set->list = $db->pager($pager);

# paging
$set->pager = $pager->show();
 
#- Insert -------
$fields = array(
	'name' => 'LName FName',
);
//$db->insert('list', $fields);

#- Update -------
$fields = array(
	'name' => 'update name',
);
$db->update('list', $fields, 'id = 9');

#- include config
$test = $use->config('config_sample');
debug(DEFINE_CONFIG_SAMPLE);
debug($test['config_sample']);


#- View =============================================================
view('index', $set);



#- Function =========================================================

