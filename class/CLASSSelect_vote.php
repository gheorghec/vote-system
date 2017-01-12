<?php
class DB_Driver {
    const DB_HOST = 'localhost';
    const DB_NAME = '';
    const DB_USER = '';
    const DB_PASSWORD = '';
    /**
     * Open the database connection
     */
    public function __construct($querry) {
        // open database connection
        $conStr = sprintf("mysql:host=%s;dbname=%s", self::DB_HOST, self::DB_NAME);
        try {
            $this->pdo = new PDO($conStr, self::DB_USER, self::DB_PASSWORD);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        $this->exec_querry($querry);
    }
     /**
     * PDO instance
     * @var PDO 
     */
    private $pdo = null;
    private $result = array();
	
 private function exec_querry($querry) {
 
try {
            $this->pdo->beginTransaction();
 
        	$sql = sprintf("%s", $querry);
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
				while ($r = $stmt->fetch()) {
				        $this->result[] = $r;
				    }
            //$this->result = $stmt->fetch();         
            $this->pdo->commit();
			 
            return true;
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            die($e->getMessage());
        }
    return $this->result;    
 }

    /**
     * close the database connection
     */
    public function __destruct() {
        // close the database connection
        $this->pdo = null;
    }
}

class DB extends DB_Driver
{
	private static $querry;
	
	function __construct($querry) {
		self::$querry .= $querry;	
	}
    public function exec()
    {
    	parent::__construct(self::$querry);
        return $this;
    }

    static public function querry($querry)
    {	
        return new self($querry);
    }
	function __destruct() {
	}
}
