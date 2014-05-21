<?php 

//@author: Sagun Siwakoti
//@description: a simple mysqli driver for common operations
//@version: 1.0

	class db
	{

		protected $db_server = 'localhost';
		protected $db_user = 'root';
		protected $db_password = '';
		protected $db_name = 'mydb';
		public $conn;


		//establishes a connection to the database
		public function __construct()
		{
			$this->conn = mysqli_connect($this->db_server,$this->db_user,$this->db_password,$this->db_name);
			if ($this->conn->connect_error) {
   				die('Connect Error (' . $this->conn->connect_errno . ') '. $this->conn->connect_error);
			}
		}



		/*param sql string
		returns result array
		*/
		public function sql($sql)
		{
			$res = $this->conn->query($sql);
			while($objects = $res->fetch_object())
			{
				$result[] = $objects;
			}
			return $result;
		}



		/*params table string, id int
		returns result array*/
		public function get($table,$id)
		{
			$sql = "SELECT * FROM $table WHERE id = $id";
			$result = $this->sql($sql);
			return $result;
		}



		/*params table string
		return result array*/
		public function get_all($table)
		{
			$sql = "SELECT * FROM $table";
			$result = $this->sql($sql);
			return $result;
		}



		/*params data array,table string
		returns bool */
		public function insert($data, $table)
		{
			$col = '';
			$val = '';
			foreach ($data as $key => $v) {
				$value = $this->conn->real_escape_string($v);
				$col .= $key . ',';
				$val .= "'".$value."'" . ',';
			}

			$cols = substr($col, 0, -1);
			$vals = substr($val, 0, -1);

			$sql = "INSERT INTO $table($cols)VALUES($vals);";
			$result = $this->conn->query($sql);
			return ($result)?true:false;
		}



		/*params data array, table string, where string
		returns bool*/
		public function update($data, $table, $where)
		{
			$se = '';

			foreach ($data as $key => $v) {
				$value = $this->conn->real_escape_string($v);
				$se.= $key.'='."'".$value."'".',';
			}

			$set = substr($se, 0, -1);
			$sql = "UPDATE $table SET $set WHERE $where";
			$result = $this->conn->query($sql);
			//echo $result;
			return ($result)?true:false;
		}



		/*params table string, where string
		returns bool*/
		public function delete($table,$where)
		{
			$sql = "DELETE FROM $table WHERE $where";
			$result = $this->conn->query($sql);
			return ($result)?true:false;
		}



		/*params sql string
		returns count int*/
		public function count($sql)
		{
			$res = $this->conn->query($sql);
			$count = $res->num_rows;
			return $count;
		}
	}


?>