$(document).ready(function (){

    getRooms()
function getRooms(){
    $('#select_client').empty()
    $.each(rooms,function(ind,val){
        $('#select_client').append("<option value='"+val.id+"'>"+val.name+"</option>")
    })
    $('#select_client').append("<option value='0'>Добавить</option>")
}

    $(document).on('change','#select_client',function(e) {
        itemSelect = $(this).val()
        if(itemSelect == 0){
            $('#popup_get_rooms').show()
            $('#popup_client').hide()
        }

    });

    $('#btn_cancel_get_rooms').click(function (){
        $('#popup_get_rooms').hide()
        $('#popup_client').show()
        $('#select_client option:first').prop('selected', true);
    })
    $('#btn_get_rooms').click(function (){
       text =  $('#input_get_rooms').val()
        maxid = rooms.reduce(function(prev, current) {
            if (+current.id > +prev.id) {
                return current;
            } else {
                return prev;
            }
        });
        rooms.push({id:(maxid.id-0)+1,name:text})
        getRooms()
        $('#popup_get_rooms').hide()
        $('#popup_client').show()

        $('#select_client option:contains("'+ text +'")').prop('selected', true);
        getAjax({room:text, successs:'newroom'});
    })
    $('#btn_cancel_select_client,#btn_cancel_select_client_to').click(function (){

        $('#popup_client_select_to').hide()
        $('#popup_client_select').hide()
        $('#popup_client').show()

    })

    $('#btn_client').click(function (){
        clearElems();
        client = $('#client').val()
        client_phone = $('#client_phone').val()
        client_adress = $('#client_adress').val()
        room_id = $('#select_client').val()
        room_name = $('#select_client option:selected').text();
if (!client) {
    new Noty({
        theme: 'relax',
        timeout: 2000,
        layout: 'topCenter',
        type: "warning",
        text: "Заполните Имя"
    }).show();
}else if(!client_phone){
    new Noty({
        theme: 'relax',
        timeout: 2000,
        layout: 'topCenter',
        type: "warning",
        text: "Заполните телефон"
    }).show();
}else if(!client_adress){
    new Noty({
        theme: 'relax',
        timeout: 2000,
        layout: 'topCenter',
        type: "warning",
        text: "Заполните адрес"
    }).show();
}else {

    if(id = userClient.find(item => item.name === client && item.phone === client_phone )){
        if(userClientAdress.find(item => item.client_id === id.id && item.adress == client_adress)){
            newClient.push({room_name:room_name,
                            room_id:room_id,
                            client_id:id.id,
                            user_id:user_id,
                            adress:client_adress,
                            newCeiling:true

            })
            if(showNoty){
                new Noty({
                    theme: 'relax',
                    timeout: 2000,
                    layout: 'topCenter',
                    type: "warning",
                    text: "Создан новый чертеж"
                }).show();
            }

        }else {
            max = userClientAdress.reduce(function(prev, current) {
                if (+current.id > +prev.id) {
                    return current;
                } else {
                    return prev;
                }
            });

            userClientAdress.push({
                id:String((max.id-0)+1),
                user_id:user_id,
                client_id:id.id,
                adress:client_adress
            })
            newClient.push({room_name:room_name,
                room_id:room_id,
                client_id:id.id,
                user_id:user_id,
                adress:client_adress,
                newCeiling:true,
                newAdress:true

            })
            if(showNoty){
                new Noty({
                    theme: 'relax',
                    timeout: 2000,
                    layout: 'topCenter',
                    type: "warning",
                    text: "Создан новый чертеж "
                }).show();
                new Noty({
                    theme: 'relax',
                    timeout: 2000,
                    layout: 'topCenter',
                    type: "warning",
                    text: "Создан новый адрес клиента "
                }).show();
            }

        }
    }else{
        max = userClient.reduce(function(prev, current) {
            if (+current.id > +prev.id) {
                return current;
            } else {
                return prev;
            }
        });
        userClient.push({
            id:max,
            client_id:client_phone,
            user_id:user_id,
            name:client,
            phone:client_phone,
            adress:client_adress
        })
        max = userClientAdress.reduce(function(prev, current) {
            if (+current.id > +prev.id) {
                return current;
            } else {
                return prev;
            }
        });

        userClientAdress.push({
            id:String((max.id-0)+1),
            user_id:user_id,
            client_id:client_phone,
            adress:client_adress
        })
        newClient.push({room_name:room_name,
            room_id:room_id,
            client_id:client_phone,
            user_id:user_id,
            name:client,
            phone:client_phone,
            adress:client_adress,
            newCeiling:true,
            newClient:true,
            newAdress:true})
        if(showNoty){
            new Noty({
                theme: 'relax',
                timeout: 2000,
                layout: 'topCenter',
                type: "success",
                text: "Создан новый клиент "
            }).show();
            new Noty({
                theme: 'relax',
                timeout: 2000,
                layout: 'topCenter',
                type: "success",
                text: "Добавлен новый адрес "
            }).show();
            new Noty({
                theme: 'relax',
                timeout: 2000,
                layout: 'topCenter',
                type: "success",
                text: "Создан новый чертеж "
            }).show();
        }


    }

    $('#popup_client').hide()

}



    })
})