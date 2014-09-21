<?php
#- default include
include(dirname(__FILE__).'/../common/config/default.inc.php');

#- CSV Download
if (isset($_GET['download_csv'])) {
	# DATA取得
	$data = $db->select('list');
	//debug($data); exit;

	# 出力
	$title = array('ID','名前','作成日時','更新時日');
	$filename = 'member_list';
	CSV::csv_download($data);
}

#- Html header
$title = 'CSV import';
html_header($title);


#- Controller =======================================================

# CSVファイルリスト取得
$set->csv_file = CSV::get_csv_list();
//debug($set->csv_file);　exit;

# 最初（1番目）ファイルの11行(offset)から5行(limit)取得
$set->csv_import = CSV::get_csv_import($set->csv_file['content'][1], 5, 11);
//debug($set->csv_import);　exit;




#- View =============================================================
view('csv/index', $set);



#- Function =========================================================