<?php

mysql_connect(DATABASE_HOSTNAME, DATABASE_USERNAME, DATABASE_PASSWORD) or mysql_error(); // loob ühenduse mysql serveriga
mysql_select_db(DATABASE_DATABASE) or mysql_error(); // ühendus andmebaasiga
mysql_query("SET NAMES 'utf8'"); // päringud mis saadab on utf8 kodeeringus, et server saaks aru
mysql_query("SET CHARACTER 'utf8'");

function q($sql, & $query_pointer = NULL, $debug = false){
	if ($debug){
		print "<pre>$sql</pre>";
	}
	$query_pointer = mysql_query($sql) or db_error_out();
	switch (substr($sql, 0, 4)){
		case 'SELE':
			return mysql_num_rows($query_pointer);
		case 'INSE':
			return mysql_insert_id();
		default:
			return mysql_affected_rows();
	}
}
function get_one($sql, & $query_pointer = NULL, $debug = false){
	if ($debug){ // kui debug on TRUE
		print "<pre>$sql</pre>";
	}
	$query_pointer = mysql_query($sql) or mysql_error();
	switch (substr($sql, 0, 4)){
		case 'SELE':
			return mysql_num_rows($query_pointer);
		case 'INSE':
			return mysql_insert_id();
		default:
			return mysql_affected_rows();
	}
	$q = mysql_query($sql) or exit(mysql_error());
	if (mysql_num_rows($q) === false){
		exit($sql);
	}
	$result = mysql_fetch_row($q); // teeb massiivi $q-st
	// kas $result on array ja on rohkem kui 0 elementi, siis tagastab esimese elemendi
	return is_array($result) && count($result) > 0 ? $result[0] : null;
}
function get_all($sql){
	$q = mysql_query($sql) or exit(mysql_error());
	while (($result[] = mysql_fetch_assoc($q)) || array_pop($result)){
		;
	}
	return $result;
}
function db_error_out($sql = NULL)
{
	$db_error = mysql_error();

	//kontrolli kas db_errori alguses on tekst You have an error in SQL syntax.. kui see nii on siis db_erroriks on <b> <pre
	//alates tähemärgist 135
	if (strpos($db_error, 'You have an error in SQL syntax') !== FALSE) {
		$db_error = '<b>Syntax error in</b><pre> '.substr($db_error, 135).'</pre>';

	}
	$backtrace = debug_backtrace();
	$file = $backtrace[1]['file'];
	$line = $backtrace[1]['line'];
	$function = isset($backtrace[2]['function']) ? $backtrace[2]['function'] : NULL;
	$args = isset($backtrace[2]['args']) ? $backtrace[2]['args'] : NULL;
	if (! empty($args)) {
		foreach ($args as $arg) {
			if (is_array($arg)) {
				$args2[] = implode(',', $arg);
			} else {
				$args2[] = $arg;
			}
		}
	}

	$args = empty($args2) ? '' : '"'.implode('", "', $args2).'"';
	$s = "In file <b>$file</b>, line <b>$line</b>";
	if (! empty($function)) {
		$s .= ", function <b>$function</b>( $args )";
	}
	$output = '
            <table style="background-color:white; border:1px solid gray; border-radius:10px; padding:10px">
                <tr><td style="font-weight: bold; background-color: red; color: white; width: 100%; padding: 5px">Database error:</td></tr>
                <tr><td><pre style="text-align: left;">'.$sql.'</pre><br><b style="color: red">'.$db_error.'</b></td>
                <tr><td style="height:2px">&nbsp;</td>
                <tr><td>'.$s.'
            </table>';

	if (isset($_GET['ajax'])) {
		ob_end_clean();
		echo strip_tags($output);
	} else {
		echo $output;
	}
	die();

}
function insert($table, $data)
{
	if ($table and is_array($data) and ! empty($data)) {
		foreach ($data as $field => $value) {
			$values[] = "$field='".mysql_real_escape_string(trim($value))."'";
		}
		$values = implode(',', $values);
		$sql = "INSERT INTO {$table} SET {$values} ON DUPLICATE KEY UPDATE {$values}";
		$id = q($sql, $q);
		return ($id > 0) ? $id : FALSE;
	} else {
		return FALSE;
	}
}
function update($table, $data,$where)
{
	if ($table and is_array($data) and ! empty($data)) {
		foreach ($data as $field => $value) {
			$values[] = "$field='".trim($value)."'";
		}
		$values = implode(',', $values);
		if (isset($where)){
			$sql = "UPDATE {$table} SET {$values} WHERE {$where}";
		}
		else{
			$sql = "UPDATE {$table} SET {$values}";
		}
		$id = q($sql, $q);
		return ($id > 0) ? $id : FALSE;
	} else {
		return FALSE;
	}
}