<script>
    function hideShow(clas,sm = '?'){
        $('.mains,.main,.document,.project-management,.listing,.user,.smeta_').hide()
        $(clas).show()
        if(sm !='?'){
            $(sm).show()
        }
    }

    function getAjax(item){

        var resultAjax
        jQuery.ajax({
            url: "/",
            async: false,
            data: item,
            dataType: 'json',
            type:"post",

            success: function(data) {


                resultAjax =  data
            },
            error: function(data) {
                resultAjax =  data
                new Noty({
                    theme: 'relax',
                    timeout: 2000,
                    layout: 'topCenter',
                    type: "warning",
                    text: "Ошибка передачи данных"
                }).show();
            }

        });

        return resultAjax
    }
    function selectClient(str,client = false){
        $('#get_select_client,#get_select_client_to').empty()


        if(client){
            userClientAdress =  userClientAdress.filter(item => item.client_id === client )

            $.each(userClientAdress,function(ind,val){
                    item = val.adress
                $('#get_select_client_to').append("<option value='"+val.id+"'>"+item+"</option>")
                $('#popup_client_select').hide()
                $('#popup_client_select_to').show()
            })
        }else{


                if(str == 'name'){
                    $.each(userClient,function(ind,val){
                        item = val.name
                        values = val.id
                        $('#get_select_client').append("<option value='"+values+"'>"+item+"</option>")

                    })

                }else if(str == 'adress'){

                    $.each(userClientAdress,function(ind,val){

                        item = val.adress
                        values = val.client_id
                        $('#get_select_client').append("<option data_adress='"+ val.id +"' value='"+values+"'>"+item+"</option>")

                    })

                }

        }


    }
    var showNoty = true,
        drawing_data_rec,
        setting = {checkClients:false},
        clientId,
        ceilingId,
        user_id =<?=$this->client?>,
        newClient = [],
        editObject = [],
        currentType = 0,
        currentTypeView = 0,
        currentTypeClient = 0,
        editUserClient = [],
        currentDrawing = [],
        canva,
        onclickTrue = 0,
        manufacturera = <?=$this->route['manufacturera']?>,
        types_of_work = <?=$this->route['types_of_work']?>,
        unit = <?=$this->route['unit']?>,
        texture = <?=$this->route['texture']?>,
        rooms = <?=$this->route['rooms']?>,
        userClient = <?=$this->route['client']?>,
        setClient = <?=$this->route['setClient'];?>,
        userClientAdress = <?=$this->route['clientAdress']?>,
        UserClientAdress = userClientAdress,
        texturesmanafacture = <?=$this->route['base']?>,
        texturesData = JSON.parse('[{"texture":{"id":"1","title":"Мат"},"manufacturers":[{"id":"4","name":"MSD Classic(белые)"},{"id":"3","name":"MSD Premium(белые)"},{"id":"2","name":"MSD(цветные)"},{"id":"10","name":"MSD Evolution"},{"id":"1","name":"Longwei"},{"id":"11","name":"Teqtum"},{"id":"13","name":"Cold Stretch"},{"id":"12","name":"LumFer"},{"id":"14","name":"Folien"}]},{"texture":{"id":"2","title":"Сатин"},"manufacturers":[{"id":"4","name":"MSD Classic(белые)"},{"id":"3","name":"MSD Premium(белые)"},{"id":"2","name":"MSD(цветные)"},{"id":"10","name":"MSD Evolution"},{"id":"1","name":"Longwei"},{"id":"12","name":"LumFer"},{"id":"14","name":"Folien"}]},{"texture":{"id":"3","title":"Глянец"},"manufacturers":[{"id":"4","name":"MSD Classic(белые)"},{"id":"3","name":"MSD Premium(белые)"},{"id":"2","name":"MSD(цветные)"},{"id":"10","name":"MSD Evolution"},{"id":"1","name":"Longwei"},{"id":"12","name":"LumFer"}]},{"texture":{"id":"6","title":"Искры"},"manufacturers":[{"id":"2","name":"MSD(цветные)"}]},{"texture":{"id":"9","title":"Перламутр"},"manufacturers":[{"id":"2","name":"MSD(цветные)"}]},{"texture":{"id":"10","title":"Металлик"},"manufacturers":[{"id":"2","name":"MSD(цветные)"}]},{"texture":{"id":"15","title":"Мечта"},"manufacturers":[{"id":"2","name":"MSD(цветные)"}]},{"texture":{"id":"16","title":"Фантазия, Парча"},"manufacturers":[{"id":"2","name":"MSD(цветные)"}]},{"texture":{"id":"20","title":"Хамелеон глянец"},"manufacturers":[{"id":"5","name":"Alkor Draka"}]},{"texture":{"id":"21","title":"Фактура"},"manufacturers":[{"id":"2","name":"MSD(цветные)"}]},{"texture":{"id":"22","title":"Иллюзия"},"manufacturers":[{"id":"2","name":"MSD(цветные)"}]},{"texture":{"id":"23","title":"Вдохновение, Весна, Кожа белые"},"manufacturers":[{"id":"2","name":"MSD(цветные)"}]},{"texture":{"id":"25","title":"Ткань"},"manufacturers":[{"id":"7","name":"Deskor"}]},{"texture":{"id":"27","title":"Штукатурка"},"manufacturers":[{"id":"2","name":"MSD(цветные)"}]},{"texture":{"id":"28","title":"Небо на глянце"},"manufacturers":[{"id":"2","name":"MSD(цветные)"}]},{"texture":{"id":"29","title":"Кружочки"},"manufacturers":[{"id":"2","name":"MSD(цветные)"}]},{"texture":{"id":"30","title":"Шанжан (Фантазия)"},"manufacturers":[{"id":"2","name":"MSD(цветные)"}]},{"texture":{"id":"31","title":"Бабочки"},"manufacturers":[{"id":"2","name":"MSD(цветные)"}]},{"texture":{"id":"32","title":"Листочки"},"manufacturers":[{"id":"2","name":"MSD(цветные)"}]},{"texture":{"id":"33","title":"Velur"},"manufacturers":[{"id":"2","name":"MSD(цветные)"}]},{"texture":{"id":"35","title":"Весна"},"manufacturers":[{"id":"2","name":"MSD(цветные)"}]}]')


    <?if($this->route['setClient'] != 'null'):?>
    var onclickTrue = 1
    <?endif;?>
</script>