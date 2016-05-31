<?php



$suportted_mimes = ['application/octet-stream','application/msword','text/plain', 'application/pdf','text/richtext','text/vnd.rn-realtext','application/rtf
			','application/x-rtf','text/richtext','application/rtf','text/richtext', 'application/vnd.oasis.opendocument.text'];
/**
 * 
 * @param (array) $file
 * @param (array) $sM
 * @return (boolean)true if successfully uplouded or (arrey) if error
 */

function uploadFile( $file , $sM , $id ){
	$error = [];
	$error['bol'] = 0;
	$error['msg'] = '';
	
	if ( is_array($file) ){
		//continue
		if($file['error'] == 0 ){
			//continue
			if ( in_array($file['type'] , $sM) ){
				//continue
				move_uploaded_file($file['tmp_name'], '../receiver/cv/'.$id.'_'.$file['name']);
				return true;
			}else{
				$error['bol'] = 1;
				$error['msg'] = 'File format is not supported!';
				return $error;
			}
		}else{
			$error['bol'] = 1;
			$error['msg'] = 'File Not uploaded. Error number_'.$file['error'];
			return $error;
		}
	}else{
		die('No file was uploaded');
	}
}

// trigger********************* To merge the two parties triggerssssssss ******************************************/////////////////////////

if ( isset($_FILES['file']) ){
	//var_dump( uploadFile( $_FILES['file'] , $suportted_mimes) );
	//continue
	if ( getPostData() === true && uploadFile( $_FILES['file'] , $suportted_mimes , $mysqli->insert_id ) === true )
		echo json_encode( [true] );
	else{
		$errors = [];
		$errors['file'] = uploadFile( $_FILES['file'] , $suportted_mimes , $mysqli->insert_id );
		$errors['form'] = getPostData(); 
		echo json_encode( $errors ) ;
	}

}else{
	if ( getPostData() === true)
		echo json_encode( [true] );
		else{
			$errors = [];
			$errors['file'] ='No file method.';
			$errors['form'] = getPostData();
			echo json_encode( $errors ) ;
		}
}
	



