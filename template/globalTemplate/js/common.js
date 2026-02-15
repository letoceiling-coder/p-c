

$(document).ready(function () {

    $('#soundClick').click(function (){
        $(this).text('Выключить оплвещение')
        var audio = new Audio(); // Создаём новый элемент Audio
        audio.src = 'new_message_notice.mp3'; // Указываем путь к звуку "клика"
        audio.autoplay = true; // Автоматически запускаем
        soundClick()
    })
    function soundClick() {
var phoneId = $('#phoneId').val()
        $.ajax({
            type: "POST",
            url: "/",
            data: {soundClick :'go' },

            success: function (data) {
                console.log(data)
                if (data == phoneId){
                    var audio = new Audio(); // Создаём новый элемент Audio
                    audio.src = 'new_message_whatsa.mp3'; // Указываем путь к звуку "клика"
                    audio.autoplay = true; // Автоматически запускаем

                }
                soundClick()



            }
        });
    }
    $(".mmenu").click(function(){
        if (!$(".menu").hasClass('show'))
        {
            $(".menu").addClass('show');
        }
    });

    $(".m_close").click(function(){
        $(".menu").removeClass('show');
        return false;
    })
    function alignCenter(elem) {

        elem.css({
            left: ($(window).width() - elem.width()) / 2  + 'px',
            top: 0 + 'px'
        })
    }
    alignCenter($('#popup1'));
    alignCenter($('#popup12'));
    alignCenter($('.popup2'));
    alignCenter($('#spasibo'));
    alignCenter($('#gettown'));
    alignCenter($('#pozdr'));
    alignCenter($('#popupadmin'))
    setTimeout(function() {$('.popup2').show( 400 ); }, 3000);
    $( "#pop_tel_bo" ).focus(function() {
        $('.hidecookies').hide();
    });

    // pop_up_block();
    $("#btn-close,#btn-close1,#btn-close2").click(function(){

        $(this).parent().hide();
        $('.hide-layout').hide();
        $('#popup2').hide();

    })
    $("#callback-spasibo").click(function(){
        if($('#callback-spasibo').hasClass('closetaut')){
            $('.hide-layout').hide();
        }else{
          //  callback_tel()
        }

        $(this).parent().hide();
    })
    $("#gettown_yes").click(function(){
        var town = $('#town_msg').text()
        var path = document.location.pathname
        $.ajax({
            type: "POST",
            url: "/",
            data: {ajax_town :town },

            success: function (data) {
                window.location.href = data+path;

            }
        });
    })
    $("#gettown_not").click(function(){
        $('#gettown').hide();
        var path = document.location.pathname
        window.location.href = path + '#win2';



    })
    $('.select').on('click', '.select__head', function () {
        if ($(this).hasClass('open')) {
            $(this).removeClass('open');
            $(this).next().fadeOut();
        } else {
            $('.select__head').removeClass('open');
            $('.select__list').fadeOut();
            $(this).addClass('open');
            $(this).next().fadeIn();
        }
    });

    $('.select').on('click', '.select__item', function () {
        $('.select__head').removeClass('open');
        $(this).parent().fadeOut();
        $(this).parent().prev().text($(this).text());
        $(this).parent().prev().prev().val($(this).text());
    });

    $(document).click(function (e) {
        if (!$(e.target).closest('.select').length) {
            $('.select__head').removeClass('open');
            $('.select__list').fadeOut();
        }
    });


    $('#iconsload').click(function(){

        $.ajax({
            type: "POST",
            url: "/ajax.php",
            data: {iconsload :1 },

            success: function (data) {

                if(data == 1){
                    location.reload();
                }
            }
        });
    })

    $('.number').click(function(){
        $('.datas').css('color', 'black')
        var number = $(this).children('p').text();
        if(number == '?')number = 0;
        var namberTextInput = $('.textboxInput span').text()

        if(namberTextInput == '0'){
            $('.textboxInput span').text( number);

        }else{
            $('.textboxInput span').text(namberTextInput + number);
        }

        //alert(number);
    })
    $('.numberDelete').click(function(){
        var namberTextInput = $('.textboxInput span').text()

        if(namberTextInput.length == '1'){
            $('.textboxInput span').text('0')


        }else{
            $('.textboxInput span').text(namberTextInput.substring(0, namberTextInput.length - 1));
        }



    })

    $('#numberEnter').click(function(){
        var namberTextInput = $('.textboxInput span').text()
        if(namberTextInput > 2){
            $.ajax({
                type: "POST",
                url: "https://proffi-center.ru/serviceajax/numberEnter.php",
                data: {key :namberTextInput, id:'numberEnter' },

                success: function (data) {

                    // alert(data);
                    var result = eval(data);//result['key']
                    $('.panelwithButtons .numberEnter').remove()
                    $('.panelwithButtons ').append('<div class="numberEnter" id="numberEnterData"><p class="numButt">enter</p></div>')

                    var datas  = $('.datas').text(result['key']);
                    $('.datas').append('<span id="point1">' + result['value'][0]  + '</span>'+'<span id="point2">' + result['value'][1]  + '</span>');

                    $('.textboxInput span').text('0')
                }
            });
        }else{
            $('.datas').css('color', 'red')
        }

    })

    $("#object").keyup( function() {
        var vall = $(this).val()
        $.ajax({
            type: "POST",
            //dataType: 'json',
            url: "https://proffi-center.ru/serviceajax/numberEnter.php",
            data: {val :vall, id:'object' },

            success: function (data) {


                $('#counrylist').fadeIn()
                $('#counrylist').html(data)
            }
        });
    });
    $(document).on('click', '.searchli', function () {
        $('#object').val($(this).text())
        $('#counrylist').fadeOut()
        $('#object').get(0).focus();
    })
    $('#submit-street').click(function(){
        var street = $('#object').val()
        //alert(street)
        $.ajax({
            type: "POST",
            url: "https://proffi-center.ru/serviceajax/numberEnter.php",
            data: {key :street, id:'street' },

            success: function (data) {
                //console.log(data)
                if(data == true){
                    $('#pop-object').fadeOut()

                    $('.contener').removeAttr('id')

                }
            }
        });

    })
    $(document).on('click', '#numberEnterData', function () {
        var point1 = $('#point1').text()
        var point2 = $('#point2').text()
        var namberTextInput = $('.textboxInput span').text()
        var myheight = $(window).height(); // Высота экрана
        var mywidth = $(window).width(); // Ширина экрана
        $.ajax({
            type: "POST",
            url: "https://proffi-center.ru/serviceajax/point.php",
            data: {point1 :point1,point2 :point2, id:'point',namberTextInput:namberTextInput},

            success: function (data) {
                console.log(data);

                var str = data
                //alert(str);
                if(typeof data == "string"){
                    window.location = "https://proffi-center.ru/service/point"+str;
                }else{

                    var result = eval(data);//result['key']
                    var datas  = $('.datas').text(result['key']);
                    $('.datas').append('<span id="point1">' + result['value'][0]  + '</span>'+'<span id="point2">' + result['value'][1]  + '</span>');

                    $('.textboxInput span').text('0')
                }

            }
        });


    })
    $("#newdocument").click(function(){

        window.location.replace("https://proffi-center.ru/service/newdocument");
    })
    $("#btn-admin").click(function(){
        $.ajax({
            url:     'admin.php', //url страницы (action_ajax_form.php)
            type:     "POST", //метод отправки
            dataType: "html", //формат данных
            data: $("#ajax_form").serialize(),  // Сеарилизуем объект
            success: function(response) { //Данные отправлены успешно
                if(response == 1){
                    location.reload();

                }else{
                    $('#result_form').text('No access')
                }
            }
        });
    });

    $("#registr").click(function(){
        $.ajax({
            url:     'https://proffi-center.ru/registr.php', //url страницы (action_ajax_form.php)
            type:     "POST", //метод отправки
            dataType: "html", //формат данных
            data: $("#registr_form").serialize(),  // Сеарилизуем объект
            success: function(response) { //Данные отправлены успешно
                if(response == 1){

                    window.location.replace("https://proffi-center.ru/service/");

                }else{
                    //alert('no')
                    $('#result_form').text(response)
                }
            }
        });
    });

    $("#btn-autz").click(function(){
        $.ajax({
            url:     'https://proffi-center.ru/btn-autz.php', //url страницы (action_ajax_form.php)
            type:     "POST", //метод отправки
            dataType: "html", //формат данных
            data: $("#autz_form").serialize(),  // Сеарилизуем объект
            success: function(response) { //Данные отправлены успешно
                if(response == 1){
                    //alert(response)
                    location.reload();

                }else{
                    // alert('no')
                    $('#result_form').text(response)
                }
            }
        });
    });

    /**** mini calc *************/

    $('.mc_input_place input').keyup(function () {
        //  $(this).val(parseInt($(this).val()));
        if (parseInt($(this).val()) > 100) {
            $(this).val('100');
        }
        if (parseInt($(this).val() < 0)) {
            $(this).val('0');
        }


        $(".mc_price").html(mcCalc($(this).val()) + '<span> руб.</span>');
        $("#mc_slider-horizontal").slider({value: $(this).val()});
    });

    $(function () {


        $(".mc_price").html(mcCalc(10) + '<span> руб.</span>');

        $("#mc_slider-horizontal").slider({
            range: "min",
            min: 1,
            max: 100,
            step: 1,
            value: 10,
            slide: function (event, ui) {
                cc = ui.value;
                $(".mc_input_place input").val(cc);
                var res = mcCalc(cc);
                $(".mc_price").html(res + '<span> руб.</span>');
            }
        });
    });

    // $('.mc_price').draggable();

    function mcCalc(cc) {
        if (typeof type !== "undefined") {
            return cc * cena[type];
        } else {
            return cc;
        }
    }

    /*****************************************/

    var owl = $(".carousel_about");
    owl.owlCarousel({
        autoHeight:true,
        items: 1,
        loop: true,
        dots: true,
        nav: false,
        navText: ['', ''],
        responsive: {
            0: {
                items: 1
            },
            750: {
                items: 1
            },

        }

    });


    var owl = $(".carousel");
    owl.owlCarousel({
        //  items : 2,
        autoHeight:true,
        loop: true,
        dots: false,
        nav: true,
        navText: ['', ''],
        responsive: {
            0: {
                items: 1
            },
            750: {
                items: 2
            },


        }

    });
    var owl = $(".carousel-gallery");
    owl.owlCarousel({
        //  items : 2,
        autoHeight:true,
        loop: true,
        dots: false,
        navText: ['', ''],
        nav: true,

        responsive: {
            0: {
                items: 1
            },
            750: {
                items: 1
            },
            992: {
                items: 1
            },


        }

    });
    var owl = $(".carousel-gallery2");
    owl.owlCarousel({
        autoHeight:true,
        loop: true,
        dots: false,
        navText: [' ', ' '],
        nav: true,

        responsive: {
            0: {
                items: 1
            },
            750: {
                items: 3
            },
            992: {
                items: 4
            },


        }

    });
    var owl = $("#corusel_0");
    owl.owlCarousel({
        //  items : 2,
        autoHeight:true,
        loop: true,
        dots: false,
        nav: true,
        navText: ['&lArr;', '&rArr;'],
        responsive: {
            0: {
                items: 1
            },
            750: {
                items: 1
            },
            992: {
                items: 2
            },
            1024: {
                items: 3
            }

        }


    });
    var owl = $(".otz_carousel");
    owl.owlCarousel({
        //  items : 2,
        autoHeight:true,
        loop: true,
        dots: false,
        nav: true,
        navText: ['', ''],
        responsive: {
            0: {
                items: 1
            },
            750: {
                items: 1
            },
            992: {
                items: 1
            },


        }

    });

    /******************/


    // отправка форм

    $('#zakaz_5min').click(function () {
        var $form = $(this).closest('.zakaz_5min');
        var names = $form.find('.v_name').val();
        var tel = $form.find('.v_tel').val();
        var email = $form.find('.t_email').val();
        var txt = $form.find('.t_txt').val();
        var town = $('.moscow ').attr('data-town');
        var type = 'item_send';

        getAjax(names,tel,type,town,email,txt)
    });

    $('.superbutton').click(function () {

        var names = $('.pop_name1').val();
        var tel = $('.pop_tel1').val();
console.log(names +' '. tel);
        var town = $('.moscow ').attr('data-town');
        var type = 'ACCESS_DENIED';

        getAjax(names,tel,type,town)
    });

    function getAjax(names,tel,type = false,town,email = false,txt= false,art= false,id= false) {
        $('#popup1').hide();
        $('#hide-layout').show();
        $('.pre-loader').show();
        if (!type){
            type = 'callback'
        }
        
        $.ajax({
            type: "POST",
            url: "/",
            data: {name :names , tel:tel,type:type,town:town,success:'getAjax',email:email,art:art,id:id},
            complete: function (response) {



            },
            success: function (data) {
                $('#hide-layout').hide();
                $('.pre-loader').hide();
                if (data == true) {
                    $('.t_name').val('');
                    $('.t_tel').val('');
                    $('.t_email').val('');
                    $('.t_txt').val('');
                    $('#hide-layout').fadeIn(300);
                    $('#spasibo').fadeIn(300);
                    // if (type == 'item_send'){
                    //     $('.t_name').val('');
                    //
                    //     $('.t_tel').val('');
                    //     $('.t_email').val('');
                    //     $('.t_txt').val('');
                    //     $('#hide-layout').fadeIn(300);
                    //     $('#spasibo').fadeIn(300);
                    // }
                    // if (type == 'low'){
                    //     $('#low_tel').val('');
                    //     $('#hide-layout').fadeIn(300);
                    //     $('#spasibo').fadeIn(300);
                    // }
                    // if (type == 'call'){
                    //     $('#callback-spasibo').addClass('closetaut')
                    //     //alert ('Заявка успешно отправлена');
                    //     $('#popup1').fadeOut(300);
                    //     $('.pop_name').val('');
                    //     $('.pop_tel').val('');
                    //     $('#spasibo').fadeIn(300);
                    // }
                    // if (type == '5min'){
                    //     console.log(type)
                    //     $('#callback-spasibo').addClass('closetaut')
                    //     $('.v_name').val('');
                    //     $('.v_tel').val('');
                    //     $('#hide-layout').fadeIn(300);
                    //     $('#spasibo').fadeIn(300);
                    // }else {
                    //     console.log(type)
                    //     $('#hide-layout').fadeIn(300);
                    //     $('#spasibo').fadeIn(300);
                    // }


                }
                if (data == false) {
                        $('#p1_msg').text('Заполните поля')
                        $('#headers').text('Ошибка')
                        $('#popup1').fadeOut(300);
                        $('.pop_name').val('');
                        $('.pop_tel').val('');
                        $('#spasibo').fadeIn(300);
                }
            }
        });
    }
    $('#zakaz_rassr').click(function () {
        var name = $('.r_name').val();
        var tel = $('.r_tel').val();

        $.ajax({
            type: "POST",
            url: "/forms5min.php",
            data: {name :name , tel:tel,txt:txt},
            success: function (data) {
                if (data == 'ok') {

                    //  alert ('Заявка успешно отправлена');
                    $('.r_name').val('');
                    $('.r_tel').val('');
                    $('#hide-layout').fadeIn(300);
                    $('#spasibo').fadeIn(300);
                    SendComagic(name, tel, 'rassrochka', '');
                }
                if (data === 'no') {
                    $('#p1_msg').text('Заполните поля')
                    $('#headers').text('Ошибка')
                    $('#popup1').fadeOut(300);
                    $('.pop_name').val('');
                    $('.pop_tel').val('');
                    $('#spasibo').fadeIn(300);
                    SendComagic(name, tel, type, '');
                }
            }
        });


    });

    $('#callback-send1').click(function () {

        var names = $('.popup1 .pop_name').val();
        var tel = $('.popup1 .pop_tel').val();
        var type = $('.popup1 .pop_type').val();
        var town = $('.moscow ').attr('data-town');

        getAjax(names,tel,type,town)

    });


    $(document).on('click', '.took_advantage_of_the_offer', function () {
        var took_advantage_of_the_offer = $('#took_advantage_of_the_offer').val();
        $.ajax({
            type: "POST",
            url: "/noPrepaymentRequired.php",
            data: { service:took_advantage_of_the_offer},
            success: function (data) {
                console.log(data)
            }
        });
    })

    $(document).on('click', '#callback-sendfalse', function () {
        $('#popup2').empty();
        $('#popup2').append("<div class=\"header_sub\">Введите номер телефона</div>\n" +
            "\n" +
            "      <input type=\"hidden\" class=\"pop_type\" value=\"\">\n" +
            "\n" +
            "      <div class=\"razmetka1\">\n" +
            "          <div class=\"low_tel\">\n" +
            "              <input class=\"pop_tel\" type=\"text\" placeholder='Телефон' value=''  >\n" +
            "          </div>\n" +
            "      </div>\n" +
            "\n" +
            "\n" +
            "      <div class=\"blue_btn\">\n" +
            "          <a id=\"callback-send9\">Жду звонка</a>\n" +
            "      </div>");
        $(".pop_tel").inputmask("+7 (999) 999-99-99");

    });

    $('#pop_tel_bo').on('keyup input', function() {

        var tel = $('.popup2 .pop_tel').val();

        if(tel.match(/\_\b/i) == null && tel != '') {
            $('#callback-send9').parent().removeClass('grey_btn')
            $('#callback-send9').parent().addClass('blue_btn')
            $('#callback-send9').removeClass('disabled')

        }else {
            $('#callback-send9').parent().removeClass('blue_btn')
            $('#callback-send9').parent().addClass('grey_btn')
            $('#callback-send9').addClass('disabled')
        }
    })
    $(document).on('click', '#callback-send9', function () {

        var tel = $('.popup2 .pop_tel').val();

        $('#popup2').empty();

        $('#popup2').append("<div class=\"header \">Ваш номер</div><div style='font-weight: bold' class=\"header_sub\">"+tel+" </div><div class=\"blue_btn\">\n" +
            "          <a id=\"callback-send10\">Да</a>\n" +
            "      </div><div class=\"red_btn\">\n" +
            "          <a id=\"callback-sendfalse\">Нет</a>\n" +
            "      </div>");
        $(".pop_tel").inputmask("+7 (999) 999-99-99");
        return false;
    })
    $(document).on('click', '#callback-send10', function () {

        var took_advantage_of_the_offer = $('#took_advantage_of_the_offer').val();
        var tel = $('.popup2 .header_sub').text();
        var town = $('.moscow ').attr('data-town');


        getAjax('cookies',tel,'cookies',town)
        $('#popup2').hide()
    });

    $('#low_sand').click(function (e) {
        e.preventDefault();
        var names = 'По низкой цене';
        var tel = $('#low_tel').val();
        var type = 'low';
        var town = $('.moscow ').attr('data-town');
        getAjax(names,tel,type,town)
    });

    $('#tovar_zakaz').click(function () {
        var names = $('.t_name').val();
        var tel = $('.t_tel').val();
        var email = $('.t_email').val();
        var txt = $('.t_txt').val();
        var art = $('.t_art').val();
        var id = $('.t_id').val();
        var type = 'item_send';
        var town = $('.moscow ').attr('data-town');
        getAjax(names,tel,type,town,email,txt,art,id)

    });


    $('#callback-pozdr').click(function () {

        $.cookie('was', true, {
            expires: 1,
            path: '/'
        });
        var name = $('.pozdr_name').val();
        var tel = $('.pozdr_tel').val();


        $.ajax({
            type: "POST",
            url: "/forms5min.php",
            data: {name :name , tel:tel},
            success: function (data) {
                if (data == 'ok') {

                    //  alert ('Заявка успешно отправлена');
                    $('.pozdr_name').val('');
                    $('.pozdr_tel').val('');
                    $('#pozdr').fadeOut(300);
                    $('#hide-layout_pozdr').fadeOut(300);
                    $('#hide-layout').fadeIn(300);
                    $('#spasibo').fadeIn(300);
                    SendComagic(name, tel, 'pozdr', '');
                }
                if (data === 'no') {
                    $('#p1_msg').text('Заполните поля')
                    $('#headers').text('Ошибка')
                    $('#popup1').fadeOut(300);
                    $('.pop_name').val('');
                    $('.pop_tel').val('');
                    $('#spasibo').fadeIn(300);
                    SendComagic(name, tel, type, '');
                }
            }
        });


    })

});

