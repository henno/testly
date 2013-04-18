<?php

mysql_connect(DATABASE_HOSTNAME, DATABASE_USERNAME) or mysql_error(); // loob ühenduse mysql serveriga
mysql_select_db(DATABASE_DATABASE) or mysql_error(); // ühendus andmebaasiga
mysql_query("SET NAMES 'utf8'"); // päringud mis saadab on utf8 kodeeringus, et server saaks aru
mysql_query("SET CHARACTER 'utf8'");


function get_one($sql, $debug = false){
	if ($debug){ // kui debug on TRUE
		print "<pre>$sql</pre>";
	}
	$q = mysql_query($sql) or exit(mysql_error());
	if (mysql_num_rows($q) === false){
		exit($sql);
	}
	$result = mysql_fetch_row($q); // teeb massiivi $q-st
	// kas $result on array ja on rohkem kui 0 elementi, siis tagastab esimese elemendi
	return is_array($result) && count($result) > 0 ? $result[0] : null;
}