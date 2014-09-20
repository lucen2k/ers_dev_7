<?php

/**
 * CSV処理用Class
 *
 * @author Lucen harukawa
 */
class CSV
{
	#- CSVファイルリスト取得
	static function get_csv_list()
	{
		if ($handle = opendir(CSV_PATH)) {
			$file_count = 0;
            while (false !== ($file = readdir($handle))) {
            	if (substr_count($file, '.csv')) {
            		$file_count++;
                	$filelist['content'][$file_count] = $file;
                }
            }
            $filelist['count'] = $file_count;
            closedir($handle);
        }
        //print_r($filelist);

    	return $filelist;
	}

	#- CSV内容取得
	static function get_csv_import($filename, $limit=null, $offset=null)
	{
		if (empty($filename)) {
			return false;
		}

		// CSVファイル処理
		$result = array();
		$fp = fopen(CSV_PATH.$filename, "r") or die("ERROR： ".CSV_PATH.$filename);
 		$line_count = 0;
		while ($row = fgetcsv($fp, 1024)) {
			$line_count++;

			if (!empty($limit) && !empty($offset)) {
				$last_line = $offset + $limit;
				if ($line_count >= $offset && $line_count < $last_line) {
					$result['content'][$line_count] = $row;
				}
			} elseif (!empty($limit)) {
				if ($line_count <= $limit) {
					$result['content'][$line_count] = $row;	
				}
			} else {
				$result['content'][$line_count] = $row;	
			}

			// encoding
			if (isset($result['content'][$line_count]) && is_array($result['content'][$line_count])) {
				foreach ($result['content'][$line_count] as $k => $value) {
					$result['content'][$line_count][$k] = mb_convert_encoding($value, "UTF-8", "SJIS");
				}
			}
		}
		$result['count'] = $line_count;
		fclose($fp);

		return $result;
	}

	#- CSVダウンロード
	static function csv_download($data, $title=array(), $filename=null)
	{
		if (empty($data) || !is_array($data)) {
			return false;
		}
		if (empty($filename)) {
			$filename = 'export_'.date('Ymd');
		}
		$filename .= ".csv";

		# Export
		header('X-Content-Type-Options: nosniff');
		header('Content-Disposition: attachement; filename='.$filename);
		header('Content-Type: application/octet-stream; name='.$filename);
		foreach ($data as $entry) {

			// csv title
			if ($title !== true) {
				if (empty($title)) {
					foreach ($entry as $title_name => $tmp) {
						$title[] = mb_convert_encoding($title_name, "SJIS", "UTF-8");
					}
					echo join(",",$title);
				} else {
					$title = join(",",$title);
					echo mb_convert_encoding($title, "SJIS", "UTF-8");
				}
				$title = true;
				echo "\n";
			}

			// csv contents
			$contents = join(",",$entry);
			echo mb_convert_encoding($contents, "SJIS", "UTF-8");
			echo "\n";
		}
		exit;
	}

}