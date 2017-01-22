<?php
require 'phpmailerautoload.php';
function ValidateEmail($email)
{
   $pattern = '/^([0-9a-z]([-.\w]*[0-9a-z])*@(([0-9a-z])+([-\w]*[0-9a-z])*\.)+[a-z]{2,6})$/i';
   return preg_match($pattern, $email);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['formid'] == 'form1')
{
   $mailto = 'zakaz@katran-sochi.com';
   $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
   $mailcc = 'katran-sochi@mail.ru';
   $mailbcc = 'kozin.alex@gmail.com';
   $subject = 'Заказ такси';
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
<title>Заказать такси в Сочи</title>
<meta name="description" content="Заказать такси онлайн">
<meta name="keywords" content="Заказать такси  в Сочи, такси сочи, цены на такси сочи. ">
<link href="taxi.ico" rel="shortcut icon" type="image/x-icon">
<link href="2.css" rel="stylesheet">
<link href="zakaz.css" rel="stylesheet">
<script>
function ValidateZakaz(theForm)
{
   var regexp;
   if (theForm.Combobox3.selectedIndex < 0)
   {
      alert("Please select one of the \"Час\" options.");
      theForm.Combobox3.focus();
      return false;
   }
   if (theForm.Combobox3.selectedIndex == 0)
   {
      alert("The first \"Час\" option is not a valid selection.  Please choose one of the other options.");
      theForm.Combobox3.focus();
      return false;
   }
   return true;
}
</script>
</head>
<body>
<div id="zakaz_PageHeader1" style="position:absolute;overflow:hidden;text-align:left;left:0px;top:0px;width:100%;height:113px;z-index:-1;">
<div id="wb_tarif_Text13" style="position:absolute;left:211px;top:37px;width:186px;height:32px;text-align:center;z-index:0;">
<span style="color:#000000;font-family:Verdana;font-size:13px;"><strong>Заказать такси в Сочи<br>Такси в аэропорт</strong></span></div>
</div>
<div id="space"><br></div>
<div id="container">
<div id="wb_zakazMasterObjects1" style="position:absolute;left:0px;top:0px;width:969px;height:1507px;z-index:23;">
<div id="master_Layer2" style="position:absolute;text-align:center;left:7%;top:139px;width:816px;height:26px;z-index:3;">
<div id="master_Layer2_Container" style="width:816px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
</div>
</div>
<div id="wb_masterCssMenu1" style="position:absolute;left:76px;top:139px;width:809px;height:28px;text-align:center;z-index:4;">
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
<div id="wb_masterImage2" style="position:absolute;left:421px;top:-5px;width:128px;height:128px;z-index:5;">
<a href="./index.php"><img src="images/img0001.png" id="masterImage2" alt=""></a></div>
<div id="wb_masterkrasnaya_polyanaText4" style="position:absolute;left:630px;top:64px;width:204px;height:32px;text-align:center;z-index:6;">
<span style="color:#000000;font-family:Verdana;font-size:13px;">Заказать такси дешево <br>Тел: 8-963-164-59-49</span></div>
<div id="wb_masterText1" style="position:absolute;left:568px;top:14px;width:329px;height:38px;z-index:7;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;"> </span><span style="color:#000000;font-family:Verdana;font-size:32px;"><strong>Такси &quot;КАТРАН&quot;</strong></span></div>
<div id="wb_masterImage1" style="position:absolute;left:749px;top:2px;width:216px;height:111px;filter:alpha(opacity=20);opacity:0.20;z-index:8;">
<img src="images/img0002.png" id="masterImage1" alt="&#1079;&#1072;&#1082;&#1072;&#1079; &#1090;&#1072;&#1082;&#1089;&#1080; &#1074; &#1089;&#1086;&#1095;&#1080;, &#1074;&#1099;&#1079;&#1086;&#1074; &#1090;&#1072;&#1082;&#1089;&#1080;" title="&#1058;&#1072;&#1082;&#1089;&#1080; &quot;&#1050;&#1072;&#1090;&#1088;&#1072;&#1085;&quot;"></div>
<div id="wb_master_Image3" style="position:absolute;left:891px;top:4px;width:78px;height:109px;z-index:9;">
<img src="images/img0003.png" id="master_Image3" alt="&#1079;&#1072;&#1082;&#1072;&#1079; &#1090;&#1072;&#1082;&#1089;&#1080;, &#1076;&#1077;&#1096;&#1077;&#1074;&#1086;&#1077; &#1090;&#1072;&#1082;&#1080;&#1089;, &#1074;&#1089;&#1090;&#1088;&#1077;&#1090;&#1080;&#1090;&#1100; &#1074; &#1072;&#1101;&#1088;&#1086;&#1087;&#1086;&#1088;&#1090;&#1091;" title="&#1058;&#1072;&#1082;&#1089;&#1080; &quot;&#1050;&#1072;&#1090;&#1088;&#1072;&#1085;&quot; &#1057;&#1086;&#1095;&#1080;"></div>
<div id="wb_master_Image4" style="position:absolute;left:2px;top:2px;width:216px;height:111px;filter:alpha(opacity=20);opacity:0.20;z-index:10;">
<img src="images/img0004.png" id="master_Image4" alt="&#1079;&#1072;&#1082;&#1072;&#1079; &#1090;&#1072;&#1082;&#1089;&#1080; &#1074; &#1089;&#1086;&#1095;&#1080;, &#1074;&#1099;&#1079;&#1086;&#1074; &#1090;&#1072;&#1082;&#1089;&#1080;" title="&#1047;&#1072;&#1082;&#1072;&#1079;&#1072;&#1090;&#1100; &#1090;&#1072;&#1082;&#1089;&#1080; &#1074; &#1072;&#1101;&#1088;&#1086;&#1087;&#1086;&#1088;&#1090;"></div>
<div id="master_Layer1" style="position:absolute;text-align:center;left:0%;top:197px;width:965px;height:1308px;z-index:11;">
<div id="master_Layer1_Container" style="width:965px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
<div id="wb_master_Text12" style="position:absolute;left:226px;top:1254px;width:512px;height:54px;text-align:center;z-index:1;">
<span style="color:#FFFFFF;font-family:Arial;font-size:17px;">© 2014-2016 Такси &quot;Катран&quot;. Все права защищены<br> ИНН 231707975752 ОГРН 314236702900142 ОКПО 0159219183</span><span style="color:#000000;font-family:'Times New Roman';font-size:16px;"><br></span></div>
</div>
</div>
</div>
<div id="wb_Form1" style="position:absolute;left:247px;top:211px;width:500px;height:471px;z-index:24;">
<form name="Zakaz" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" accept-charset="UTF-8" id="Form1" onsubmit="return ValidateZakaz(this)">
<input type="hidden" name="formid" value="form1">
<input type="text" id="Editbox1" style="position:absolute;left:110px;top:164px;width:278px;height:33px;line-height:33px;z-index:12;" name="Введите Ваше имя" value="" title="&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1042;&#1072;&#1096;&#1077; &#1080;&#1084;&#1103;" placeholder="&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1042;&#1072;&#1096;&#1077; &#1080;&#1084;&#1103;">
<input type="text" id="Editbox2" style="position:absolute;left:110px;top:221px;width:278px;height:33px;line-height:33px;z-index:13;" name="Номер телефона" value="" title="&#1053;&#1086;&#1084;&#1077;&#1088; &#1090;&#1077;&#1083;&#1077;&#1092;&#1086;&#1085;&#1072;" placeholder="&#1053;&#1086;&#1084;&#1077;&#1088; &#1090;&#1077;&#1083;&#1077;&#1092;&#1086;&#1085;&#1072;">
<input type="text" id="Editbox3" style="position:absolute;left:111px;top:278px;width:277px;height:33px;line-height:33px;z-index:14;" name="Номер рейса" value="" title="&#1053;&#1086;&#1084;&#1077;&#1088; &#1088;&#1077;&#1081;&#1089;&#1072;" placeholder="&#1053;&#1086;&#1084;&#1077;&#1088; &#1088;&#1077;&#1081;&#1089;&#1072;">
<select name="День" size="1" id="Combobox1" style="position:absolute;left:209px;top:344px;width:57px;height:21px;z-index:15;" title="&#1044;&#1077;&#1085;&#1100;">
<option value="День">День</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="29">29</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="30">30</option>
<option value="31">31</option>
</select>
<select name="Месяц" size="1" id="Combobox2" style="position:absolute;left:113px;top:344px;width:84px;height:20px;z-index:16;" title="&#1052;&#1077;&#1089;&#1103;&#1094;">
<option value="Месяц">Месяц</option>
<option value="Январь">Январь</option>
<option value="Февраль">Февраль</option>
<option value="Март">Март</option>
<option value="Апрель">Апрель</option>
<option value="Май">Май</option>
<option value="Июнь">Июнь</option>
<option value="Июль">Июль</option>
<option value="Август">Август</option>
<option value="Сентябрь">Сентябрь</option>
<option value="Октябрь">Октябрь</option>
<option value="Ноябрь">Ноябрь</option>
<option value="Декабрь">Декабрь</option>
</select>
<select name="Час" size="1" id="Combobox3" style="position:absolute;left:276px;top:344px;width:51px;height:20px;z-index:17;" title="&#1063;&#1072;&#1089;">
<option selected value="Час">Час</option>
<option value="0">0</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
</select>
<select name="Мин" size="1" id="Combobox4" style="position:absolute;left:335px;top:344px;width:52px;height:21px;z-index:18;" title="&#1052;&#1080;&#1085;">
<option value="Мин">Мин</option>
<option value="00">00</option>
<option value="05">05</option>
<option value="10">10</option>
<option value="15">15</option>
<option value="20">20</option>
<option value="25">25</option>
<option value="30">30</option>
<option value="35">35</option>
<option value="40">40</option>
<option value="45">45</option>
<option value="50">50</option>
<option value="55">55</option>
</select>
<input type="submit" id="Button1" name="Заказать" value="Заказать" style="position:absolute;left:153px;top:401px;width:195px;height:31px;z-index:19;" title="&#1047;&#1072;&#1082;&#1072;&#1079;&#1072;&#1090;&#1100;">
<div id="wb_Text1" style="position:absolute;left:0px;top:110px;width:500px;height:36px;text-align:center;z-index:20;">
<span style="color:#FFFFFF;font-family:Verdana;font-size:16px;"> Введите данные и нажмите Заказать<br>Наши операторы перезвонят Вам в течении 10 минут</span></div>
<div id="wb_Text2" style="position:absolute;left:3px;top:40px;width:497px;height:42px;text-align:center;z-index:21;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong> </strong></span><span style="color:#FFD700;font-family:Verdana;font-size:35px;">On-Line Заказ такси</span></div>
</form>
</div>
</div>
</body>
</html>