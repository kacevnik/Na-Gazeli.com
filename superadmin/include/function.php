<?php
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
?>