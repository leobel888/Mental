<?php

////////FOR DEBUG/////////////////////////////////////////////

	ini_set('display_errors', 'On');

	$TEST['correct'] = "15"; 
	$TEST['level'] = "brothers";	
	$TEST['step'] = "2";	
	$TEST['type'] = "addition";
	$TEST['uncorrect'] = "10";
	$TEST['user_name'] = "demo2";
	
//	require_once('../application/model/TrainerModel.php');

///////////////////////////////////////////////////////////////

$trainermodel = new trainermodel;
$Expressions = $trainermodel->writeStat($_POST);
	
?>