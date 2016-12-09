<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Панель управления лендингом</title>
	<meta name="robots" content="noindex, nofollow" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<style>
		* {
			box-sizing: border-box;
			font-family: 'Open Sans', sans-serif;
		}
		body {
			position: relative;
			overflow-x: hidden;
			padding: 20px 30px;
			background: #f7f7f7;
		}
		body:before {
			content: '';
			position: absolute;
			z-index: -1;
			width: 115%;
			left: -5%;
			top: -10px;
			height: 350px;
			background: #6E8FCC;
		}
		.page {
			margin: 0 auto;
			padding: 10px 30px;
			background: #fff;
			min-height: 500px;
			border-radius: 10px;
			max-width: 1000px;
			-webkit-box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.51);
			-moz-box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.51);
			box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.51);
		}
		h1 {
			font-size: 25px;
			margin-bottom: -10px;
		}
		h2 {
			font-size: 20px;
			margin: 20px 0 10px;
		}
		h2:before {
			content: '';
			display: block;
			width: 100%;
			height: 1px;
			background: #ddd;
			margin-bottom: 25px;
    		margin-top: 35px;
		}
		input[type="text"], input[type="password"] {
			display: block;
			padding: 0 5px;
			width: 300px;
			max-width: 100%;
			margin-top: 5px;
		}
		input[type="file"] {
			display: block;
			padding: 0 5px;
			margin-top: 5px;
		}

		textarea {
			display: block;
			padding: 0 5px;
			width: 400px;
			max-width: 100%;
			resize: vertical;
			height: 40px;
			margin-top: 5px;
		}
		label {
			font-size: 14px;
			display: table;
			margin: 0 0 10px;
		}
		button {
			margin: 20px 0;
		}

		@media(max-width: 420px) {
			body {
				padding: 20px 5px;
			}
			.page {
				margin: 0 auto;
				padding: 10px 20px;
			}
		}
	</style>
