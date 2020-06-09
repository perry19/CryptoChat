<?php
	include('../conn.php');
	session_start();
	if(isset($_POST['msg'])){		
		$msg=$_POST['msg'];
		$id=$_POST['id'];

        $cipher="AES-128-CFB";
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = openssl_random_pseudo_bytes($ivlen);
		$encrypted_msg = openssl_encrypt($msg, $cipher, "key", $option=0, $iv);

		mysqli_query($conn,"insert into `chat` (chatroomid, message, encrypted_msg, userid, chat_date) values ('$id', '$encrypted_msg', '$encrypted_msg' , '".$_SESSION['id']."', NOW())") or die(mysqli_error());
	}