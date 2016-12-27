<?php

session_start();
error_reporting(0);

include "pages/template.php";
include "pages/header.php";
include "pages/content.php";
include "pages/footer.php";

$show = $template;
$pg=$_GET['pg'];
switch($pg)
{
	case "home":
		include "pages/content.php";
	break;
	case "calonsantri":
		include "pages/calonsantri.php";
	break;
	case "konfirmasipembayaran":
		include "pages/konfirmasipembayaran.php";
	break;
	case "kelulusan":
		include "pages/kelulusan.php";
	break;
	case "pemberkasan":
		include "pages/pemberkasan.php";
	break;
	case "wawancara":
		include "pages/wawancara.php";
	break;
	case "quisioner":
		include "pages/quisioner.php";
	break;
	case "logout":
		include "pages/logout.php";
	break;
	case "user":
		include "pages/user.php";
	break;
	default:

}

$show = str_replace("<!-- header -->",$header,$show);
$show = str_replace("<!-- content -->",$content,$show);
$show = str_replace("<!-- footer -->",$footer,$show);

echo $show;
?>
