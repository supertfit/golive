<?php
/*
 ************************************************************************
* @filename		: VWSExternalAction.php
* @description	: 
* Created on 	: Aug 21, 2014 4:06:16 PM
* Created by	: KCH
*************************************************************************
*/
$str_action = isset($_POST['action_type'])?$_POST['action_type']:'';
$result = array('result_code'=>'failed', 'error'=>'Invalid action');
if ($str_action == '') {
	die(json_encode($result));
}
require_once 'GetTarget.php';
require_once 'UpdateTarget.php';
require_once 'DeleteTarget.php';
require_once 'PostNewTarget.php';
require_once 'GetAllTargets.php';

switch ($str_action) {
	case 'addtarget':
		$instance = new PostNewTarget();
		$str_targetId = isset($_POST['targetName'])?$_POST['targetName']:'';
		// $str_location = isset($_FILES['targetLocation']['tmp_name'])?$_FILES['targetLocation']['tmp_name']:'';
		$str_location = $_POST['targetLocation'];
		$str_metadata = isset($_POST['metadata'])?$_POST['metadata']:$_POST['metadata'];
		if ($str_targetId == '' || $str_location == '')
		{
			$result = array('result_code'=>'failed', 'error'=>'Invalid arguments');
			die(json_encode($result));
		}
		$instance->SetRequestPath( $str_targetId, $str_location, $str_metadata );
		$res = $instance->execPostNewTarget();
		die($res);
		break;
	case 'delete':
		$instance = new DeleteTarget();
		$str_targetId = isset($_POST['targetId'])?$_POST['targetId']:'';
		if ($str_targetId == '')
		{
			$result = array('result_code'=>'failed', 'error'=>'Invalid target ID');
			die(json_encode($result));
		}
		$instance->SetRequestPath( $str_targetId );
		$res = $instance->execDeleteTarget();
		die($res);
		break;
	case 'update':
		$instance = new UpdateTarget();
		$str_targetId = isset($_POST['targetId']) ? $_POST['targetId']:'';
		$str_metadata = isset($_POST['metadata']) ? $_POST['metadata']:'';
		if ($str_targetId == '')
		{
			$result = array('result_code'=>'failed', 'error'=>'Invalid target ID');
			die(json_encode($result));
		}
		$instance->SetRequestPath( $str_targetId, $str_metadata );
		$res = $instance->execUpdateTarget();
		die($res);
		break;
	case 'getall':
		$instance = new GetAllTargets();
		$res = $instance->execGetAllTargets();
		die( $res );
		break;
	case 'gettarget':
		$instance = new GetTarget();
		$str_targetId = isset($_POST['targetId']) ? $_POST['targetId']:'';
		if ($str_targetId == '')
		{
			$result = array('result_code'=>'failed', 'error'=>'Invalid target ID');
			die(json_encode($result));
		}
		$instance->SetRequestPath( $str_targetId );
		$res = $instance->execGetTarget();
		die($res);
		break;
}
/* End of file VWSExternalAction.php */
?>