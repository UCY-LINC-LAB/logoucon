<?php
include 'init.php';

$first=$_POST['fname'];
$last=$_POST['lname'];
$password =$_POST['password'];
$current=$_POST['current_password'];

$id=$_SESSION["therapist_id"];
$email=$_SESSION["email"];

if(isset($_POST['changeName'])){

	$updateName = mysqli_query($conn,"UPDATE user set first_name='$first', last_name='$last' where email= '$email'");
	if(!$updateName){
		echo "<script>";
		echo " alert('Your changes could not be saved.');      
		window.location.href='". $_SERVER['HTTP_REFERER']."';
		</script>";
	}else{
		$_SESSION['first_name']=$first;
		$_SESSION['last_name']=$last;

		echo "<script>";
		echo " alert('Your changes were saved successfully.');      
		window.location.href='". $_SERVER['HTTP_REFERER']."';
		</script>";
	}
}

if(isset($_POST['changePassword'])){
	$get_pass =  mysqli_fetch_array(mysqli_query($conn,"SELECT password from user where email='$email'"));
	if($current==$get_pass['password'])
		$updatePassowrd = mysqli_query($conn,"UPDATE user set password='$password' where email='$email'");

	if(!$updatePassowrd){

		echo "<script>";
		echo " alert('Your changes could not be saved.');      
		window.location.href='". $_SERVER['HTTP_REFERER']."';
		</script>";
	}else{
		$_SESSION['passowrd']=$password;

		echo "<script>";
		echo " alert('Your changes were saved successfully.');      
		window.location.href='". $_SERVER['HTTP_REFERER']."';
		</script>";
	}
}

$target_dir = "../img/profile/";
$imageFileType = pathinfo(basename($_FILES["file-upload"]["name"]),PATHINFO_EXTENSION);
$target_file = $target_dir . $id.'.'. $imageFileType;

$path="img/profile/". $id.'.'. $imageFileType;

if(isset($_POST['upload_photo'])){}
	$updatePhoto= mysqli_query($conn,"UPDATE user set profile_photo='$path' where email= '$email'");

	move_uploaded_file($_FILES['file-upload']['tmp_name'], $target_file);

	if(!$updatePhoto){
		echo "<script>";
		echo " alert('Your changes could not be saved.');      
		window.location.href='". $_SERVER['HTTP_REFERER']."';
		</script>";
	}else{
		$_SESSION['photo']=$path;

		echo "<script>";
		echo " alert('Your changes were saved successfully.');      
		window.location.href='". $_SERVER['HTTP_REFERER']."';
		</script>";
	}

?>