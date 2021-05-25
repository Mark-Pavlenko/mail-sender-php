<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'phpmailer/src/Exception.php';
	require 'phpmailer/src/PHPMailer.php';

	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->setLanguage('ru', 'phpmailer/language/');
	$mail->IsHTML(true);

	//От кого письмо
	$mail->setFrom('marko.pavlenko@nure.ua', $_POST['name']);
	//Кому отправить
	$mail->addAddress($_POST['email']);
	//Тема письма
	$mail->Subject = $_POST['messageTitle'];

	//Рука
	$hand = "Правая";
	if($_POST['hand'] == "left"){
		$hand = "Левая";
	}

   	//Тело письма

   	if(trim(!empty($_POST['name']))){
   		$name.='<p><strong>Имя:</strong> '.$_POST['name'].'</p>';
   	}
   	if(trim(!empty($_POST['email']))){
   		$email.='<p><strong>E-mail:</strong> '.$_POST['email'].'</p>';
   	}

   	if(trim(!empty($_POST['message']))){
   		$message.='<p><strong>Сообщение:</strong> '.$_POST['message'].'</p>';
   	}

   	//Прикрепить файл
   	if (!empty($_FILES['image']['tmp_name'])) {
   		//путь загрузки файла
   		$filePath = __DIR__ . "/files/" . $_FILES['image']['name'];
   		//грузим файл
   		if (copy($_FILES['image']['tmp_name'], $filePath)){
   			$fileAttach = $filePath;
   			$file.='<p><strong>Приложенные файлы</strong>';
   			$mail->addAttachment($fileAttach);
   		}
   	}

    $body = '<html lang="en">
               <head>
                 <meta charset="UTF-8" />
                 <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                 <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                 <style>
                 .main-block-bg {
                   background-color: transparent;
                   background-image: url(https://www.game1.farmerxxl.de/img/main_bg_repeat.png);
                   background-position: top center;
                   background-repeat: repeat;
                   /*background-size: contain;*/
                   box-sizing: border-box;
                   display: table;
                   margin-top: 10px;
                   min-height: 218px;
                   padding: 32px 22px 22px;
                   position: relative;
                   width: auto;
                   margin-bottom: 20px;

                 }

                 .main-block-bg:before {
                   background-image: url(https://www.game1.farmerxxl.de/img/main_bg_top.png);
                   background-repeat: no-repeat;
                   content: "";
                   height: 122px;
                   left: 0;
                   position: absolute;
                   right: 0;
                   top: -15px;
                   z-index: 0;
                 }

                 .main-block-border-bg {
                   background-image: url(https://www.game1.farmerxxl.de/img/main_border_bg.png);
                   background-repeat: repeat;
                   box-sizing: border-box;
                   color: #fff;
                   display: table;
                   padding: 27px 31px 30px;
                   position: relative;
                   width: 960px;
                   min-height: 150px;
                   width: auto;
                 }
                 .main-block-border-bg a {
                   color: #fdc50d;
                 }
                 .main-block-border-bg a:hover {
                   color: #b3692e;
                 }
                 .main-block-border-bg .tool i {
                   color: #000;
                 }
                 .main-block-border-bg:before {
                   background-image: url(https://www.game1.farmerxxl.de/img/main_border_bg_top.png);
                   background-repeat: no-repeat;
                   content: "";
                   height: 44px;
                   left: 0;
                   position: absolute;
                   right: 0;
                   top: -15px;
                   z-index: 0;
                   /*width: 284px;*/
                 }
                 .main-block-border-bg:after {
                   background-image: url(https://www.game1.farmerxxl.de/img/main_border_bg_bottom.png);
                   background-repeat: no-repeat;
                   bottom: -9px;
                   content: "";
                   height: 34px;
                   left: 0;
                   position: absolute;
                   right: 0;
                   z-index: 0;
                 }

                 h2 {
                   font-size: 14px;
                   font-weight: bold;
                   margin-bottom: 10px;
                   color: #8ebf2a;
                 }

                 h3 {
                   font-size: 13px;
                   font-weight: bold;
                   margin-bottom: 5px;
                   color: #8ebf2a;
                 }
                 h3.inactive {
                   font-style: italic;
                   color: #b6b6b6;
                 }

                 /* Zusatzinfos */
                 h5 {
                   font-size: 11px;
                   font-weight: normal;
                   margin-bottom: 10px;
                   color: #fff;
                   font-style: italic;
                 }

                 /* Seiteninhalt */
                 #wrap {
                   /* width wird im Template festgelegt */
                   margin: auto;
                   /*max-height: 1080px;*/
                   overflow: hidden;
                   width: 1000px;
                 }
                 #wrap.no-premium {
                   /*max-height: 1345px;*/
                 }
                 #wrap .wrap_content {
                   background: #c3de80;
                   margin: 0 auto;
                   padding: 10px;
                   width: 1005px;
                 }
                 #wrap .wrap_content.with-img {
                   background-color: transparent;
                   padding: 0;
                 }

                 #wrap .wrap_content .copyright {
                   margin-top: 20px;
                   padding: 5px;
                   text-align: right;
                   border-top: 1px dotted #9a9a9a;
                   font-size: 9px;
                   color: #9a9a9a;
                 }

                 #wrap .wrap_banner {
                   display: none;
                   /*float: left;*/
                   /*width: 103px;*/
                   /*text-align: center;*/
                 }

                 .block-info p {
                   box-sizing: border-box;
                   color: #e5ae86;
                   display: block;
                   font-size: 15px;
                   font-weight: normal;
                   margin-bottom: 5px;
                   padding: 5px;
                   text-align: center;
                   text-shadow: 1px 1px 10px #000, 1px 1px 10px #000;
                   width: 100%;
                 }
                 /* Rohstoff - Gro?e Anscht */
                 .material {
                   background-color: #1c1211;
                   background-position: center;
                   background-repeat: no-repeat;
                   background-size: contain;
                   border: 1px solid #8b513b;
                   border-radius: 4px;
                   box-shadow: 0 0 5px 1px rgba(0, 0, 0, 0.5);
                   float: left;
                   height: 47px;
                   margin: 2px 6px;
                   position: relative;
                   width: 47px;
                 }

                 </style>
               </head>
               <body class="body_bg">
                 <div id="wrap" class="no-premium" style="max-height: 1954px;">
                   <div class="wrap_content with-img">
                     <div class="main-block-bg">
                       <div class="main-block-border-bg">
                         <h2>Some text</h2>
                         <div class="error_message">
                           <p>Keine aktive Session gefunden!</p><br /><br />
                           <a href="#">Startseite</a>
                         </div>
                       </div>
                     </div>
                   </div>
                 </div>
               </body>
             </html>';

    $array = array($name, $email,  $message, $file);
    foreach($array as $elements){
        $mail->Body = ($body.$name.$email.$age.$message.$file);
    }

	//Отправляем
	if (!$mail->send()) {
		$message = 'Ошибка';
	} else {
		$message = 'Данные отправлены!';
	}

	$response = ['message' => $message];

	header('Content-type: application/json');
	echo json_encode($response);
?>