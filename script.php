<?php
	// requires php5
	session_start();
	
	include("config.php");
	define('UPLOAD_DIR', 'gallery/');
	//$img = $_POST['img'];
	//$img = str_replace('data:image/png;base64,', '', $img);
	//$img = str_replace(' ', '+', $img);
	//$data = base64_decode($img);
	//$file = UPLOAD_DIR . $_SESSION['filename'] . '.png';
	$file = "temp/" . $_SESSION['filename'] . '.png';
	//$success = file_put_contents($file, $data);
	//$success = move_uploaded_file($file,"gallery/");
	
	$url = UPLOAD_DIR . $_SESSION['filename'] . '.png';
	$success = rename($file, $url);
	$fid = $_POST['fid'];
	$mailid = $_POST['mailid'];
	//////////
	$sql_in = "insert into images (img_url ,love, fid, mailid) values ('$url',0,'$fid','$mailid')";
	$result = mysql_query( $sql_in);
	if ($result)
        echo "Sucessful added to our gallery.";
    else
        echo "An error message!";
	////////
	//print $success ? $file : 'Unable to save the file.';
?>