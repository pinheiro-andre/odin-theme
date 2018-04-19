<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL);

define('DB_PREFIX', 'signsgamepreprod');
require_once( $_SERVER["DOCUMENT_ROOT"].'/blog/wp-load.php' );

class SignsGame{

	private $db;

	public function __construct(){

		try{
			$this->db = new PDO("mysql:dbname=".DB_NAME.";host=".DB_HOST, DB_USER, DB_PASSWORD);
 			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    		$this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        }catch(PDOException $e){
            die(json_encode(array(
                'Error' => $e->getMessage()
            )));
        }

	}

	public function __destruct(){

		$this->db = NULL;

	}


	public function get_signs(){

		$sql = 'SELECT ID, Name FROM '.DB_PREFIX.'.Signs ORDER by ID';

		$this->db->exec("set names utf8");

		$data = $this->db->query($sql);

		$ret = "<option value='' selected> </option>";
	    while( $row = $data->fetch(PDO::FETCH_ASSOC) )
			$ret .= "<option value='" .$row['ID']. "'>" .$row['Name']. "</option>";

		return $ret;

		// $sign = array();
		// $row = $data->fetchAll(PDO::FETCH_ASSOC);
		// return json_encode($row);

	}

	public function play($sign1, $sign2){

		$sql = '
				SELECT
					trim(love_score) as love_score , trim(love_desc) as love_desc,
					trim(sex_score) as sex_score,  trim(sex_desc) as sex_desc,
					trim(work_score) as work_score, trim(work_desc) as work_desc,
					trim(friendship_score) as friendship_score, trim(friendship_desc) as friendship_desc
				 FROM
				 	'.DB_PREFIX.'.Combination
				 WHERE
				 	A_sign_ID = '.$sign1.'
				 	AND
				 	B_sign_ID = '.$sign2.'
				';

		$this->db->exec("set names utf8");

		$data = $this->db->query($sql);

		$row = $data->fetch(PDO::FETCH_ASSOC) ;


	    //$row = $data->fetch(PDO::FETCH_ASSOC);

		return json_encode($row);
	}
}
?>
