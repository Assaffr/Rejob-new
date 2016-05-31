<?php
header('Content-type: text/plain; charset=utf-8');

// The config of the DB is executed here.
$mysqli = new mysqli("localhost", "root", "", "rejob" );
if ($mysqli->connect_errno) {
	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}


/**
 *  Insert a new row to The DB.
 * 
 * @param Array $data
 * 
 */

function saveData ( $data ){
	global $mysqli;

	$mysqli->query("SET NAMES 'utf8'");

	$query = "
	INSERT INTO student (student_name, student_phone, student_email, student_cv_path) VALUES ('$data[name]', '$data[phone]', '$data[email]', '$data[cand_cv_path]');
	";

	$result = $mysqli->query($query);
	if ($result == 1 )
		return true;
	else
		echo "INSERT_ERR = ".$mysqli->error;
	

};

/**
 * 
 * 
 * @param Array $info
 * 
 * Return TRUE if all valid - or return an ARRAY if in valid.
 */

function validateInfo( $info ) {
	$error = [];
	$error['bol'] = 0;
	$error['msg'] = '';

	//check full name pattern
	if ( !preg_match( '/^[a-zA-Zא-ת ]+$/' , @$info['name'] ) ){
		$error['bol'] = 1;
		$error['msg'] = "invalid full name - pattern.";
	};

	//Checks Email Address pattern
	if( filter_var( @$info['email'] , FILTER_VALIDATE_EMAIL ) === false ){
		$error['bol'] = 1;
		$error['msg'] .= "\n  Invalid email address.";

	};

	//Checks phone number pattern
	if( !preg_match( '/^([+]{0,1}[0-9]{2,5}[-]{0,1}[0-9]{7,9})$/' , @$info['phone'] ) ){
		$error['bol'] = 1;
		$error['msg'] .= "\n Invalid Phone number.";
	};

	if ( $error['bol'] == 0 )
		return true;

		else return $error;
}


/**
 * Get the $_POST from the client
 * 
 * Return TRUE if The data inserted successfully or ARRAY if error
 */
function getPostData(){
	$error = [];
	$error['bol'] = 0;
	$error['msg'] = '';
	

	if ( isset($_POST['raw']) ) {
		$data = json_decode( $_POST['raw'], true );
	
	
		if( validateInfo($data) === true  ){
			return saveData($data);
		}else
			return validateInfo($data);
	
	
	}else{
		$error['bol'] = 1;
		$error['msg'] = 'no data uploaded';
		return $error;
	}
}



require_once 'file.php';

