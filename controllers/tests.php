<?php

class tests {
	public $requires_auth = true;
	function index(){
		$this->scripts[] = 'tests.js';
		global $request;
		global $_user;
		$tests = get_all("SELECT * FROM test NATURAL JOIN user WHERE test.deleted=0");
		$id = $_SESSION['user_id'];
		$status = get_one("SELECT status FROM user WHERE user_id='$id'");
		require 'views/master_view.php';

	}
	function remove(){
		global $request;
		$id = $request->params[0];
		$result = q("UPDATE test SET deleted=1 WHERE test_id='$id'");
		require 'views/master_view.php';
	}
	function edit(){
		global $request;
		$this->scripts[] = 'tests_add_edit.js';
		$id = $request->params[0];
		$test = get_all("SELECT * FROM test WHERE test_id='$id'");
		$test = $test[0];
		$questions = get_all("SELECT * FROM question NATURAL JOIN question_type WHERE test_id='$id'");
		require 'views/master_view.php';
	}
	function add(){
		ob_end_clean();
		$user_id = $_SESSION['user_id'];
		if(isset($_POST['test_name'])){
			$test_id = q("INSERT INTO test SET name='$_POST[test_name]', user_id='$user_id'");
			echo $test_id>0 ? $test_id : 'FAIL';
			exit();
		}
		else{
			exit('Testi nimi puudub!');
		}
	}
}