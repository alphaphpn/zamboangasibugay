<?php
	class Database {
		public $cnn;
		public function getConnection() {
			$this->cnn = null;
			try {
				include_once "srvr.php";
				$this->cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
				$this->cnn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch(Exception $e) {
				$err = $e->getMessage();
				$err2 = strrchr($e,"1049");
				if($err2=1049){
					echo "Error: Unknown Database. <br>Contact the technical support. <br><a href='tel:+639154826025'>Fix It!</a>";
					die;
				}
			}
			return $this->cnn;
		}
	}
?>