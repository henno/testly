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
		$this->scripts[] = 'groups_index_delete.js';

		$groups=get_all('SELECT COUNT(student_id) as "number", `group`.* FROM `group` NATURAL JOIN student GROUP BY group_id');


		require 'views/master_view.php';
	}
	function view(){
		global $request;
		$this->scripts[] = 'groups_view_add.js';
		$group_id = $request->params[0];
		var_dump($group_id);
		$students=get_all("SELECT * FROM `student` WHERE group_id='$group_id'");

		require 'views/master_view.php';

	}
	function add(){
		global $request;
		$group_id = $request->params[0];
		if(isset($_POST['group'])):$group_name=$_POST['group'];
			$group_id=insert('group', array('group_name'=>$group_name));
		echo $group_id;
		endif;
		if(isset($_POST['student_name'])&&isset($_POST['student_email'])):
			$student_name=$_POST['student_name'];
			$student_email=$_POST['student_email'];
			$student_id=insert('student',array('student_name'=>$student_name, 'group_id'=>$group_id,
			                                   'email'=>$student_email));
		endif;
	}
	function delete(){
		global $request;
		if(isset($_POST['group_id'])&& is_array($_POST['group_id'])):

			$delete_groups=implode(",",$_POST['group_id']);
			$delete=update('group',array("deleted"=>1),"group_id IN($delete_groups)");
endif;
	}
	}