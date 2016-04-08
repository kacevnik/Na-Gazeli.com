<?php
    include("include/db.php");

    if (isset($_POST['avto']))      {$avto = $_POST['avto'];       $avto = abs((int)$avto);}
    if (isset($_POST['local']))     {$local = $_POST['local'];    $local = abs((int)$local);}
    
    $resDrive = selDriver(time(), $avto, $local);
    
    if($resDrive){
        $avtoList = selAvto();
        $localList = selLocation();
?>
                        <span class="filter_count" title="Всего анкет"><?php echo $resDrive[0]; ?></span>
                            <ul class="drivers_list">
    <?php $count = 0; foreach($resDrive as $itenDriver){ $count++; if($count == 1){continue;} ?>
                                <li>
                                    <img src="avatar/<?php if($itenDriver["avatar"] == ""){ ?>gazel_ico.png<?php }else{ echo $itenDriver["avatar"]; } ?>" title="" width="78" height="78"/>
                                    <div class="drivers_list_content">
                                        <div class="drivers_list_name"><?php echo $itenDriver["name"]; ?></div>
                                        <div class="drivers_list_loc"><?php echo $avtoList[$itenDriver["avto"]]; ?>. <?php echo $localList[$itenDriver["raion"]]; ?></div>
                                        <div class="drivers_list_dis"><?php echo $itenDriver["dis"]; ?></div>
                                    </div>
                                    <div class="drivers_list_phone" id="n_phone_<?php echo $itenDriver["id"]; ?>"><a title="Показать номер" id="a_phone_<?php echo $itenDriver["id"]; ?>"><?php echo substr($itenDriver["phone"], 0, 8); ?> XXX-XX-XX</a></div>
                                </li>
    <?php } ?>                            
                            </ul>
<?php
    }
    else{
?>
            <div class="error_plus">Результаты сортировки отсутствуют</div>
<?php
    }
?>