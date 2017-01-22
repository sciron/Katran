<?php
require 'phpmailerautoload.php';
function ValidateEmail($email)
{
   $pattern = '/^([0-9a-z]([-.\w]*[0-9a-z])*@(([0-9a-z])+([-\w]*[0-9a-z])*\.)+[a-z]{2,6})$/i';
   return preg_match($pattern, $email);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['formid'] == 'index_form1')
{
   $mailto = 'zakaz@katran-sochi.com';
   $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
   $mailcc = 'katran-sochi@mail.ru';
   $mailbcc = 'kozin.alex@gmail.com';
   $subject = 'Заказ звонка';
   $message = 'Информация о заказе';
   $success_url = './spasibo.php';
   $error_url = './error.php';
   $error = '';
   $eol = "\n";
   $max_filesize = isset($_POST['filesize']) ? $_POST['filesize'] * 1024 : 1024000;
   $mail = new PHPMailer();
   $mail->IsSMTP();
   $mail->Host = 'mx1.hostinger.ru';
   $mail->Port = 465;
   $mail->SMTPAuth = true;
   $mail->Username = 'zakaz@katran-sochi.com';
   $mail->Password = '4f499a5b';
   $mail->SMTPSecure = true;
   $mail->Subject = stripslashes($subject);
   $mail->From = $mailfrom;
   $mail->FromName = $mailfrom;
   $mailto_array = explode(",", $mailto);
   $mailcc_array = explode(",", $mailcc);
   $mailbcc_array = explode(",", $mailbcc);
   for ($i = 0; $i < count($mailto_array); $i++)
   {
      if(trim($mailto_array[$i]) != "")
      {
         $mail->AddAddress($mailto_array[$i], "");
      }
   }
   for ($i = 0; $i < count($mailcc_array); $i++)
   {
      if(trim($mailcc_array[$i]) != "")
      {
         $mail->AddCC($mailcc_array[$i], "");
      }
   }
   for ($i = 0; $i < count($mailbcc_array); $i++)
   {
      if(trim($mailbcc_array[$i]) != "")
      {
         $mail->AddBCC($mailbcc_array[$i], "");
      }
   }
   $mail->AddReplyTo($mailfrom);
   if (!ValidateEmail($mailfrom))
   {
      $error .= "The specified email address is invalid!\n<br>";
   }

   if (!empty($error))
   {
      $errorcode = file_get_contents($error_url);
      $replace = "##error##";
      $errorcode = str_replace($replace, $error, $errorcode);
      echo $errorcode;
      exit;
   }

   $internalfields = array ("submit", "reset", "send", "filesize", "formid", "captcha_code", "recaptcha_challenge_field", "recaptcha_response_field", "g-recaptcha-response");
   $message .= $eol;
   $message .= "IP Address : ";
   $message .= $_SERVER['REMOTE_ADDR'];
   $message .= $eol;
   foreach ($_POST as $key => $value)
   {
      if (!in_array(strtolower($key), $internalfields))
      {
         if (!is_array($value))
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . $value . $eol;
         }
         else
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . implode(",", $value) . $eol;
         }
      }
   }
   $mail->CharSet = 'UTF-8';
   if (!empty($_FILES))
   {
       foreach ($_FILES as $key => $value)
       {
          if ($_FILES[$key]['error'] == 0 && $_FILES[$key]['size'] <= $max_filesize)
          {
             $mail->AddAttachment($_FILES[$key]['tmp_name'], $_FILES[$key]['name']);
          }
      }
   }
   $mail->WordWrap = 80;
   $mail->Body = $message;
   if (!$mail->Send())
   {
      die('PHPMailer error: ' . $mail->ErrorInfo);
   }
   header('Location: '.$success_url);
   exit;
}
?>
<!doctype html>
<html lang="ru">
<head>
<meta charset="utf-8">
<title>Такси Сочи Адлер, Низкие цены в Аэропорт, Красную поляну</title>
<meta name="description" content="Такси Катран в Сочи предоставляет услуги такси и трансфера. Онлайн заказ, дешевое такси в Сочи и премиальный сервис. Закажите такси в Адлер или такси в Сочи. Такси Сочи из аэропорта">
<meta name="keywords" content="такси сочи,такси адлер, такси сочи из аэропорта, такси сочи до аэропорта, дешевое такси">
<meta name="robots" content="INDEX, FOLLOW">
<link href="taxi.ico" rel="shortcut icon" type="image/x-icon">
<link href="2.css" rel="stylesheet">
<link href="index.css" rel="stylesheet">
<script>
function ValidateПерезвонить(theForm)
{
   var regexp;
   if (theForm.index_Editbox1.value == "")
   {
      alert("Введите минимум 10 символов");
      theForm.index_Editbox1.focus();
      return false;
   }
   if (theForm.index_Editbox1.value.length < 5)
   {
      alert("Введите минимум 10 символов");
      theForm.index_Editbox1.focus();
      return false;
   }
   return true;
}
</script>
</head>
<body>
<div id="index_PageHeader1" style="position:absolute;overflow:hidden;text-align:left;left:0px;top:0px;width:100%;height:113px;z-index:-1;">
<div id="wb_indexText13" style="position:absolute;left:211px;top:37px;width:186px;height:64px;text-align:center;">
<h1>Такси Сочи, Такси Сочи из Аэропорта, Такси Адлер, Такси Красная поляна</h1></div>
</div>
<div id="container">
<div id="wb_MasterObjects1" style="position:absolute;left:0px;top:0px;width:969px;height:1507px;">
<div id="master_Layer2" style="position:absolute;text-align:center;left:7%;top:139px;width:816px;height:26px;">
<div id="master_Layer2_Container" style="width:816px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
</div>
</div>
<div id="wb_masterCssMenu1" style="position:absolute;left:76px;top:139px;width:809px;height:28px;text-align:center;">
<ul>
<li class="firstmain"><a href="./index.php" target="_self" title="&#1043;&#1083;&#1072;&#1074;&#1085;&#1072;&#1103;">&#1043;&#1083;&#1072;&#1074;&#1085;&#1072;&#1103;</a>
</li>
<li><a href="./tarif.html" target="_self" title="&#1058;&#1072;&#1088;&#1080;&#1092;&#1099;">&#1058;&#1072;&#1088;&#1080;&#1092;&#1099;</a>
</li>
<li><a href="./tablo.html" target="_self" title="On-Line &#1090;&#1072;&#1073;&#1083;&#1086; &#1072;&#1101;&#1088;&#1086;&#1087;&#1086;&#1088;&#1090;&#1072;">On-Line&nbsp;&#1090;&#1072;&#1073;&#1083;&#1086;&nbsp;&#1072;&#1101;&#1088;&#1086;&#1087;&#1086;&#1088;&#1090;&#1072;</a>
</li>
<li><a href="./kontakt.html" target="_self" title="&#1050;&#1086;&#1085;&#1090;&#1072;&#1082;&#1090;&#1099;">&#1050;&#1086;&#1085;&#1090;&#1072;&#1082;&#1090;&#1099;</a>
</li>
<li><a href="./taxi_adler.php" target="_self">&#1058;&#1072;&#1082;&#1089;&#1080;&nbsp;&#1040;&#1076;&#1083;&#1077;&#1088;</a>
</li>
</ul>
<br>
</div>
<div id="wb_masterImage2" style="position:absolute;left:421px;top:-5px;width:128px;height:128px;">
<a href="./index.php"><img src="images/img0001.png" id="masterImage2" alt=""></a></div>
<div id="wb_masterkrasnaya_polyanaText4" style="position:absolute;left:630px;top:64px;width:204px;height:32px;text-align:center;">
<span style="color:#000000;font-family:Verdana;font-size:13px;">Заказать такси дешево <br>Тел: 8-963-164-59-49</span></div>
<div id="wb_masterText1" style="position:absolute;left:568px;top:14px;width:329px;height:38px;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;"> </span><span style="color:#000000;font-family:Verdana;font-size:32px;"><strong>Такси &quot;КАТРАН&quot;</strong></span></div>
<div id="wb_masterImage1" style="position:absolute;left:749px;top:2px;width:216px;height:111px;filter:alpha(opacity=20);opacity:0.20;">
<img src="images/img0002.png" id="masterImage1" alt="&#1079;&#1072;&#1082;&#1072;&#1079; &#1090;&#1072;&#1082;&#1089;&#1080; &#1074; &#1089;&#1086;&#1095;&#1080;, &#1074;&#1099;&#1079;&#1086;&#1074; &#1090;&#1072;&#1082;&#1089;&#1080;" title="&#1058;&#1072;&#1082;&#1089;&#1080; &quot;&#1050;&#1072;&#1090;&#1088;&#1072;&#1085;&quot;"></div>
<div id="wb_master_Image3" style="position:absolute;left:891px;top:4px;width:78px;height:109px;">
<img src="images/img0003.png" id="master_Image3" alt="&#1079;&#1072;&#1082;&#1072;&#1079; &#1090;&#1072;&#1082;&#1089;&#1080;, &#1076;&#1077;&#1096;&#1077;&#1074;&#1086;&#1077; &#1090;&#1072;&#1082;&#1080;&#1089;, &#1074;&#1089;&#1090;&#1088;&#1077;&#1090;&#1080;&#1090;&#1100; &#1074; &#1072;&#1101;&#1088;&#1086;&#1087;&#1086;&#1088;&#1090;&#1091;" title="&#1058;&#1072;&#1082;&#1089;&#1080; &quot;&#1050;&#1072;&#1090;&#1088;&#1072;&#1085;&quot; &#1057;&#1086;&#1095;&#1080;"></div>
<div id="wb_master_Image4" style="position:absolute;left:2px;top:2px;width:216px;height:111px;filter:alpha(opacity=20);opacity:0.20;">
<img src="images/img0004.png" id="master_Image4" alt="&#1079;&#1072;&#1082;&#1072;&#1079; &#1090;&#1072;&#1082;&#1089;&#1080; &#1074; &#1089;&#1086;&#1095;&#1080;, &#1074;&#1099;&#1079;&#1086;&#1074; &#1090;&#1072;&#1082;&#1089;&#1080;" title="&#1047;&#1072;&#1082;&#1072;&#1079;&#1072;&#1090;&#1100; &#1090;&#1072;&#1082;&#1089;&#1080; &#1074; &#1072;&#1101;&#1088;&#1086;&#1087;&#1086;&#1088;&#1090;"></div>
<div id="master_Layer1" style="position:absolute;text-align:center;left:0%;top:197px;width:965px;height:1308px;">
<div id="master_Layer1_Container" style="width:965px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
<div id="wb_master_Text12" style="position:absolute;left:226px;top:1254px;width:512px;height:54px;text-align:center;z-index:1;">
<span style="color:#FFFFFF;font-family:Arial;font-size:17px;">© 2014-2016 Такси &quot;Катран&quot;. Все права защищены<br> ИНН 231707975752 ОГРН 314236702900142 ОКПО 0159219183</span><span style="color:#000000;font-family:'Times New Roman';font-size:16px;"><br></span></div>
</div>
</div>
</div>
<div id="index_Layer1" style="position:absolute;text-align:center;left:1%;top:203px;width:944px;height:502px;">
<div id="index_Layer1_Container" style="width:944px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
<div id="wb_index_Telefon2" style="position:absolute;left:561px;top:107px;width:366px;height:32px;text-align:left;">
<span style="color:#FFFFFF;font-family:Verdana;font-size:27px;"><strong><a href="tel:89186071840" class="style_tel">7 918 607 18 40</a></strong></span><span style="color:#FFFFFF;font-family:Verdana;font-size:27px;"><strong> </strong></span><span style="color:#FF0000;font-family:Verdana;font-size:27px;">МТС</span></div>
<div id="wb_index_telefon1" style="position:absolute;left:561px;top:65px;width:377px;height:32px;text-align:left;">
<span style="color:#000000;font-family:Verdana;font-size:27px;"><strong><a href="tel:89631645949" class="style_tel">7 963 164 59 49</a> </strong></span><span style="color:#FFD700;font-family:Verdana;font-size:27px;">Билайн</span></div>
<div id="wb_index_Text18" style="position:absolute;left:15px;top:7px;width:405px;height:42px;text-align:center;">
<h3>Стоимость такси Сочи</h3></div>
<div id="wb_index_lable1" style="position:absolute;left:572px;top:10px;width:251px;height:42px;text-align:center;">
<h3>Заказ такси</h3></div>
<div id="wb_index_Text2" style="position:absolute;left:468px;top:400px;width:304px;height:64px;text-align:center;">
<span style="color:#FFFFFF;font-family:Verdana;font-size:13px;"> </span><span class="text">Такси &quot;Катран&quot; поможет посетить все знаковые места Сочи, обеспечит качественный и безопасный трансфер по выбранному маршруту</span></div>
<div id="wb_index_Form1" style="position:absolute;left:19px;top:427px;width:390px;height:52px;">
<form name="Перезвонить" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" accept-charset="UTF-8" id="index_Form1" onsubmit="return ValidateПерезвонить(this)">
<input type="hidden" name="formid" value="index_form1">
<input type="tel" id="index_Editbox1" style="position:absolute;left:11px;top:9px;width:199px;height:27px;line-height:27px;" name="Номер телефона" value="" title="&#1053;&#1086;&#1084;&#1077;&#1088; &#1090;&#1077;&#1083;&#1077;&#1092;&#1086;&#1085;&#1072;" placeholder="&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1085;&#1086;&#1084;&#1077;&#1088; &#1090;&#1077;&#1083;&#1077;&#1092;&#1086;&#1085;&#1072;">
<input type="submit" id="index_Button1" name="Заказать звонок" value="Заказать звонок" style="position:absolute;left:221px;top:9px;width:150px;height:29px;">
</form>
</div>
<div id="wb_index_Text16" style="position:absolute;left:454px;top:151px;width:463px;height:18px;text-align:center;">
<h2>Встреча&nbsp; такси Сочи из&nbsp; <a href="./AIR.html" title="Аэропорт Сочи" class="style2">аэропорта</a></h2></div>
<div id="wb_index_Text3" style="position:absolute;left:454px;top:188px;width:463px;height:18px;text-align:center;">
<h2>Бесплатное ожидание при задержке рейса</h2></div>
<div id="wb_index_Text5" style="position:absolute;left:454px;top:223px;width:463px;height:18px;text-align:center;">
<span style="color:#FFFFFF;font-family:Verdana;font-size:16px;">Фиксированные <a href="./tarif.html" class="style1">тарифы</a> и дешевое такси в Сочи</span></div>
<div id="wb_index_Text6" style="position:absolute;left:454px;top:262px;width:463px;height:18px;text-align:center;">
<span style="color:#FFFFFF;font-family:Verdana;font-size:16px;">Только иномарки&nbsp; с кондиционерами</span></div>
<div id="wb_index_Shape1" style="position:absolute;left:772px;top:403px;width:167px;height:75px;">
<a href="./zakaz.php"><img class="hover" src="images/img0007_hover.png" alt="" style="border-width:0;width:167px;height:75px;"><span><img src="images/img0007.png" id="index_Shape1" alt="" style="width:167px;height:75px;"></span></a></div>
<div id="wb_index_Text1" style="position:absolute;left:454px;top:299px;width:467px;height:18px;text-align:center;">
<h2>Гарантированная подача такси в указанное время</h2></div>
<table style="position:absolute;left:15px;top:65px;width:395px;height:325px;" id="indexTable1">
<tr>
<td class="cell0"><span style="color:#FFD700;font-family:Verdana;font-size:35px;line-height:41px;">Маршрут</span></td>
<td class="cell1"><span style="color:#FFD700;font-family:Verdana;font-size:27px;line-height:32px;">Цена</span><span style="color:#FFD700;font-family:Verdana;font-size:35px;line-height:32px;"> </span><span style="color:#FFD700;font-family:Verdana;font-size:20px;line-height:25px;">(руб)</span></td>
</tr>
<tr>
<td class="cell2"><span style="color:#FFFFFF;font-family:Verdana;font-size:16px;line-height:18px;"> Аэропорт - Адлер</span></td>
<td class="cell3"><span style="color:#000000;font-family:Arial;font-size:13px;line-height:18px;"> </span><span style="color:#FFFFFF;font-family:Verdana;font-size:16px;line-height:18px;">500</span></td>
</tr>
<tr>
<td class="cell2"><span style="color:#000000;font-family:Arial;font-size:13px;line-height:18px;"> </span><span style="color:#FFFFFF;font-family:Verdana;font-size:16px;line-height:18px;">Аэропорт - Хоста</span></td>
<td class="cell3"><span style="color:#000000;font-family:Arial;font-size:13px;line-height:18px;"> </span><span style="color:#FFFFFF;font-family:Verdana;font-size:16px;line-height:18px;">700</span></td>
</tr>
<tr>
<td class="cell2"><span style="color:#000000;font-family:Arial;font-size:13px;line-height:18px;"> </span><span style="color:#FFFFFF;font-family:Verdana;font-size:16px;line-height:18px;">Аэропорт - Сочи</span></td>
<td class="cell3"><span style="color:#000000;font-family:Arial;font-size:13px;line-height:18px;"> </span><span style="color:#FFFFFF;font-family:Verdana;font-size:16px;line-height:18px;">900 1100</span></td>
</tr>
<tr>
<td class="cell2"><span style="color:#000000;font-family:Arial;font-size:13px;line-height:18px;"> </span><span style="color:#FFFFFF;font-family:Verdana;font-size:16px;line-height:18px;">Аэропорт - Псоу</span></td>
<td class="cell3"><span style="color:#000000;font-family:Arial;font-size:13px;line-height:18px;"> </span><span style="color:#FFFFFF;font-family:Verdana;font-size:16px;line-height:18px;">700</span></td>
</tr>
<tr>
<td class="cell4"><span style="color:#000000;font-family:Arial;font-size:13px;line-height:18px;"> </span><span style="color:#FFFFFF;font-family:Verdana;font-size:16px;line-height:18px;">Аэропорт - Красная поляна</span></td>
<td class="cell5"><span style="color:#000000;font-family:Arial;font-size:13px;line-height:18px;"> </span><span style="color:#FFFFFF;font-family:Verdana;font-size:16px;line-height:18px;">1300</span></td>
</tr>
<tr>
<td class="cell2"><span style="color:#000000;font-family:Arial;font-size:13px;line-height:18px;"> </span><span style="color:#FFFFFF;font-family:Verdana;font-size:16px;line-height:18px;">Аэропорт - Дагомыс</span></td>
<td class="cell3"><span style="color:#000000;font-family:Arial;font-size:13px;line-height:18px;"> </span><span style="color:#FFFFFF;font-family:Verdana;font-size:16px;line-height:18px;">1400</span></td>
</tr>
<tr>
<td class="cell2"><span style="color:#000000;font-family:Arial;font-size:13px;line-height:18px;"> </span><span style="color:#FFFFFF;font-family:Verdana;font-size:16px;line-height:18px;">Аэропорт - Лоо</span></td>
<td class="cell3"><span style="color:#000000;font-family:Arial;font-size:13px;line-height:18px;"> </span><span style="color:#FFFFFF;font-family:Verdana;font-size:16px;line-height:18px;">1500</span></td>
</tr>
<tr>
<td class="cell2"><span style="color:#FFFFFF;font-family:Verdana;font-size:16px;line-height:18px;"> Аэропорт - Лазаревское</span></td>
<td class="cell3"><span style="color:#FFFFFF;font-family:Verdana;font-size:16px;line-height:18px;">3000</span></td>
</tr>
<tr>
<td class="cell2"><span style="color:#FFFFFF;font-family:Verdana;font-size:16px;line-height:18px;"> Аэропорт - Туапсе</span></td>
<td class="cell3"><span style="color:#FFFFFF;font-family:Verdana;font-size:16px;line-height:18px;">4500</span></td>
</tr>
<tr>
<td class="cell2"><span style="color:#FFFFFF;font-family:Verdana;font-size:16px;line-height:18px;"> Аэропорт - Джубга</span></td>
<td class="cell3"><span style="color:#FFFFFF;font-family:Verdana;font-size:16px;line-height:18px;">6000</span></td>
</tr>
<tr>
<td class="cell2"><span style="color:#FFFFFF;font-family:Verdana;font-size:16px;line-height:18px;"> Аэропорт - Краснодар</span></td>
<td class="cell3"><span style="color:#FFFFFF;font-family:Verdana;font-size:16px;line-height:18px;">9500</span></td>
</tr>
</table>
<div id="wb_indexText4" style="position:absolute;left:454px;top:339px;width:467px;height:18px;text-align:center;">
<h2>Детское удерживающее устройство</h2></div>
</div>
</div>
<div id="indexLayer1" style="position:absolute;text-align:center;left:1%;top:722px;width:944px;height:356px;">
<div id="indexLayer1_Container" style="width:944px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
<div id="wb_indexText1" style="position:absolute;left:91px;top:27px;width:287px;height:42px;text-align:center;">
<h3>О нашем Такси</h3></div>
<div id="wb_index_info1" style="position:absolute;left:7px;top:69px;width:454px;height:224px;text-align:justify;" class="Heading 4 <h4>">
<span class="text">Служба такси Катран - это профессионалы с многолетним опытом работы в области транспорта и предоставления услуг качественного трансфера в Сочи и Адлере.<br><br>В парке компании только новые автомобили марки KIA, Skoda, Volkswagen, Ford оборудованные кондиционерами и детскими удерживающими устройствами<br><br>Заказывая такси в нашей службе мы гарантируем: <br>- подачу автомобиля в указанное время<br>- обслуживание вежливыми и профессиональными водителями<br>- помощь с багажом<br>- составление максимально удобного маршрута движения такси с учетом транспортной обстановки в городе Сочи</span></div>
<div id="wb_indexText2" style="position:absolute;left:567px;top:27px;width:289px;height:42px;text-align:center;">
<h3>Услуги такси</h3></div>
<hr id="index_Line1" style="position:absolute;left:0px;top:7px;width:944px;height:7px;">
<div id="wb_index_info2" style="position:absolute;left:485px;top:69px;width:453px;height:208px;text-align:justify;" class="Heading 4 <h4>">
<span class="text">Такси Катран предоставляет услуги трансфера по городу Сочи, Сочинскому и Адлерскому району, в <a href="./AIR.html" class="style2">аэропорт Сочи</a>, железнодорожный вокзал, Красную поляну. Аренда автомобиля.<br><br>Дешево заказать </span><span style="color:#FFFFFF;font-family:Verdana;font-size:13px;"><strong>такси&nbsp; в Сочи</strong></span><span class="text"> можно круглосуточно, позвонив операторам по&nbsp; телефону +7(8963) 164-49-59 либо<br>+7(918) 607-18-40 или подать заявку <a href="./index.php" class="style1">онлайн</a> и мы перезвоним Вам.<br><br>На сайте можно оформить <a href="./zakaz.php" class="style2">заказ такси онлайн</a>, заказать машину с водителем от эконом до представительского класса, арендовать микроавтобусы для поездок по Сочи и краю.<br></span></div>
</div>
</div>
<div id="indexLayer2" style="position:absolute;text-align:center;left:1%;top:1066px;width:944px;height:353px;">
<div id="indexLayer2_Container" style="width:944px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
<div id="wb_indexText3" style="position:absolute;left:0px;top:23px;width:930px;height:272px;text-align:left;">
<span class="text">Доступная цена поездок. Куда бы ни пришлось ехать нашему клиенту, Сочи,&nbsp; на вокзал, в&nbsp; аэропорт, Красную поляну - заказ такси предполагает прозрачный расчет стоимости поездки. Ездить с нами удобно и дешево.<br><br>Безупречный сервис. Такси Катран в Сочи работает по стандартам, которые не уступают мировым. Автомобильный парк включает только новые иномарки. Опытные и вежливые водители такси, внимательные и предупредительные диспетчеры - ваш комфорт для нас на первом месте.<br><br>Встреча в аэропорту. Заказ </span><span style="color:#FFFFFF;font-family:Verdana;font-size:13px;"><strong>такси в аэропорт</strong></span><span class="text"> Сочи больше не является проблемой. Такси будет подано точно ко времени, оговоренному заранее. Больше не нужно искать такси в аэропорту Сочи и беспокоится о ценах. Такси Катран всегда приезжают на место без опозданий.<br><br>Доброжелательный и понятливый персонал. Диспетчеры превосходно ориентируются в любом районе Сочи и Адлера. Вам нужно лишь указать название гостиницы при заказе такси. С нами интересно. Наши сотрудники отлично знают историю города Сочи, все достопримечательности и информацию о мероприятиях. Если будет интересно вы узнаете много полезной информации и вам помогут с выбором экскурсий. Бесплатное ожидание такси при задержке рейса. Не стоит переживать если рейс задержали. Если вы сделали заказ такси в нашей фирме мы даем гарантию что дождемся и это будет бесплатно. Оперативное обслуживание клиентов.</span></div>
<hr id="indexLine1" style="position:absolute;left:0px;top:1px;width:944px;height:7px;">
</div>
</div>
<div id="indexLayer4" style="position:absolute;text-align:center;left:1%;top:1424px;width:944px;height:79px;">
<div id="indexLayer4_Container" style="width:944px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
<div id="Layer2" style="position:absolute;text-align:left;left:844px;top:41px;width:88px;height:30px;" <!-- Yandex.Metrika informer -->
<a href="https://metrika.yandex.ru/stat/?id=26687898&amp;from=informer"
target="_blank" rel="nofollow"><img src="//bs.yandex.ru/informer/26687898/3_1_FFFFFFFF_EFEFEFFF_0_pageviews"
style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:26687898,lang:'ru'});return false}catch(e){}"/></a>
<!-- /Yandex.Metrika informer -->

