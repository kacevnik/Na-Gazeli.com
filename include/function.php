<?php

    function mainSET(){
        global $db;
        $array = array();
        $sql = "SELECT * FROM art_set WHERE id='1'";
        $res = mysql_query($sql,$db);
        if(mysql_num_rows($res)){
            $myr = mysql_fetch_assoc($res);
            do{
                $array[] = $myr;        
            }
            while($myr = mysql_fetch_assoc($res));
            return $array; 
        }
        else{return false;}
    }
    
//------------------------------------------------------------------------
//Преобразование даты для статей
    function dateArticle($param){
        $arr = array('01'=>'ЯНВ','02'=>'ФЕВ','03'=>'МАР','04'=>'АПР','05'=>'МАЙ','06'=>'ИЮН','07'=>'ИЮЛ','08'=>'АВГ','09'=>'СЕН','10'=>'ОКТ','11'=>'НОЯ','12'=>'ДЕК');
        return $param = $arr[substr($param, 0, 2)];
    }

//------------------------------------------------------------------------
//Выборка из базы данных статьи

    function articleData($al){
        global $db;
        $array = array();        
        $sql = "SELECT name,date,m_keys,m_desc,text,title,alias FROM articles WHERE alias='$al' AND pokaz='1'";
        $res = mysql_query($sql,$db);
        if(mysql_num_rows($res)){
            $myr = mysql_fetch_assoc($res);
            do{
                $array[] = $myr;        
            }
            while($myr = mysql_fetch_assoc($res));
            return $array; 
        }
        else{return false;}
    }
    
