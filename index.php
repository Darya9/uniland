<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<?
	include 'data.php';
	?>
	<title><?=str_replace('<br>', ' ', $LAND_DATA['main_header'])?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link rel="stylesheet" href="css/styles.css">
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/jquery.tubular.1.0.js"></script>
	<script src="js/script.js"></script>
	<?if($LAND_DATA['favicon']=="on") {?>
  		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  	<?}?>
</head>
<?
$body_style = '';
if (!$LAND_DATA['video_back']) {
	foreach (glob( __DIR__."/back/*") as $file) {
		$body_style='style="background-image: url('.str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']) . str_replace(__DIR__, '', $file).'); background-size: cover; background-position: 50% 50%;"';
	}
	
}
?>
<body >
<div class="body-back" <?=$body_style?>>
	
</div>
<div class="hidden_data">
	<div class="video_back"><?=trim($LAND_DATA['video_back'])?></div>
	<?
	if($LAND_DATA['download_file']=="on") {
		foreach (glob( __DIR__."/files/*") as $file) {?>
			<div class="file_to_download"><?=str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']) . str_replace(__DIR__, '', $file)?></div>
		<?}			
	}
	
	if ($LAND_DATA['counter_number']) {
		$LAND_DATA['counter_number'] = trim($LAND_DATA['counter_number']);
	}?>
</div>
<div class="land">
	<div class="header">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-3">
					<div class="header-left">
						<?=$LAND_DATA['header_left']?>
					</div>
				</div>
				<div class="col-xs-12 col-sm-3">
					<div class="header-center">
						<?=$LAND_DATA['header_center']?>
					</div>
				</div>
				<div class="col-xs-12 col-sm-3">
					<div class="header-center">
						<?if ($LAND_DATA['header_center2']) {?>
							<a class="a_contact" href="mailto:<?=$LAND_DATA['header_center2']?>"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <?=$LAND_DATA['header_center2']?></a>
						<?}?>
					</div>
				</div>
				<div class="col-xs-12 col-sm-3">
					<div class="header-right">
						<?if ($LAND_DATA['header_right']) {?>
							<a class="a_contact" href="tel:<?=$LAND_DATA['header_right']?>"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> <?=$LAND_DATA['header_right']?></a>
						<?}?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="main-block" style='<?=($LAND_DATA['main_text_color']? "color: ".$LAND_DATA['main_text_color'].";" : "")?> <?=($LAND_DATA['main_text_shadow_color']? "text-shadow: 1px 1px 2px ".$LAND_DATA['main_text_shadow_color'].";" : "")?>' >
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<h1><?=$LAND_DATA['main_header']?></h1>
					<p class="preferences-<?=($LAND_DATA['main_text1_align']=='on'? 'list' : 'text')?>" >
						<?=$LAND_DATA['main_text1']?>
					</p>
					<p class="preferences-<?=($LAND_DATA['main_text2_align']=='on'? 'list' : 'text')?>">
						<?=$LAND_DATA['main_text2']?>
					</p>
				</div>
			</div>
		</div>
	</div>
	<div class="content">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-7">
					<div class="video">
						<iframe width="500px" height="280px" src="https://www.youtube.com/embed/<?=trim($LAND_DATA['video_content'])?>" frameborder="0" allowfullscreen></iframe>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-5">
					<form class="main_form <?=( ($LAND_DATA['name_on']=='on'&&$LAND_DATA['phone_on']=='on'&&$LAND_DATA['email_on']=='on') ? 'three-form' : '')?>" action="">
						<h3><?=$LAND_DATA['form_name']?></h3>
						<?if($LAND_DATA['name_on']=="on") {?>
							<input type="text" name="name" class="input name <?=($LAND_DATA['name_required']=="on"? "required" : "")?>" placeholder="Имя">
							<div class="alert-msg alert-name">Пожалуйста, заполните поле "Имя"</div>
						<?}?>
						<?if($LAND_DATA['phone_on']=="on") {?>
							<input type="text" name="phone" class="input phone <?=($LAND_DATA['phone_required']=="on"? "required" : "")?>" placeholder="Телефон">
							<div class="alert-msg alert-phone">Пожалуйста, заполните поле "Телефон"</div>
							<div class="alert-msg error-phone">Поле "Телефон" заполнено неверно</div>
						<?}?>
						<?if($LAND_DATA['email_on']=="on") {?>
							<input type="text" name="email" class="input email <?=($LAND_DATA['email_required']=="on"? "required" : "")?>" placeholder="Email">
							<div class="alert-msg alert-email">Пожалуйста, заполните поле "Email"</div>
							<div class="alert-msg error-email">Поле "Email" заполнено неверно</div>
						<?}?>
						<div class="alert-msg success">Спасибо, ваша заявка принята!</div>
						<div class="alert-msg error">Произошла ошибка, попробуйте позже.</div>
						
						<input type="hidden" name="check_to_f" class="check_to_f">
						<input type="hidden" name="check_to_e" class="check_to_e" value="Y">

						<button type="submit" <?=($LAND_DATA['counter_number']&&$LAND_DATA['button_goal'])? 'onclick="yaCounter'.$LAND_DATA['counter_number'].'.reachGoal(\''.trim($LAND_DATA['button_goal']).'\');"' : '' ?> ><?=$LAND_DATA['button_name']?></button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="footer">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-3">
					<div class="footer-left"> 
						<?=$LAND_DATA['footer_left']?>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6">
					<div class="footer-center">
						<?if ($LAND_DATA['footer_center']) {?>
							<span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> <?=$LAND_DATA['footer_center']?>
						<?}?>
					</div>
				</div>
				<div class="col-xs-12 col-sm-3">
					<div class="footer-right">
						<?if ($LAND_DATA['footer_right']) {?>
							<a class="a_contact" href="tel:<?=$LAND_DATA['footer_right']?>"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> <?=$LAND_DATA['footer_right']?></a>
						<?}?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?if ($LAND_DATA['counter_number']) {?>
	<!-- Yandex.Metrika counter -->
	<script type="text/javascript">
	    (function (d, w, c) {
	        (w[c] = w[c] || []).push(function() {
	            try {
	                w.yaCounter<?=$LAND_DATA['counter_number']?> = new Ya.Metrika({
	                    id:<?=$LAND_DATA['counter_number']?>,
	                    clickmap:true,
	                    trackLinks:true,
	                    accurateTrackBounce:true,
	                    webvisor:true
	                });
	            } catch(e) { }
	        });

	        var n = d.getElementsByTagName("script")[0],
	            s = d.createElement("script"),
	            f = function () { n.parentNode.insertBefore(s, n); };
	        s.type = "text/javascript";
	        s.async = true;
	        s.src = "https://mc.yandex.ru/metrika/watch.js";

	        if (w.opera == "[object Opera]") {
	            d.addEventListener("DOMContentLoaded", f, false);
	        } else { f(); }
	    })(document, window, "yandex_metrika_callbacks");
	</script>
	<noscript><div><img src="https://mc.yandex.ru/watch/<?=$LAND_DATA['counter_number']?>" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
	<!-- /Yandex.Metrika counter -->
<?}?>
<?//=str_replace("<br>", '', $LAND_DATA['metrik_code']);?>
</body>
</html>