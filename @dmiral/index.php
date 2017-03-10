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
	case "kelulusan-ikhwan":
		include "pages/kelulusan-ikhwan.php";
	break;
	case "kelulusan-akhwat":
		include "pages/kelulusan-akhwat.php";
	break;
	case "daftar-lulus-ikhwan":
		include "pages/daftar-lulus-ikhwan.php";
	break;
	case "daftar-lulus-akhwat":
		include "pages/daftar-lulus-akhwat.php";
	break;
	case "pemberkasan":
		include "pages/pemberkasan.php";
	break;
	case "raport":
		include "pages/raport.php";
	break;
	case "wawancara":
		include "pages/wawancara.php";
	break;
	case "hasil-wawancara":
		include "pages/hasil-wawancara.php";
	break;
	case "quisioner":
		include "pages/quisioner.php";
	break;
	case "hasil-quisioner":
		include "pages/hasil-quisioner.php";
	break;
	case "seleksi":
		include "pages/seleksi.php";
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