//------------------------------------------------------------------------
//Выборка из БД списка статей согласно количества отображения в категории

    function selNovoStr($page,$count){
        global $db;
        $arr = array();
        $sql = "SELECT id FROM articles WHERE pokaz='1'";
        $res = mysql_query($sql, $db);
        if(mysql_num_rows($res) > 0){
            $countNovo = mysql_num_rows($res);
            $total = intval((($countNovo - 1) / $count) + 1);
            if(empty($page) or $page < 0) $page = 1;
            if($page > $total) $page = $total;
            $start = $page * $count - $count;
            $sql = "SELECT name,description,alias,date FROM articles WHERE pokaz='1' ORDER BY id DESC LIMIT $start, $count";
            $res = mysql_query($sql, $db);
            if(mysql_num_rows($res) > 0){
                $myr = mysql_fetch_assoc($res);
                do{
                   $arr[] = $myr; 
                }
                while($myr = mysql_fetch_assoc($res));
                return $arr;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }

function data_one($simple,$param2){
    
    $dataSozdaniyCislo = substr($simple, 8, 2);
    $dataSozdaniyMesyc = substr($simple, 5, 2);
    $dataSozdaniyGod   = substr($simple, 0, 4);
    
    if($dataSozdaniyMesyc == "01"){$dataSozdaniyMesyc = "янв";}
    if($dataSozdaniyMesyc == "02"){$dataSozdaniyMesyc = "фев";}
    if($dataSozdaniyMesyc == "03"){$dataSozdaniyMesyc = "мар";}
    if($dataSozdaniyMesyc == "04"){$dataSozdaniyMesyc = "апр";}
    if($dataSozdaniyMesyc == "05"){$dataSozdaniyMesyc = "мая";}
    if($dataSozdaniyMesyc == "06"){$dataSozdaniyMesyc = "июн";}
    if($dataSozdaniyMesyc == "07"){$dataSozdaniyMesyc = "июл";}
    if($dataSozdaniyMesyc == "08"){$dataSozdaniyMesyc = "авг";}
    if($dataSozdaniyMesyc == "09"){$dataSozdaniyMesyc = "сен";}
    if($dataSozdaniyMesyc == "10"){$dataSozdaniyMesyc = "окт";}
    if($dataSozdaniyMesyc == "11"){$dataSozdaniyMesyc = "ноя";}
    if($dataSozdaniyMesyc == "12"){$dataSozdaniyMesyc = "дек";}
    
     if($param2 == 1){
    echo $dataSozdaniyCislo." ".$dataSozdaniyMesyc." ".$dataSozdaniyGod;
    }
    if($param2 == 2){
        return $data = $dataSozdaniyCislo." ".$dataSozdaniyMesyc." ".$dataSozdaniyGod;
    }
}

//-----------------------------------------------------------------------------------------------------
//Новогодняя функция возвращает Новогоднюю шапку
    function happy_new_year(){
            $happy_new_year = array("1712","1812","1912","2012","2112","2212","2312","2412","2512","2612","2712","2812","2912","3012","3112","0101","0201","0301","0401","0501","0601","0701","0801","0901","1001","1101","1201","1301");
        
        $count = 0;
        foreach($happy_new_year as $item){
            if($item == date("dm")){
                echo "<div class=\"body3_santa\"></div>";
                break;    
            }
            else{
                $count++;
            }
        }
        if($count == count($happy_new_year)){
            echo "<div class=\"body3\"></div>";
        }
    } 
//-----------------------------------------------------------------------------------------------------
//Выборка водителей из базы для создания основного списка водителей   
    function selDriver($time, $avto, $local){
        global $db;
        $arr = array();
        if($avto == 0 and $local == 0){
            $sql = "SELECT id,avto,raion,name,phone,dis,avatar FROM voditel WHERE pokaz='1' AND up_date_2>'$time' ORDER BY up_date DESC";    
        }
        elseif($avto == 0 and $local != 0){
            $sql = "SELECT id,avto,raion,name,phone,dis,avatar FROM voditel WHERE pokaz='1' AND up_date_2>'$time' AND raion='$local' ORDER BY up_date DESC";
        }
        elseif($avto != 0 and $local == 0){
            $sql = "SELECT id,avto,raion,name,phone,dis,avatar FROM voditel WHERE pokaz='1' AND up_date_2>'$time' AND avto='$avto' ORDER BY up_date DESC";
        }
        elseif($avto != 0 and $local != 0){
            $sql = "SELECT id,avto,raion,name,phone,dis,avatar FROM voditel WHERE pokaz='1' AND up_date_2>'$time' AND avto='$avto' AND raion='$local' ORDER BY up_date DESC";
        }
        
        $res = mysql_query($sql, $db);
        if(mysql_num_rows($res) > 0){
            $count = mysql_num_rows($res);
            $myr = mysql_fetch_assoc($res);
                $arr[] = $count;
            do{
               $arr[] = $myr; 
            }
            while($myr = mysql_fetch_assoc($res));
            return $arr;
        }
        else{
            return false;
        }
    }
    
//-----------------------------------------------------------------------------------------------------
//Выборка водителей из базы для создания основного списка водителей   
    function selTotalDriver(){
        global $db;
        $arr = array();
        $sql = "SELECT id FROM voditel";
        $res = mysql_query($sql, $db);
        if(mysql_num_rows($res) > 0){
            $myr = mysql_fetch_assoc($res);
            do{
               $arr[] = $myr; 
            }
            while($myr = mysql_fetch_assoc($res));
            return $arr;
        }
        else{
            return false;
        }
    }
//------------------------------------------------------------------------
//Выборка из БД списка автомобилей

    function selAvto(){
        global $db;
        $arr = array();
        $sql = "SELECT id,vid FROM avto ORDER BY nomer";
        $res = mysql_query($sql, $db);
        if(mysql_num_rows($res) > 0){
            $myr = mysql_fetch_assoc($res);
            do{
               $arr[$myr["id"]] = $myr["vid"]; 
            }
            while($myr = mysql_fetch_assoc($res));
            return $arr;
        }
        else{
            return false;
        }
    } 
    
//------------------------------------------------------------------------
//Выборка из БД списка автомобилей

    function selLocation(){
        global $db;
        $arr = array();
        $sql = "SELECT id,name FROM raion";
        $res = mysql_query($sql, $db);
        if(mysql_num_rows($res) > 0){
            $myr = mysql_fetch_assoc($res);
            do{
               $arr[$myr["id"]] = $myr["name"]; 
            }
            while($myr = mysql_fetch_assoc($res));
            return $arr;
        }
        else{
            return false;
        }
    } 
//------------------------------------------------------------------------
//Обработка телефонного номера в вид 8 (926) 866-00-00
    function upPhone($phone){
        $str = strlen($phone);
        if($str <= 11){
            $znak1 = substr($phone, 0, 1);
            $znak1 = str_replace("7","8", $znak1);
            if($znak1 == 8){
                $znak2 = substr($phone, 1, 3);
                $znak3 = substr($phone, 4, 3);
                $znak4 = substr($phone, 7, 2);
                $znak5 = substr($phone, 9, 2);
                $itog = $znak1." (".$znak2.") ".$znak3."-".$znak4."-".$znak5;
                $phone = $itog;
                return $phone;
            }
        }
    } 
//-----------------------------------------------------------------------------------------------------
//Выборка данных определенной анкеты водителя по сессии админа   
    function selAnketaLK($admin){
        global $db;
        $pass = substr($admin, 0, 32);
        $kod  = substr($admin, 32, 32);
        $arr = array();
        $sql = "SELECT id,avto,raion,name,phone,dis,pokaz,up_date,up_date_2,avatar FROM voditel WHERE kod='$kod' AND pass='$pass'";
        $res = mysql_query($sql, $db);
        if(mysql_num_rows($res) > 0){
            return $myr = mysql_fetch_assoc($res);
        }
        else{
            return false;
        }
    }
//-----------------------------------------------------------------------------------------------------
//Функция расчета через какое время

function afterIn($utime){
    if((($utime - time())/86400) > 1){
        $time_0 =  floor(($utime - time())/86400);
        $time_1 = floor((($utime - time())%86400)/3600);
        $time_2 = floor(((($utime - time())%86400)%3600)/60);
        if($time_1!=0){$time_1 = $time_1."ч. ";if($time_2!=0){$time_2 = $time_2."мин.";}else{$time_2 = '';}}else{$time_1 = '';if($time_2!=0){$time_2 = $time_2."мин.";}else{$time_2 = '1мин.';}}
        return $time_0."дн. ".$time_1.$time_2;    
    }
    else{
        $time_1 = floor(($utime - time())/3600);
        $time_2 = floor((($utime - time())%3600)/60);
        if($time_1!=0){$time_1 = $time_1."ч. ";if($time_2!=0){$time_2 = $time_2."мин.";}else{$time_2 = '';}}else{$time_1 = '';if($time_2!=0){$time_2 = $time_2."мин.";}else{$time_2 = '1мин.';}}  
        return  $time_1.$time_2;         
    }
} 
//-----------------------------------------------------------------------------------------------------
//Функция отправки письма в просьбой продления показов анкеты

    function errorMail($count){
        global $db;
        $time = time();
        $n = "";
        $sql = "SELECT id,name,email,error_message,pokaz,count_mail FROM voditel WHERE time_message<'$time' AND metka='1' AND email!='$n' LIMIT ".$count;
        $res = mysql_query($sql, $db);
        if(mysql_num_rows($res) > 0){
            $myr = mysql_fetch_assoc($res);
            do{
                $name = $myr["name"];    
                $pokaz = $myr["pokaz"];
                $count = $myr["count_mail"];    
                $error_message = $myr["error_message"];    
                $email = $myr["email"];
                $id = $myr["id"];
                $timeMessage = time() + 86400 * $count;
                $count++;
                $up = mysql_query("UPDATE voditel SET time_message='$timeMessage',count_mail='$count' WHERE id='$id'", $db);
                if($error_message == "" and $pokaz == 1){
                    $subject = "Внимание! обновите свою анкету.";
                    $header = "From: \"Na-Gazeli.com\" <admin@na-gazeli.com>";
                    $message = "<p>Здравствуйте Уважаемый ".$name.".</p><p>Ваша анкета, размещенная на сайте Na-Gazeli.com, перестала показываться в общем списке. Для возобновления показов, Вам следует пройти в Ваш личный кабинет по ссылке внизу этого письма, и обновить свою анкету. После обновления, анкета станет доступной для просмотра потенциальными клиентами в течение следующих трех дней. После чего к Вам на почту снова придет такое же письмо.</p><p><a href='http://na-gazeli.com/login.php'>Личный кабинет</a></p><p>Данное письмо сгенерировано автоматически. Отвечать на него не надо.<br>Спасибо.</p><p>С Уважением администрация сайта.</p>";
                    mail($email,$subject,$message,$header."\r\nContent-type:text/html;Charset=utf-8\r\n");
                }
                else if($error_message != "" and $pokaz == 0){
                    $subject = "Внимание ошибка!";
                    $header = "From: \"Na-Gazeli.com\" <admin@na-gazeli.com>";
                    $message = "<h2 style='text-align: center'>Внимание!</h2><p>Уважаемый <b>".$name."</b></p><p>Ваша анкета не прошла проверку из-за ошибки.</p><p>Для ее исправления, Вам следует ".$error_message.".</p><p>Пожалуйста, не отвечайте на это сообщение, оно было сгенерировано автоматически и только для информации.<br>Спасибо.</p>";
                    mail($email,$subject,$message,$header."\r\nContent-type:text/html;Charset=utf-8\r\n");    
                }   
            }
            while($myr = mysql_fetch_assoc($res));
        }
    } 
//-----------------------------------------------------------------------------------------------------
//Функция преобразования всей строки в нижний регистр   
    function strtolower_ru($string){
        $a = array('А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ь','Ы','Ъ','Э','Ю','Я'); 
        $b = array('а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ','ь','ы','ъ','э','ю','я');
        return $res = str_replace($a, $b, strtolower($string));  
    }

//-----------------------------------------------------------------------------------------------------
//Функция преобразования первых букв каждого слова в верхний регистр     
    function ucwords_ru($string){
        $a=array(' а',' б',' в',' г',' д',' е',' ё',' ж',' з',' и',' й',' к',' л',' м',' н',' о',' п',' р',' с',' т',' у',' ф',' х',' ц',' ч',' ш',' щ',' ь',' ы',' ъ',' э',' ю',' я'); 
        $b=array(' А',' Б',' В',' Г',' Д',' Е',' Ё',' Ж',' З',' И',' Й',' К',' Л',' М',' Н',' О',' П',' Р',' С',' Т',' У',' Ф',' Х',' Ц',' Ч',' Ш',' Щ',' Ь',' Ы',' Ъ',' Э',' Ю',' Я');
        $res = " ".$string;
        return $res = trim(str_replace($a, $b, ucwords($res)));   
    }   
 //-----------------------------------------------------------------------------------------------------
//Функция отправки письма со статистикой 
    function mailStatistic(){
        global $db;
        $time = time();
        $res = mysql_query("SELECT count_update_time,count_new_user,count_delete_user,id,today FROM stat WHERE unix_post_mail < '$time' AND unix_post_mail != '1' LIMIT 1", $db);
        if(mysql_num_rows($res) > 0){
            $myr = mysql_fetch_assoc($res);
            $adminEmail = 'kacevnik@yandex.ru';
            $id = $myr["id"];
            $countUpdateTime = $myr["count_update_time"];
            $countDeleteUser = $myr["count_delete_user"];
            $countNewUser = $myr["count_new_user"];
            $today = $myr["today"];
            $header = "From: \"Na-Gazeli.com\" <admin@na-gazeli.com>";
            $subject = "Статистика Na-gazeli.com";
            $message = "<p>Ежeдневная статистика за прошедшие сутки: (".$today.")</p><p>Количество обновлений анкет: ".$countUpdateTime."<br>Количество новых пользователей: ".$countNewUser."<br>Количество удаленных анкет: ".$countDeleteUser."</p><p>Данное письмо сгенерировано автоматически. Отвечать на него не надо.<br>Спасибо.</p><p>С Уважением администрация сайта.</p>";
            if(mail($adminEmail,$subject,$message,$header."\r\nContent-type:text/html;Charset=utf-8\r\n")){
                $ins = mysql_query("UPDATE stat SET unix_post_mail='1' WHERE id='$id'",$db);
            }
        }
    }
?>