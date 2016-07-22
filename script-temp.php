<?php
	// requires php5
	session_start();
	//echo ($_SESSION['filename']);
	//include("config.php");
	define('UPLOAD_DIR', 'temp/');
	$img = $_POST['img'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$file = UPLOAD_DIR . $_SESSION['filename'] . '.png';
	$success = file_put_contents($file, $data);
	//////////
	//$sql_in = "insert into images (img_url ,love) values ('$file',0)";
	//mysql_query( $sql_in);
	////////
	if ($success)
        echo "File sucessfully generated.";
    else
        echo "An error message!";
	//print $success ? $file : 'Unable to save the file.';
?>