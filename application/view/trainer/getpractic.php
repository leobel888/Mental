<?php
	
 class ArrayValue implements JsonSerializable {
    
		public function __construct(array $array) {
			$this->array = $array;
		}

		public function jsonSerialize() {
			return $this->array;
		}
}	
	
/////////FOR DEBUG/////////////////////////////////////////////

//  ini_set('display_errors', 'On');
	$TEST['level'] = "brothers"; 
	$TEST['step'] = "2";	
	$TEST['type'] = "addition";	
//	require_once('../application/model/TrainerModel.php');

///////////////////////////////////////////////////////////////

	$trainermodel = new trainermodel;
	$Expressions = $trainermodel->getExpressions($_POST);

	echo json_encode(new ArrayValue($Expressions), JSON_PRETTY_PRINT|JSON_NUMERIC_CHECK);

?>