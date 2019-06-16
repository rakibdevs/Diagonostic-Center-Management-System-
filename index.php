<?php
ob_start();
session_start();
require_once('connect.php');
if(isset($_SESSION['userId'])){
	header("Location:dashboard.php?active=dashboard");
}else{
?>
<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
	<title>Login | <?php
                                      $labsql = "SELECT * FROM lab_info WHERE id=1";
                                      $result = $mysqli->query($labsql); 
                                      while ($row = $result->fetch_assoc()) {
                                        echo $row['lab_name'];
                                       }
                                    ?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	
	<link rel="stylesheet" href="assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	
	<!-- Favicon -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/favicon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
</head>

<body>
    <?php
			if (isset($_POST['submit'])) {
				
				$userTypeInput = $_POST['userType'];
				$userNameInput = $_POST['userName'];
				$userPassInput = md5($_POST['userPass']);
				
				$loginSql = "SELECT * FROM user WHERE "
							."user_name = '$userNameInput'"
							."and pass = '$userPassInput'"
							."and user_type = '$userTypeInput'";
				
				$query = $mysqli->query($loginSql) or die($mysqli->error);
				$count = $query->num_rows;
				
				if($count == 1){
						$array = $query->fetch_array();
						$_SESSION['userId'] = $array['id'];
						$_SESSION['fullName'] = $array['full_name'];
						$_SESSION['userName'] = $array['user_name'];
                        $_SESSION['userPass'] = $array['pass'];
						$_SESSION['userType'] = $array['user_type'];
						header("Location:dashboard.php?active=dashboard");
				}else{
					$error="Sorry! Wrong Username/Password";
				}

			}
		?>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							<div class="header">
								<div class="logo text-center"><img style="height:150px;" src="assets/img/logo.png" alt=" Diagnostic Centre"></div>
								<!-- <p class="lead">Login to your account</p> -->
							</div>
							<p style='color:#F00; font-weight:bold'>
								
					            <?php if(isset($error)){echo $error;}?>
							</p>
							<form class="form-auth-small" action="index.php" method="post">
							    <div class="form-group">
									<select name="userType" class="form-control" required>
					                	<option value="">--Select User Type--</option>
					                    <option value="Administrator">Administrator</option>
					                    <option value="User">User</option>
					                    <option value="Pathology">Pathology</option>
					                </select>
								</div>
								<div class="form-group">
									<label for="signin-email" class="control-label sr-only">Username</label>
									<input type="text" class="form-control" placeholder="Username" name="userName" id="signin-email" required >
								</div>
								<div class="form-group">
									<label for="signin-password" class="control-label sr-only">Password</label>
									<input type="password" class="form-control" id="signin-password" name="userPass" placeholder="Password" required >
								</div>
								
								<button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
								
							</form>
							
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
						    <?php
						      $labsql = "SELECT * FROM lab_info WHERE id=1";
						      $result = $mysqli->query($labsql); 
						      while ($row = $result->fetch_assoc()) {
						      	echo '<h1 class="heading">'.$row['lab_name'].'</h1>
							<p>'.$row['address'].'</p>';
                               }
						    ?>
							<br>
							<p>Demo <br> Administrator: admin 1234 <br>Pathology: pathology 1234 <br> User: user 1234</p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>

</html>
<?php
}
?>