$("#low_tel").inputmask("+7 (999) 999-99-99");
$(".v_tel").inputmask("+7 (999) 999-99-99");
$(".r_tel").inputmask("+7 (999) 999-99-99");
$(".pop_tel").inputmask("+7 (999) 999-99-99");
$(".pozdr_tel").inputmask("+7 (999) 999-99-99");
$(".t_tel").inputmask("+7 (999) 999-99-99");


function callback_tel() {
    $('.popup1 .pop_type').val('call');
    $('.popup1 .header').html('ВАМ ПЕРЕЗВОНИТЬ?');
    $('.popup1 .header_sub').html('Мы перезвоним через 1 минуту!');
    $('#hide-layout, #popup1').fadeIn(300);
}

function callback_zamer() {
    $('.popup1 .pop_type').val('zamer');
    $('.popup1 .header').html('ВЫЗОВ ЗАМЕРЩИКА');
    $('.popup1 .header_sub').html('Мы перезвоним через 1 минуту!');
    $('#hide-layout, #popup1').fadeIn(300);
}




function pop_up_block() {
    if ($('.pop_up_block').filter(":hidden")) {
        if ($('#pozdr').filter(":hidden")) {
            $.ajax({
                type: "POST",
                url: "/pop_up_block.php",
                data: {pop_up_block :1 },
                success: function (data) {
                    $( ".pop_up_block" ).text(data).fadeIn(1500);
                    $('.pop_up_block').delay(5000).fadeOut(1500);
                    pop_up_block()
                }
            });
        }
    }




}


if($(".link_block_js a").text().length>=22){
    if($(window).width()>480){
        $(".link_block_js a").css( "font-size", "34px" )
    }else{
        $(".link_block_js a").css( "font-size", "24px" )
    }

}else{
    $(".link_block_js a").css( "font-size", "36px" )
}

$('.p_img').click(function () {
    $('#hide-layout').fadeIn(400)
    $img = $(this).children( 'img' ).attr('src')

    $('.img-full').append('<img  src="'+$img+'">')
    alignCenterImg($('.img-full'))

});
$('.img-full').click(function () {
    $('#hide-layout').fadeOut(400)
    $(this).children( 'img' ).fadeOut(600)
     $(this).empty()


});
function alignCenterImg(elem) {

    elem.css({
        left: ($(window).width() - elem.width()) / 2  + 'px',
        top: ($(window).height() - elem.height()) / 2 + 'px'
    })
}