</head>
<body>
	<div class="page">
		<?include 'users.php';
		if ($_POST['login']=='admin' && $_POST['password']==$password) {?>
			<?if ($_POST['change_data']=="Y") {
				$fp = fopen("data.php", 'ar');
				ftruncate($fp, 0);
				$record = fwrite($fp, "<?\n");
				foreach ($_POST as $key => $val) {
					if ($key!='login' && $key!='password' && $key!='change_data') {
						$val = str_replace("\r\n", '<br>', $val);
						$val = addslashes ($val);
						$record = fwrite($fp, '$LAND_DATA["'.$key.'"]="'.$val.'";'."\n");
					}
				}
				$record = fwrite($fp, "?>"); 
				fclose($fp); 
			}
			if ($_FILES['favicon']['tmp_name']){
				if (move_uploaded_file($_FILES['favicon']['tmp_name'], __DIR__."/favicon.ico")) {
				}
			}
			if ($_FILES['file_to_download']['tmp_name']){
				if (file_exists( __DIR__."/files/"))
				foreach (glob( __DIR__."/files/*") as $file)
					unlink($file);
				if (move_uploaded_file($_FILES['file_to_download']['tmp_name'], __DIR__."/files/".$_FILES['file_to_download']['name'])) {
				}
			}
			if ($_FILES['background_img']['tmp_name']){
				if (file_exists( __DIR__."/back/"))
				foreach (glob( __DIR__."/back/*") as $file)
					unlink($file);
				if (move_uploaded_file($_FILES['background_img']['tmp_name'], __DIR__."/back/".$_FILES['background_img']['name'])) {
				}
			}
			include 'data.php';
			foreach ($LAND_DATA as $key => $val) {
				$LAND_DATA[$key] = str_replace('<br>', "\r\n", $val);
			}
			
			?>
			<h1>Панель управления лендингом</h1>
			<form action="panel.php" method="POST" enctype="multipart/form-data">

				<h2>Общие</h2>
					<label>
						Id видео для фона:
						<input type="text" name="video_back" value="<?=$LAND_DATA['video_back']?>">
					</label>
					<label>
						Картинка для фона:
						<input type="file" name="background_img">
					</label>
					<br>
					<label>
						Список email для отправки заявок (через запятую):
						<input type="text" name="deliver_to" value="<?=$LAND_DATA['deliver_to']?>">
					</label>
					<label>
						Список email для отправки скрытых копий заявок (через запятую):
						<input type="text" name="deliver_hide" value="<?=$LAND_DATA['deliver_hide']?>">
					</label>
					<br>
					<label>
						Номер счетчика Яндекс метрики:
						<input type="text" name="counter_number" value="<?=$LAND_DATA['counter_number']?>">
					</label>
					<label>
						Идентификатор цели для оправки формы:
						<input type="text" name="button_goal" value="<?=$LAND_DATA['button_goal']?>">
					</label>
					<br>
					<label>
						<input type="checkbox" name="favicon" <?=($LAND_DATA['favicon']=="on"? "checked" : "")?> > 
						Отображать фавикон
					</label>
					<label>
						Фавикон (с расширением .ico)
						<input type="file" name="favicon">
					</label>
				
				<h2>Хедер</h2>
					<label>
						Дескриптор:
						<textarea name="header_left"><?=$LAND_DATA['header_left']?></textarea>
					</label>
					<label>
						Регион:
						<textarea name="header_center"><?=$LAND_DATA['header_center']?></textarea>
					</label>
					<label>
						Почта:
						<input type="text" value="<?=$LAND_DATA['header_center2']?>" name="header_center2">
					</label>
					<label>
						Телефон:
						<input type="text" value="<?=$LAND_DATA['header_right']?>" name="header_right">
					</label>
					<label>
				
				<h2>Тексты</h2>
					<label>
						Цвет текстов:
						<input type="color" value="<?=$LAND_DATA['main_text_color']?>" name="main_text_color">
					</label>
					<label>
						Цвет тени для текстов:
						<input type="color" value="<?=$LAND_DATA['main_text_shadow_color']?>" name="main_text_shadow_color">
					</label>
					<label>
						Оффер:
						<textarea name="main_header"><?=$LAND_DATA['main_header']?></textarea>
					</label>
					<br>
					<label>
						Первая область под заголовком:
						<textarea name="main_text1"><?=$LAND_DATA['main_text1']?></textarea>
					</label>
					<label>
						<input type="checkbox" name="main_text1_align" <?=($LAND_DATA['main_text1_align']=="on"? "checked" : "")?> > Выравнивать по левому краю (для списков)
					</label>
					<br>
					<label>
						Вторая область под заголовком:
						<textarea name="main_text2"><?=$LAND_DATA['main_text2']?></textarea>
					</label>
					<label>
						<input type="checkbox" name="main_text2_align" <?=($LAND_DATA['main_text2_align']=="on"? "checked" : "")?> > Выравнивать по левому краю (для списков)
					</label>

				<h2>Видео</h2>
					<label>
						Id видео для контента
						<input type="text" name="video_content" value="<?=$LAND_DATA['video_content']?>">
					</label>

				<h2>Форма</h2>
					<label>
						Название формы
						<textarea name="form_name"><?=$LAND_DATA['form_name']?></textarea>
					</label>
					<label>
						Надпись на кнопке
						<textarea name="button_name"><?=$LAND_DATA['button_name']?></textarea>
					</label>
					<br>
					<div><b>Поля:</b></div>

					Имя
					<label>
						<input type="checkbox" name="name_on" <?=($LAND_DATA['name_on']=="on"? "checked" : "")?> >Активное
					</label>
					<label>
						<input type="checkbox" name="name_required" <?=($LAND_DATA['name_required']=="on"? "checked" : "")?> > Обязательное
					</label>

					Телефон
					<label>
						<input type="checkbox" name="phone_on" <?=($LAND_DATA['phone_on']=="on"? "checked" : "")?> >Активное
					</label>
					<label>
						<input type="checkbox" name="phone_required" <?=($LAND_DATA['phone_required']=="on"? "checked" : "")?> > Обязательное
					</label>

					Email
					<label>
						<input type="checkbox" name="email_on" <?=($LAND_DATA['email_on']=="on"? "checked" : "")?> >Активное
					</label>
					<label>
						<input type="checkbox" name="email_required" <?=($LAND_DATA['email_required']=="on"? "checked" : "")?> > Обязательное
					</label>

					<br>
					<label>
						<input type="checkbox" name="download_file" <?=($LAND_DATA['download_file']=="on"? "checked" : "")?> > 
						Загружать файл после отправки формы
					</label>
					<label>
						Файл для загрузки
						<input type="file" name="file_to_download">
					</label>


				<h2>Футер</h2>
					<label>
						Название:
						<textarea name="footer_left"><?=$LAND_DATA['footer_left']?></textarea>
					</label>
					<label>
						Адрес:
						<textarea name="footer_center"><?=$LAND_DATA['footer_center']?></textarea>
					</label>
					<label>
						Телефон:
						<input type="text" value="<?=$LAND_DATA['footer_right']?>" name="footer_right">
					</label>
				
				<br>
				<input type="hidden" name="login" value="<?=$_POST['login']?>">
				<input type="hidden" name="password" value="<?=$_POST['password']?>">

				<button type="submit" name="change_data" value="Y">Сохранить</button>
			</form>
		<?} else {?>
			<h1>Пожалуйста, авторизуйтесь для доступа</h1>
			<br>
			<form action="panel.php" method="POST">
				<label>
					Логин
					<input type="text" name="login">
				</label>
				<label>
					Пароль
					<input type="password" name="password">
				</label>
				<button type="submit">Войти</button>
				
			</form>
			
		<?}?>
		
	</div>
</body>