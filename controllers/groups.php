<?php
/**
 * Created by JetBrains PhpStorm.
 * User: kaia
 * Date: 4.06.13
 * Time: 11:01
 * To change this template use File | Settings | File Templates.
 */

class groups {
	function index(){
		global $request;
		$groups=get_all("SELECT * FROM `group` GROUP BY group_id");
	//	var_dump($groups);

		if(!empty($groups)):foreach($groups as $group):
		$number=get_all("SELECT COUNT(student_id) as 'number' FROM student WHERE student.group_id='$group[group_id]'");
			var_dump($number);
	       // die( var_dump($number));

	        endforeach;endif;
		require 'views/master_view.php';
//vastavalt group idle tuleb teha opilaste p2ring!!!!1
	}
	function selected(){
		global $request;
		$group_id = $request->params[0];
		$students=get_all("SELECT * FROM `student` WHERE group_id='$group_id'");

		require 'views/master_view.php';

	}
}