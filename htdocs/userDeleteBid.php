<?php
include("header.php");

$advertisementID = $_GET['id'];
$email = $_SESSION['user'];
$creator = pg_query($db, "SELECT email FROM bid WHERE advertisementid = '" . $advertisementID . "';");
if(is_null($advertisementID)){
	$message = "Oops something went wrong!";
	echo "<script type='text/javascript'>alert('$message');
		window.location.href='userPage.php';
	</script>";
}
if(pg_num_rows($creator == 0)){
	$message = "Advertisement not found!";
	echo "<script type='text/javascript'>alert('$message');
		window.location.href='userPage.php';
	</script>";	
}
if(pg_fetch_array($creator)[0] != $email){
	$message = "You are not authorized to view this page!";
	echo "<script type='text/javascript'>alert('$message');
		window.location.href='userPage.php';
	</script>";
}
if(isset($_POST['yes'])){
	$result = pg_query_params($db, 'SELECT deleteBid($1, $2)', array($email, $advertisementID));
	header("Location: userBid.php");
}
elseif(isset($_POST['no'])){
	header("Location: userBid.php");
}
?>

<html>
<body id="b6">
	<div class="col-lg-12" style="height:50px;"></div>
	<h2 class="text-center">Are you sure you want to delete?</h2>
	<div class="col-lg-12" style="height:25px;"></div>
	<div class="row">
		<form action="" method="post">
			<div class="col-md-offset-5 col-md-1">
				<button type="submit" name="yes" class="btn btn-primary">Yes</button>
			</div>
			<div class="col-md-6 col-md-1">
				<button type="submit" name="no" class="btn btn-primary">No</button>
			</div>
	</div>
</body>
</html>