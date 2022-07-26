<?php

Header("Content-Type: text/html;charset=UTF-8");

include_once 'setting.php';
session_start();
$CONNECT = mysqli_connect(HOST, USER, PASS, DB);

if ($_SERVER['REQUEST_URI'] == '/') {
$Page = 'index';
$Module = 'index';
} else {
$URL_Path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$URL_Parts = explode('/', trim($URL_Path, ' /'));
$Page = array_shift($URL_Parts);
$Module = array_shift($URL_Parts);

if (!empty($Module)) {
$Param = array();
for ($i = 0; $i < count($URL_Parts); $i++) {
$Param[$URL_Parts[$i]] = $URL_Parts[++$i];
}
}
}

if ($Page == 'index') include('./page/index.php');
else if ($Page == 'contact') include('./page/contact.php');
else if ($Page == 'about') include('./page/about.php');

else if ($Page == 'query') include('./form/query.php');


else if ($Page == 'procorp') include('./page/procorp.php');

/**************Скрипты обработчики************************/
else if ($Page == 'account') include('./page/account.php');


else {
header('location: /');
}

function MessageSend($p1, $p2) {
if ($p1 == 1) $p1 = 'Ошибка';
else if ($p1 == 2) $p1 = 'Подсказка';
else if ($p1 == 3) $p1 = 'Информация';
else if ($p1 == 4) $p1 = 'Предупреждение';
$_SESSION['message'] = '<div class="MessageBlock"><b>'.$p1.'</b>: '.$p2.'</div>';
exit(header('Location: '.$_SERVER['HTTP_REFERER']));
}

function MessageShow() {
if ($_SESSION['message'])$Message = $_SESSION['message'];
echo $Message;
$_SESSION['message'] = array();
}

/**********Шифрование паролей и полей**************/

function FormChars ($p1) {
return nl2br(htmlspecialchars(trim($p1), ENT_QUOTES), false);
}

function GenPass ($p1, $p2) {
return md5('STADISIL'.md5('857'.$p1.'758').md5('678'.$p2.'890'));
}
/**************************************************/

function Head($p1) {
echo '<!DOCTYPE html><html><head>
    <meta name="yandex-verification" content="1d80c7cd1f7b92cc" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="/resource/style.css" type="text/css"/>
<meta name="viewport" content="width=device-width, initial-scale=1"><meta charset="utf-8" /><title>'.$p1.'</title><link rel="shortcut icon" href="/img/logo/logo.ico" type="image/x-icon"><meta name="keywords" content="" /><meta name="description" content="" /><link href="../resource/style.css" rel="stylesheet"><script src="/blockeditor.js"></script></head>';
}

function top_head() {
	echo '<div id = "top_head_block">
			<div class = "logo_block">
				<a href = "/"><img src = "https://i.ibb.co/T2g8Q95/LOGO2.png>"></a>
			</div>
			<div class = "mobile_menu">
				<a class="main-item" href="javascript:void(0);" tabindex="1" ><img src = "/resource/menu.png"></a> 
					<ul class="sub-menu">
						<li><a href="/">Главная</a></li>  
					   <li><a href="/contact">Контакты</a></li> 
					   <li><a href="/about">О нас</a></li> 
					</ul> 
			</div>
			<div class = "main_menu">
				<ul class = "nav">
					<li><a href = "/"><h3>Главная</h3></a></li>
					<li><a href = "/contact"><h3>Контакты</h3></a></li>
					<li><a href = "/about"><h3>О нас</h3></a></li>
				</ul>
			</div>
		</div>';
}

?>
