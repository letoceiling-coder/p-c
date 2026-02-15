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
    $(".t_tel").inputmask("+7 (999) 999-99-99");
    function svg2img(){
        var svg = document.querySelector('svg');
        var xml = new XMLSerializer().serializeToString(svg);
        var svg64 = btoa(xml); //for utf8: btoa(unescape(encodeURIComponent(xml)))
        var b64start = 'data:image/svg+xml;base64,';
        var image64 = b64start + svg64;
        return image64;
    };
    function alignCenter(elem) {
        elem.css({
            left: ($(window).width() - elem.width()) / 2  + 'px',
            top: 0 + 'px'
        })
    }
    alignCenter($('#getnewclient'));
    alignCenter($('#result'));

$('#value-client').click(function (){

    $('.client-hide').toggle()
})

    $('.blue_btn_').click(function (){
   var txt ;
   var name = $('.t_name').val()
   var phone = $('.t_tel').val()
   var adress = $('.t_adress').val()

    if (name == '')txt = 'Заполнить name'
    if (phone == '')txt = 'Заполнить phone'
    if (adress=='')txt = 'Заполнить adress'
        if (name == ''|| phone == '' || adress==''){
            $('#result').text(txt)
            $("#result").show('slow');
            setTimeout(function() { $("#result").hide('slow'); }, 2000);
            return false
        }


        $.ajax({
            type: "POST",
            url: "/",
            data: {name :name, phone:phone, adress:adress, sub:'newclient' },

            success: function (data) {
                window.location.href = "/client/id/"+data;
            }
        });
    })

    $( ".smeta_select" ).change(function() {

        var room = $("#room").val()

        var manufacture = $("#manufacture").val()
        var client_id = $("#client_id").val()
        var material = $("#material").val()
        const result = localStorage.getItem('result');
        var data = JSON.parse(result)
        data.room = room
        data.manufacture = manufacture
        data.material = material
        data.client_id = client_id
        data.images = svg2img(data.img)


        if (form_smeta!=0 && material!=0 && room!=0){
            var datas = JSON.stringify(data)

            $.ajax({
                type: "POST",
                url: "/",
                data: {name :datas, sub:'clientform' },

                success: function (data) {
                    console.log(data)
                    if (data){
                        window.location.href = "/client/smeta/"+client_id+'/'+data;
                    }

                }
            });
        }

    });

    $('#newType').click(function (){

        $.ajax({
            type: "POST",
            url: "/",
            data: {sub:'getform' },

            success: function (data) {
                alert(data)
                $('.form_smeta_').append(data)

            }
        });

    })
    $( "#saveType" ).on( "click", function( event ) {
        event.preventDefault();
        var client_id =$('#id_rooms').val();
         var saveType = $('form').serializeArray() ;
        console.log(saveType)
        $.ajax({
            type: "POST",
            url: "/",
            data: {data:saveType,id:client_id,sub:'saveType' },

            success: function (data) {
              console.log(data)

            }
        });
    });

    $( "#newpotolok" ).click(  function(  ) {

        var client_id =$('#client_id').val();
        window.location.href = '/client/id/'+client_id;

    });
    $( "#newmaterial" ).click(  function(  ) {

        var client_id =$('#client_id').val();
        window.location.href = '/client/newmaterial/'+client_id;

    });

    $(document).on('change', '.smeta_row', function() {
        var id =$(this).val();

        var client_id =$('#client_id').val();
        var id_rooms =$('#id_rooms').val();
        var saveType = $('form').serializeArray() ;
        var update = 0 ;
            if($(this).hasClass('update')){
                 update = 1;
            }
        $.ajax({
            type: "POST",
            url: "/",
            data: {saveType:saveType,id:id,id_rooms:id_rooms,client_id:client_id,sub:'getform',update:update },

            success: function (data) {
                console.log(data)
                if ($.isNumeric(data)){
                   var $temp  = $('input[name="id-'+data+'"]').val()
                    $('input[name="id-'+data+'"]').val($temp).focus()
                }else{
                    $('#form_smeta_').append(data)
                }


            }
        });


    })
    $( document ).on( "click",".result p", function( event ) {

        var $text = $(this ).text()
        var purpose = $(this ).attr('data-purpose')

        $text = $text + ' '
        $('#low_name').val(purpose+' '+$text+' д. ')
        $('#low_name').focus();
        $('.result').empty().hide()
    });

    $(document).on('keyup', '#low_name', function() {
var up = $(this).val()
    //alert(up.toString().slice(-1))
if (up.length>1){
    $.ajax({
        type: "POST",
        url: "/",
        data: {up:up,sub:'getstreet' },

        success: function (data) {
            if (data){
                $('.result').show()
                $('.result').empty()
                $('.result').append(data)
            }

        }
    });
}




    })
function upDates(formsData,id = false){

    $.ajax({
        type: "POST",
        url: "/",
        data: {data:formsData,id:id,sub:'saveType' },

        success: function (data) {
           console.log(data)

        }
    });

}
    $(document).on('change', '#Room', function() {

        var id_ =$(this).val();
        var client_id =$('#client_id').val();

        if ($(this).val() != 0){

            window.location.href = '/client/smeta/'+ client_id+'/'+id_

        }else {


                    window.location.href = '/client/smeta/'+ client_id +'/0'



        }



    })
    $(document).on('change', '.smeta_select_', function() {

        var id_ =$('#id_rooms').val();

        var saveType = $('form').serializeArray() ;
        console.log(saveType)
        upDates(saveType,id_)
    })

    $("#autz_client").click(function (){

        var name = $('#low_name').val()
        var password = $('#low_password').val()
        alert(name)
        alert(password)
        $.ajax({
            type: "POST",
            url: "/",
            data: {password :password,name:name,sub:'autz_client' },
            beforeSend: function() {
                $('.cssload-thecube').show();
                $('.none').hide();
            },
            success: function (data) {
                $('.cssload-thecube').hide();
                $('.none').show();
                
                location.reload();


            }
        });
    })

})