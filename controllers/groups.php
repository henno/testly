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
		$this->scripts[] = 'groups_index_add.js';

		$groups=get_all("SELECT * FROM `group` GROUP BY group_id");

		if(isset($_POST["group"])):$group_name=$_POST["group"];
		$group_id=q("INSERT INTO `group` SET group_name='$group_name'");
		endif;
		if(!empty($groups)):foreach($groups as $group):
		$numbers=get_all("SELECT COUNT(student_id) as 'number' FROM student WHERE student.group_id='$group[group_id]'");
			$numbers=$numbers[0];
			foreach($numbers as $number){
				$group["number"]=[$number];
			}

	        endforeach;endif;
		require 'views/master_view.php';
	}
	function selected(){
		global $request;
		$this->scripts[] = 'groups_selected_add.js';
		$nupsu = $request->params[0];
		var_dump($nupsu);
		$students=get_all("SELECT * FROM `student` WHERE group_id='$nupsu'");
		if(isset($_POST["student_name"])&&isset($_POST["student_email"])):
			$student_name=$_POST["student_name"];
			$student_email=$_POST["student_email"];
			var_dump($_POST["student"]);
		$student_query="student_name='$student_name', group_id='$nupsu',
			email='$student_email'";
			$student_id=insert("student",$student_query);
		endif;
		require 'views/master_view.php';

	}

}