<?
//print_r($_POST);
include 'data.php';

$to = $LAND_DATA['deliver_to'];  
if ($LAND_DATA['deliver_hide']) {
	$hide_copy = "BCC: ".$LAND_DATA['deliver_hide']."\r\n";
} else {
	$hide_copy = "";
}

$message = '';
if ($_POST['name']) {
	$message = "Имя: ".$_POST['name']."\n";
}
if ($_POST['phone']) {
	$message .= "Телефон: ".$_POST['phone']."\n";
}
if ($_POST['email']) {
	$message .= "Email: ".$_POST['email']."\n";
}
$theme = 'Заявка с Лендинга '.$_SERVER['SERVER_NAME'];

if ($_POST['check_to_f']=='Y' && $_POST['check_to_e']=='' && $_GET['check_get']=='Y' ) {
	echo mail($to, $theme, $message, $hide_copy."From: Лендинг <info@39landingov.ru>\r\nX-Mailer: PHP/" . phpversion());
}
?>