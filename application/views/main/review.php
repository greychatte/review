<div class="container">
    <div class="row">
        <div class="col s6 push-s3">
            <form id="reviewform">
                <div class="row">
                    <div class="col s6">
                        <ul>
                            <li class="input-field name">
                                <input type="text" class="browser-default" placeholder="<?php echo $txt_user; ?>" name="name" value="" required>
                            </li>
                            <li class="input-field phone">
                                <input type="phone" class="browser-default" placeholder="<?php echo $txt_userphone; ?>" name="phone" value="" required>
                            </li>
                            <li class="input-field email">
                                <input type="email" class="browser-default" placeholder="<?php echo $txt_useremail; ?>" name="email" value="" required>
                            </li>
                        </ul>
                    </div>
                    <div class="col s6">
                        <div class="input-field question">
                           <textarea name="question" class="browser-default" placeholder="<?php echo $txt_userquestion; ?>" required></textarea>
                        </div>
                    </div>
                    <div class="col s12">
                        <button type="submit" name="submit" value="ok" class="btn btn-primary"><?php echo $txt_send; ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>

    $('#reviewform button').on('click', function(event){
        event.preventDefault();

        var elements = $('#reviewform .input-field ').length;

        $('#reviewform input').each(function () { 
            var nameinp = $(this).attr('name');
            $('.' + nameinp).removeClass('ok');
            $('.' + nameinp + ' div.msg').remove();
            if ($(this).val().length > 0) {
                if (nameinp == 'name') {
                    if($(this).val().length >= 2 && $(this).val().length <= 96){
                        var msg = '';
                        $('.' + nameinp).addClass('ok');
                    }else{
                        var msg = 'Поле должно содержать от 2 до 96 символов'; 
                    }
                }

                if (nameinp == 'email') {
                    var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
                    if (pattern.test($(this).val())) {
                        var msg = '';
                        $('.' + nameinp).addClass('ok');
                    }else{
                        var msg = 'Правильно заполните адрес Email'; 
                    }
                }

                if (nameinp == 'phone'){
                    $('.' + nameinp).addClass('ok');
                }
            }else{
                var msg = 'Поле не может быть пустым';
            }
            if (msg) {
                $('.' + nameinp).append('<div class="error msg" style="color: red;">'+ msg +'</div>');
            }
        });

        $('input,textarea').focusin(function() {
            console.log(this);
            var row = $(this).parent();
            console.log(row);
            $(row).find('.msg').remove();
        });


        if($('#reviewform textarea').length > 0){
            var nameta = $('#reviewform textarea').attr('name');
            $('.' + nameta + ' div.msg').remove();
            $('.' + nameta).removeClass('ok');
            if($('#reviewform textarea').val().length > 0){
                var msg = '';
                $('.' + nameta).addClass('ok');
            }else{
                $('.' + nameta).append('<div class="error msg" style="color: red;">Поле не может быть пустым</div>');
            }
        }

        var valid = $('#reviewform .ok').length;
        if (valid == elements) {
            $.ajax({
                url: window.location.protocol + "//" + window.location.hostname + window.location.pathname,
                method: "POST",
                data: $('#reviewform').serialize(),    
                success: function (data) {
                    $("input, textarea").val('');

                    json = jQuery.parseJSON(data);
                    if (json.status == 'error') {
                        $('.push-s3').append('<div class="error msg" style="color: red;">'+ json.message +'</div>');
                    }else{
                        $('.push-s3').append('<div class="success msg" style="color: green;">'+ json.message +'</div>');
                    }
                    setTimeout(function(){
                        $('.push-s3 .msg').remove();
                    }, 2000);
                }
            });
        }
     });
</script>