<?php 

class trainermodel
{
    /**
     * @var object The database connection
     */
    private $db_connection = null;
    /**
     * @var array Collection of error messages
     */
    public $errors = array();
    /**
     * @var array Collection of success / neutral messages
     */
    public $messages = array();
	
	
 public function addNewExpressionsCSV($mode, $operands)
 {
	if (empty($mode)) {
		$this->errors[] = "Empty mode";
	
	}elseif (empty($operands)) {
		$this->errors[] = "Empty user_name";
	   
	} elseif (!empty($mode) && !empty($operands)) {
		
		// create a database connection
		$this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

		// change character set to utf8 and check it
		if (!$this->db_connection->set_charset("utf8")) {
			$this->errors[] = $this->db_connection->error;
		}

		// if no connection errors (= working database connection)
		if (!$this->db_connection->connect_errno) {
				
			foreach ($mode as $row) {
				$sql = "INSERT INTO expr_mode (idex, type, level, step)
					VALUES('" . $row['idex'] . "', '" . $row['type'] . "', '" . $row['level'] . "', '" . $row['step'] . "');";
				
				$query_new_expr_mode = $this->db_connection->query($sql);
				
				if ($query_new_expr_mode) {
					$this->messages[] = "expr_mode has been created successfully. You can now log in.";
				} else {
					$this->errors[] = "Sorry, your registration failed. Please go back and try again.";
				}
			}
		
			foreach ($operands as $row) {
				$num = count($row);
				for($x = 0; $x <= $num; $x++){
					if(!empty($row[$x])) {
						$sql = "INSERT INTO expr_operands (idex, num, operand)
							VALUES('" . $row['idex'] . "', '" . $x . "', '" . $row[$x] . "');";
										
						$query_new_user_insert = $this->db_connection->query($sql);
						if ($query_new_user_insert) {
							$this->messages[] = "expr_operandst has been created successfully. You can now log in.";
						} else {
							$this->errors[] = "Sorry, your registration failed. Please go back and try again.";
						}
					}
				}
			}
		}	
    } else {
		$this->errors[] = "An unknown error occurred.";
	}
 }

 public function getExpressions($tmp = null)
 {
	$filter = $tmp;
	if (empty($filter)) {
		$this->errors[] = "Empty filter";
		
	} elseif (!empty($filter)) {	
		
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT expr_mode.idex, operand
					FROM expr_mode INNER JOIN expr_operands ON expr_mode.idex = expr_operands.idex  
						WHERE level = :level  AND step = :step AND type = :type
						ORDER BY expr_mode.idex, num";
		       
		$sth = $database->prepare($sql);
        
		$sth->execute(array(':level' => $filter['level'], ':step' => $filter['step'], ':type' => $filter['type']));
	        
		$Expressions = $sth->fetchAll(PDO::FETCH_COLUMN|PDO::FETCH_GROUP);
		
		if (isset($Expressions)) {
			foreach($Expressions as $key => &$e){
				$array[] = $e;
			}
	
			unset($e);
			unset($Expressions);
	
		} else {
			echo "error";
		}
	return $array;
	}
}	
 	
 public function writeStat($Data) 
 {
	if ($Data['correct'] + $Data['uncorrect'] == 0) {
		$this->errors[] = "Empty answer";
	}elseif (empty($Data['user_name'])) {
		$this->errors[] = "Empty user_name";
	}elseif (empty($Data['type'])) {
		$this->errors[] = "Empty Type";
	}elseif (empty($Data['level'])) {
		$this->errors[] = "Empty Level";
	}elseif (empty($Data['step'])) {
		$this->errors[] = "Empty Step";
	}elseif (($Data['correct'] + $Data['uncorrect'] !== 0)
		&& !empty($Data['user_name'])
		&& !empty($Data['type'])
		&& !empty($Data['level'])
		&& !empty($Data['step'])
	){
		$correct = $Data['correct'];
		$uncorrect = $Data['uncorrect'];
		$user_name = strip_tags($Data['user_name'], ENT_QUOTES);
		$type = strip_tags($Data['type'], ENT_QUOTES);
		$level = strip_tags($Data['level'], ENT_QUOTES);
		$step = $Data['step'];
		$date = date("Y-m-d H:i:s");

		// write new statistic info into database
		
		$database = DatabaseFactory::getFactory()->getConnection();

		$sql = "INSERT INTO statistic (correct, uncorrect, user_name, type, level, step, date)
					VALUES('" . $correct . "', '" . $uncorrect . "', '" . $user_name . "', '" . $type . "', '" . $level . "', '" . $step . "', '" . $date . "');";
			
		$sth = $database->prepare($sql);
        
		$sth->execute();
		}
	}
}