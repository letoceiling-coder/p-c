function alignCenter(elem) {
    elem.css({
        left: ($(window).width() - elem.width()-40) / 2  + 'px',
        top: 10  + '%'
    })
}
function disable(){

    $('.popup-fade').show()
    $('body').css('overflow', 'hidden')

}

function enable(){
    $('.popup-fade').hide()
    $('body').css('overflow', 'visible')
}

$(document).ready(function (){

    $(document).on('click','.cloused',function (){
        $('.popup-form-dogovor,.popup-fade').hide()
        enable()
    })
    $(document).on('click','#approval',function (){
        if ($('#in-approval').is(':checked')){
            alignCenter($('.popup-form-dogovor'));

            disable()

            text = $('#number_order').text()
            client = $('#client-smeta').text()
            phone = $('#client-phone-smeta').text()
            console.log(text)
            jQuery.ajax({
                url: "/",
                async: false,
                data: {success:'formclient',text:text,client:client,phone:phone},
                dataType: 'json',
                type:"post",

                success: function(data) {

                    $('.popup-form-dogovor').show()
                    $('.block-hide').hide()
                    $('#otvet').text(data.return)

                },
                error: function(data) {
                    resultAjax =  'error'
                    new Noty({
                        theme: 'relax',
                        timeout: 2000,
                        layout: 'topCenter',
                        type: "warning",
                        text: "Ошибка передачи данных"
                    }).show();
                }

            });
        } else {
            return false

        }

    })

    $(document).on('change','#in-approval',function (){
        if ($('#in-approval').is(':checked')){
            $('#approval').removeClass('btn-danger').removeClass('disabled').addClass('btn-success')
        } else {
            $('#approval').removeClass('btn-success').addClass('btn-danger').addClass('disabled')

        }

    })
})