<?php
session_start();

if(!$_SESSION["session_loganjungan"])
{
	if(ISSET($_POST['username'])){
		include "config.php";
		$sql = "SELECT hportu, nama FROM calonsiswa WHERE hportu='".$_POST['username']."' AND info3='".$_POST['password']."'";
		$query = mysql_query($sql);
		$data = mysql_fetch_row($query);
		$row = mysql_num_rows($query);
		if( $row > 0 ) {
			$_SESSION["session_loganjungan"] = "true";
			$_SESSION["session_username"] = $data[0];
			$_SESSION["session_name"] = $data[1];
			header("Location: ?pg=home");
			die();
		}else{
		    $message = "Username atau Password salah!";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
	}
	$template="
	<!DOCTYPE>
	<html>
	 <head>
	  <title> Login </title>
	  <meta name=\"Generator\" content=\"EditPlus\">
	  <meta name=\"Author\" content=\"\">
	  <meta name=\"Keywords\" content=\"\">
	  <meta name=\"Description\" content=\"\">
	  <link rel=\"stylesheet\" href=\"css/login.style.min.css\">
	 </head>

	 <body>
        <div class=\"login-page\">
            <div class=\"form\">
                <img src=\"../img/ic_logo.png\">
                <form method=\"POST\" action=\"\" class=\"login-form\">
                    <input type=\"text\" name=\"username\" placeholder=\"username\"/>
                    <input type=\"password\" name=\"password\" placeholder=\"password\"/>
                    <button class=\"btn-login\" type=\"submit\">login</button>
                    <p class=\"message\">Copyright &copy;2016 Ma'rifatussalaam</p>
                </form>
            </div>
        </div>
	</body>
	</html>
	";
}
else
{
	$template="
	<!DOCTYPE>
	<html>
		<head>
			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\"/>
			<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no\"/>
			<meta name=\"description\" content=\"Pendaftaran Online SMP Al-Qur'an Ma'rifatussalaam\">
			<meta name=\"author\" content=\"Asep Sholihin\">
			<meta name=\"keywords\" content=\"ma'rifatussalaam, Pendaftaran Online, boarding school, smp al-qur'an, smp, ma-had, tahfizh, pesantren\">
			<link rel=\"icon\" href=\"http://psmb.marifatussalaam.org/img/nav-logo.png\">
			<title ng-bind=\"title\">PSMB SMP Al-Qur'an Ma'rifatussalaam 2017/2018</title>
			<link rel=\"stylesheet\" href=\"css/style.min.css\">
			<link rel=\"stylesheet\" href=\"css/bootstrap.min.css\">

			<script src=\"js/vendor/jquery.js\"></script>
		</head>

		<body>
			<div id=\"wrapper\">
				<div id=\"header\"><!-- header --></div>
				<div id=\"content\"><!-- content --></div>
				<div id=\"footer\"><!-- footer --></div>
			</div>
		</body>
	</html>
	";
}
?>
