<?php
session_start();
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
	case "ubahdata":
		include "pages/ubahdata.php";
	break;
	case "konfirmasipembayaran":
		include "pages/konfirmasipembayaran.php";
	break;
	case "uploadnilai":
		include "pages/uploadnilai.php";
	break;
	case "logout":
		include "pages/logout.php";
	break;
	default:

}

$show = str_replace("<!-- header -->",$header,$show);
$show = str_replace("<!-- content -->",$content,$show);
$show = str_replace("<!-- footer -->",$footer,$show);

echo $show;
?>
