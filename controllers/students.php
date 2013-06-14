<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Taivo
 * Date: 4.06.13
 * Time: 11:25
 * To change this template use File | Settings | File Templates.
 */

class students {
	function index(){
		global $request;
		$students = get_all("SELECT * FROM student NATURAL JOIN `group` WHERE student.deleted=0");
		$no=1;
		require 'views/master_view.php';

	}
	function view(){
		global $request;
		$student_id = $request->params[0];

		$tests = get_all("SELECT * FROM test NATURAL JOIN `student` WHERE student.student_id='$student_id'");
		$student_group=get_all("SELECT student_name,group_name FROM student NATURAL JOIN `group` WHERE  student
		.student_id='$student_id'");
		require 'views/master_view.php';

	}

}