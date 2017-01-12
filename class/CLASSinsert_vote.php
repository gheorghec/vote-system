<?php

class Insert_vote {
    const DB_HOST = 'localhost';
    const DB_NAME = '';
    const DB_USER = '';
    const DB_PASSWORD = '';
 
    /**
     * Open the database connection
     */
    public function __construct() {
        // open database connection
        $conStr = sprintf("mysql:host=%s;dbname=%s", self::DB_HOST, self::DB_NAME);
        try {
            $this->pdo = new PDO($conStr, self::DB_USER, self::DB_PASSWORD);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
     /**
     * PDO instance
     * @var PDO 
     */
    private $pdo = null;
    
 public function vote($first_name, $last_name, $cnp, $cand_id) {
 
        try {
            $this->pdo->beginTransaction();
 
        	$sql_check_cnp = 'SELECT cnp FROM person WHERE cnp=:cnp';
            $stmt = $this->pdo->prepare($sql_check_cnp);
            $stmt->execute(array(":cnp" => $cnp));
            $availableCnp = $stmt->rowCount();
            $stmt->closeCursor();
            if ($availableCnp >= 1) {
               ?>
               	<script>
				$("#error").css("display", "block");
		    	$("#error").html("Acest CNP a fost deja folosit");
				</script>
               <?php
               //echo "cnp exista";
                return false;
            }
 
            // insert personal data of person
           	$cand = array(':first_name' => $first_name,
            			  ':last_name' => $last_name,
                          ':cnp' => $cnp);           
            $sql_insert_cand = 'INSERT INTO person(first_name, last_name, cnp)
				VALUES(:first_name, :last_name, :cnp)';            
            $stmt = $this->pdo->prepare($sql_insert_cand);
            $stmt->execute($cand);
            $stmt->closeCursor();
			
            //select the pers ID from table person
            $sql = 'SELECT pers_id FROM person WHERE cnp = :cnp';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(array(":cnp" => $cnp));
            if(null == $stmt->execute(array(":cnp" => $cnp))){
            	?>
	               	<script>
					$("#error").css("display", "block");
			    	$("#error").html("Ne pare rau, a avut loc o erroare.");
					</script>
               <?php
               //echo "error to select cnp";
               return false;
            	}
            $pers_id = $stmt->fetchColumn();
            $stmt->closeCursor();
            	
            // insert vote
            $vote = array(':cand_id' => $cand_id,
            			  ':pers_id' => $pers_id);           
            $sql_insert_vote = 'INSERT INTO vote(cand_id, pers_id)
				VALUES(:cand_id, :pers_id)';            
            $stmt = $this->pdo->prepare($sql_insert_vote);
            $stmt->execute($vote);
        	if(null == $stmt->execute($vote)){
            	?>
	               	<script>
					$("#error").css("display", "block");
			    	$("#error").html("Ne pare rau, a avut loc o erroare.");
					</script>
               <?php
              // echo "error to insert vote";
               return false;
            	}
            $stmt->closeCursor();
            
          
            
            // commit the transaction
            $this->pdo->commit(); 
            return true;
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            die($e->getMessage());
        }
    }
    /**
     * close the database connection
     */
    public function __destruct() {
        // close the database connection
        $this->pdo = null;
    }
}


