<?php

/**
 * kgetcsv
 *
 * Function for reading csv files
 *
 * @author Knuckr mail@knuckr.com
 * @version 0.0.1
 * 
 * @param string $filename path to the csv file
 * @param char $delimiter fields delimiter
 * @param string $enc csv file encoding
 *
 * @return array|bool Associative array or false if file not exists or can't read
 */
function kgetcsv($filename, $delimiter = ",", $enc = "utf-8") {
	$enc = strtolower($enc);
	$is_first = true;
	$csv_result = array();
	$csv_fields_names = array();
	if (is_file($filename) && ($fp = fopen($filename, "r")) !== false) {
		while (($data = fgetcsv($fp, null, $delimiter)) !== false) {
			if ($is_first) {
				if ($enc === "utf-8") {
					$csv_fields_names = $data;
				} else {
					foreach ($data as $d)
						$csv_fields_names[] = mb_convert_encoding($d, "utf-8", $enc);
				}
				$is_first = false;
			} else {
				$num = count($data);
				$temp = array();
				for ($i = 0; $i < $num; $i++) {
					$temp[$csv_fields_names[$i]] = ($enc === "utf-8") ? $data[$i] : mb_convert_encoding($data[$i], "utf-8", $enc);
				}
				$csv_result[] = $temp;
			}
		}
		fclose($fp);
		return $csv_result;
	} else return false;
}

?>
