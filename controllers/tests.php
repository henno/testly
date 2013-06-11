<?php

class tests {
	public $requires_auth = true;
	function index(){
		$this->scripts[] = 'tests.js';
		global $request;
		global $_user;
		global $username;
		$tests = get_all("SELECT * FROM test NATURAL JOIN user WHERE test.deleted=0");
		$id = $_SESSION['user_id'];
		$status = get_one("SELECT status FROM user WHERE user_id='$id'");
		require 'views/master_view.php';

	}
	function remove(){
		global $request;
		$id = $request->params[0];
		$result = update( 'test',array(deleted=>1),"test_id='$id'");
		require 'views/master_view.php';
	}
	function edit(){
		global $request;
		$this->scripts[] = 'tests_add_edit.js';
		$id = $request->params[0];
		$test = get_all("SELECT * FROM test WHERE test_id='$id'");
		$test = $test[0];
		$questions = get_all("SELECT * FROM question NATURAL JOIN question_type WHERE test_id='$id'");
		$get_last_id = get_all("SELECT MAX(id) FROM question");
		$get_last_id = $get_last_id[0];
		$group_names = get_all("SELECT group_name FROM `group` WHERE deleted=0");
		$test_groups = get_all("SELECT * FROM test_groups WHERE test_id='$id' AND deleted=0");
		require 'views/master_view.php';
	}
	function add(){
		ob_end_clean();
		$user_id = $_SESSION['user_id'];
		if(isset($_POST['test_name'])){
			$test_id = insert('test', array('name'=>$_POST['test_name'], 'user_id'=>$user_id));
			echo $test_id>0 ? $test_id : 'FAIL';
			exit();
		}
		else{
			exit('Testi nimi puudub!');
		}
	}
	function add_question(){
		global $request;
		$this->scripts[] = 'tests_add_edit.js';
		$id = $request->params[0];
		$get_last_id = get_all("SELECT MAX(id) FROM question");
		$get_last_id = $get_last_id[0]['MAX(id)'];
		if ($get_last_id == null){$get_last_id = '0';};
		$abi = $_POST['newquestionid'];
		$questionid = ((int)$abi) + 1;
		if($_POST['questiontext'] && $id){
			$question_text = $_POST['questiontext'];
			$question_type_id = $_POST['question_type_id'];
			$question_id = insert('question', array('test_id'=>$id, 'question_text'=>$question_text,
			                                        'question_type_id'=>$question_type_id, 'id'=>$questionid));
			echo $question_id>0 ? $question_id : 'FAIL';
			exit();
		}

		else{
			exit('Küsimuse nimi puudub!');
		}
	}
	function add_group(){
		ob_end_clean();
		global $request;
		$this->scripts[] = 'tests_add_edit.js';
		$id = $request->params[0];
		$group_name = $_POST['group_name'];
		$start_date = $_POST['group_start_date'];
		$start_time = $_POST['group_start_time'];
		$finish_date = $_POST['group_finish_date'];
		$finish_time = $_POST['group_finish_time'];
		if (!empty($group_name)){
		$group_id = insert('test_groups', array('group_name'=>$group_name, 'start_date'=>$start_date,
		                                        'start_time'=>$start_time, 'finish_date'=>$finish_date,
		                                        'finish_time'=>$finish_time, 'test_id'=>$id));
			echo $group_id > 0 ? $group_id : 'FAIL';
			exit();
		}
	}
	function removegroup(){
		global $request;
		$test_id = $request->params[0];
		$id = $request->params[1];
		$this->scripts[] = 'tests_add_edit.js';
		$results = update('test_groups', array('deleted'=>1), "id='$id' AND test_id='$test_id'");
		var_dump($results);
		require 'views/master_view.php';

	}
	function remove_question(){
		global $request;
		$id = $request->params[0];
		$delete_question = q("DELETE FROM question WHERE id='$id'");
		require 'views/master_view.php';
	}
}