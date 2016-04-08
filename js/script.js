    window.onload = function(){
        
        $('.filter select').change(function(){
            var avto = $('#filter_avto').attr('value');
            var local = $('#filter_local').attr('value');
            $.post( "../filter.php", {avto: avto, local: local},function(res){
                if(res != ''){
                    $('#filter_res').html(res);
                        $('.drivers_list_phone a').click(function(){
                            var id = this.id;
                            id = id.slice(8);
                            $.post( "../viewphone.php", {id: id},function(res){
                            if(res != ''){
                                $('#n_phone_'+id).html(res);                           
                            }
                        }); 
                    });          
                }
            });
        });
        
        $('.drivers_list_phone a').click(function(){
            var id = this.id;
            id = id.slice(8);
            $.post( "../viewphone.php", {id: id},function(res){
                    if(res != ''){
                        $('#n_phone_'+id).html(res);                           
                    }
        }); 
     });
     
     $('.up_date_2').click(function(){
        event.preventDefault();
        var id = this.id;
        id = id.slice(10);
        $.post( "../updatetime_2.php", {id: id},function(res){
            if(res != ''){
                $('#up_date_2_'+id).html(res); 
                $('#up_date_2_'+id).removeClass('up_date_2');
                $('#up_date_2_'+id).addClass('dessel');                            
                $('#up_date_2_'+id).attr('id','');                        
            }
        });
    }); 
    
    $('.up_date_1').click(function(){
        event.preventDefault();
        var id = this.id;
        id = id.slice(10);
        $.post( "../updatetime_1.php", {id: id},function(res){
            if(res != ''){
                $('#up_date_1_'+id).html(res); 
                $('#up_date_1_'+id).removeClass('up_date_1');
                $('#up_date_1_'+id).addClass('dessel');                            
                $('#up_date_1_'+id).attr('id','');                        
            }
        });
    });
    
    $('.del_avatar').click(function(){
        event.preventDefault();
        var id = this.id;
        id = id.slice(11);
        $.post( "../del_avatar.php", {id: id},function(res){
            if(res != ''){
                $('#res_del_avatar').html(res);                        
            }
        });    
    }); 
             
    }
    
    function reload_capcha(){
        $('#capcha').html('<img src="../capcha.php" class="img_capcha" onclick="reload_capcha()">');
    }
    function sub(){
        var text = '';
        var email  =  $('#form_email').attr('value');
        var pass1  =  $('#form_pass1').attr('value');
        var pass2  =  $('#form_pass2').attr('value');
        var fio    =  $('#form_name').attr('value');
        var phone  =  $('#form_phone').attr('value');
        var avto   =  $('#form_avto').attr('value');
        var local  =  $('#form_local').attr('value');
        var capcha =  $('#form_capcha').attr('value');
        var email_valid = /^[\w]{1}[\w-\.]*@[\w-]+\.[a-z]{2,4}$/;
        var pass_valid = /^[a-zA-Z0-9]{4,100}$/;
        var phone_valid = /^[+78]{1}[0-9-()\s]{7,18}$/;
        var capcha_valid = /^[a-zA-Z0-9]{4}$/i;
        if(email !== '' && email !== ' '){
            if(email_valid.test(email)){
                if(pass1 !== '' && pass1 !== ' '){
                    if(pass_valid.test(pass1)){
                        if(pass2 !== '' && pass2 !== ' '){
                            if(pass_valid.test(pass2)){
                                if(pass1 == pass2){
                                    if(fio !== '' && fio !== ' '){
                                        if(phone !== '' && phone !== ' '){
                                            if(phone_valid.test(phone)){
                                                if(avto != 0){
                                                    if(capcha_valid.test(capcha)){
                                                        if(local != 0){
                                                            return true;
                                                        }
                                                        else{
                                                            text = text + 'Выберите удобный для Вас район!<br>'
                                                            $('.select2').css({borderColor:'#ccc'});
                                                            $('#form_local').css({borderColor:'#D00F0F'});
                                                            $('#error_text').html(text);
                                                            return false;     
                                                        }
                                                    }
                                                    else{
                                                        text = text + 'Введите проверочный код с картинки!<br>'
                                                        $('.select2').css({borderColor:'#ccc'});
                                                        $('#form_capcha').css({borderColor:'#D00F0F'});
                                                        $('#error_text').html(text);
                                                        return false;     
                                                    }
                                                }
                                                else{
                                                    text = text + 'Выберите тип транспорта!<br>'
                                                    $('.select2').css({borderColor:'#ccc'});
                                                    $('#form_avto').css({borderColor:'#D00F0F'});
                                                    $('#error_text').html(text);
                                                    return false;     
                                                }
                                            }
                                            else{
                                                text = text + 'Неправильный формат номера телефона<br>'
                                                $('.select2').css({borderColor:'#ccc'});
                                                $('#form_phone').css({borderColor:'#D00F0F'});
                                                $('#error_text').html(text);
                                                return false;     
                                            }
                                        }
                                        else{
                                            text = text + 'Укажите номер телефона<br>'
                                            $('.select2').css({borderColor:'#ccc'});
                                            $('#form_phone').css({borderColor:'#D00F0F'});
                                            $('#error_text').html(text);
                                            return false;   
                                        }
                                    }
                                    else{
                                        text = text + 'Укажите Имя Фамилию и Отчество<br>'
                                        $('.select2').css({borderColor:'#ccc'});
                                        $('#form_name').css({borderColor:'#D00F0F'});
                                        $('#error_text').html(text);
                                        return false;     
                                    }
                                }
                                else{
                                    text = text + 'Пароли не совпадают!<br>'
                                    $('.select2').css({borderColor:'#ccc'});
                                    $('#form_pass2').css({borderColor:'#D00F0F'});
                                    $('#form_pass1').css({borderColor:'#D00F0F'});
                                    $('#error_text').html(text);
                                    return false;     
                                }
                            }
                            else{
                                text = text + 'Поле Повторный пароль заполнено неправильно! Латинские символы и цыфры, минимльное количество - 4 символа<br>'
                                $('.select2').css({borderColor:'#ccc'});
                                $('#form_pass2').css({borderColor:'#D00F0F'});
                                $('#error_text').html(text);
                                return false;    
                            }
                        }
                        else{
                            text = text + 'Заполните второе поле Пароль<br>'
                            $('.select2').css({borderColor:'#ccc'});
                            $('#form_pass2').css({borderColor:'#D00F0F'});
                            $('#error_text').html(text);
                            return false;     
                        } 
                    }
                    else{
                        text = text + 'Поле Пароль заполнено неправильно! Латинские символы и цыфры, минимльное количество - 4 символа<br>'
                        $('.select2').css({borderColor:'#ccc'});
                        $('#form_pass1').css({borderColor:'#D00F0F'});
                        $('#error_text').html(text);
                        return false;     
                    }   
                }
                else{
                    text = text + 'Заполните поле Пароль<br>'
                    $('.select2').css({borderColor:'#ccc'});
                    $('#form_pass1').css({borderColor:'#D00F0F'});
                    $('#error_text').html(text);
                    return false;     
                }                    
            }
            else{
                text = text + 'Поле E-mail заполнено неправильно!<br>'
                $('.select2').css({borderColor:'#ccc'});
                $('#form_email').css({borderColor:'#D00F0F'});
                $('#error_text').html(text);
                return false;    
            }
        }
        else{
            text = text + 'Заполните поле E-mail<br>'
            $('.select2').css({borderColor:'#ccc'});
            $('#form_email').css({borderColor:'#D00F0F'});
            $('#error_text').html(text);
            return false;
        }
    } 
    
   