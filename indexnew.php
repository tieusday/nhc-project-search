<?php
	include("LoadDb.php");
	$result = pg_query("SELECT * FROM system;") or die(pg_last_error());
    $rows = pg_fetch_array($result);

    if(isset($_REQUEST['Continue'])) {
    	$Person = strtoupper($_REQUEST['Person']);
		$Password = strtoupper($_REQUEST['Password']);
		$result = pg_query("SELECT * FROM person WHERE person = '" . pg_escape_string($Person) . "' AND password = '" . pg_escape_string($Password) . "' AND Length(person)>0 AND Length(password)>0;") or die(pg_last_error());
		if(pg_num_rows($result) < 1) {
			
		} else {
			session_start();
			$_SESSION['login'] = "1";
			$rows = pg_fetch_array($result);
			$PerNm = pg_escape_string($rows['name_first']) . " " . pg_escape_string($rows['name_last']);
			if ($rows['office'] == 1) {
				$PerNm = $PerNm . ", Edmonton";
			} else {
				$PerNm = $PerNm . ", Vancouver";
			}
			header("Location: ProjSearchNew_V3.php?PerNm=" . $PerNm);
		}
	} else {
		
    }

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>NHC Project Search</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, intial-scale=1">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="styles.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script src="scripts.js" type="text/javascript"></script>
	</head>

	<body class="login">
		<div class="container-fluid">
			<div class="row vertical-center">
				<div class="col-sm-4"></div>
				<div class="col-sm-4">
					<h1 class="text-center">NHC Project Search</h1>
					<div class="panel panel-default" id="panel">
						<div class="panel-body">
							<form role="form" name="LogIn" onsubmit="return checkInput();" method="POST" action="indexnew.php">
								<div class="form-group">
									<label for="username">Username: </label>
									<input type="text" name="Person" value='<?php htmlspecialchars(stripslashes($Person), ENT_QUOTES); ?>' class="form-control" id="username">
								</div>
								<div class="form-group">
									<label for="password">Password: </label>
									<input type="password" name="Password" class="form-control" id="password">
								</div>
								<button type="submit" name='Continue' class="btn btn-primary btn-block">Login</button>
							</form>
						</div>
					</div>						
				</div>
				<div class="col-sm-4"></div>
			</div>
		</div>
	</body>

</html>