<!-- Yandex.Metrika counter -->
<script>
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter26687898 = new Ya.Metrika({id:26687898,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/26687898" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</div>
<div id="RollOver2" style="position:absolute;left:752px;top:6px;overflow:hidden;width:88px;height:31px">
<a href="http://katalog-sochi.ru/cncat_from.php?6946">
<img class="hover" alt="" src="images/8831-sochi.png">
<span><img alt="" src="images/8831-sochi.png"></span>
</a>
</div>
<div id="RollOver1" style="position:absolute;left:844px;top:6px;overflow:hidden;width:88px;height:31px">
<a href="http://katran-sochi.sitesochi.ru">
<img class="hover" alt="" src="images/button.gif">
<span><img alt="" src="images/button.gif"></span>
</a>
</div>
<div id="indexLayer3" style="position:absolute;text-align:left;left:9px;top:7px;width:88px;height:30px;" <!-- begin of Top100 code -->

<script id="top100Counter" src="http://counter.rambler.ru/top100.jcn?3110660"></script>
<noscript>
<a href="http://top100.rambler.ru/navi/3110660/">
<img src="http://counter.rambler.ru/top100.cnt?3110660" alt="Rambler's Top100" border="0" />
</a>

</noscript>
<!-- end of Top100 code -->
</div>
</div>
</div>
</div>
</body>
</html>