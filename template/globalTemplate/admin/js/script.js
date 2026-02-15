var ROUTE = {};
$(document).ready(function (){

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


    $("#autz_admin").click(function (){
        var name = $('#low_name').val();
        var password = $('#low_password').val();
        
        // Валидация полей
        if (!name){
            new Noty({
                theme: 'relax',
                timeout: 2000,
                layout: 'topCenter',
                type: "warning",
                text: "Заполните логин"
            }).show();
            return false;
        }else if (!password){
            new Noty({
                theme: 'relax',
                timeout: 2000,
                layout: 'topCenter',
                type: "warning",
                text: "Введите пароль"
            }).show();
            return false;
        }
        
        $.ajax({
            type: "POST",
            url: "/",
            data: {password: password, name: name, success: 'autz_admin'},
            dataType: 'json',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            beforeSend: function() {
                $('.cssload-thecube').show();
                $('.none').hide();
            },
            success: function (data) {
                $('.cssload-thecube').hide();
                $('.none').show();
                
                console.log('Response data:', data);
                if (data == null || data === false || data === 'false'){
                    new Noty({
                        theme: 'relax',
                        timeout: 2000,
                        layout: 'topCenter',
                        type: "warning",
                        text: "НЕ ВЕРНЫЙ ЛОГИН ИЛИ ПАРОЛЬ"
                    }).show();
                }else{
                    location.reload();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('.cssload-thecube').hide();
                $('.none').show();
                console.error('AJAX Error:', textStatus, errorThrown);
                console.error('Response:', jqXHR.responseText);
                new Noty({
                    theme: 'relax',
                    timeout: 2000,
                    layout: 'topCenter',
                    type: "error",
                    text: "Ошибка передачи данных: " + textStatus
                }).show();
            }
        });
    })


    var contentold=[];   //объявляем переменную для хранения неизменного текста
    var content= {};   //объявляем переменную для хранения неизменного текста


    $('[contenedit]').hover(
        function() {
            $(this).css("border",'3px red solid')
        }, function() {
            $(this).css("border",'none')
        }
    );
    $('[contenedit]') .mousedown(function (e){
        e.stopPropagation();

        contentold = $(this).text();
        typeID = $(this).attr('contenedit')
        $('#popupadmin').show();
        if(typeID == 'str'){

            $('#editAdmin').empty().append("<div class='low_text' id='popupadmin_textarea'><textarea name='' id='' cols='30' rows='10'></textarea></div>")
        }
        if(typeID == 'num'){
            num = $(this).text()
            data_route = $(this).attr('data_route')
            num = num.replace(/[^0-9]/g, '');
            $('#editAdmin').empty().append("<div class='low_name' id='popupadmin_input_num'><input class='pop_name' id='' type='text' placeholder='Ваше имя' value='"+ num +"'></div>")
            $('#editAdmin input').focus(function(){
                $(this).select();
            });
            pathTable = $('#pathTable').val()
            template = $('#template').val()
            ROUTE = {data:num,typeid:typeID,selector:data_route,pathTable:pathTable,template:template,success:'get_edit_content'}

        }
        if(typeID == 'img'){
            pathTable = $('#pathTable').val()
            template = $('#template').val()
            data_route = $(this).attr('data_route')
            $('#editAdmin').empty().append("<div class='box'><input type='file' name='multi_img_file[]' id='js-file' accept='.gif,.jpg,.jpeg,.png,.svg' class='inputfile inputfile-1' data-multiple-caption='{count} Загруженых файлов' multiple=''> <label for='js-file'><svg xmlns='http://www.w3.org/2000/svg' width='20' height='17' viewBox='0 0 20 17'><path d='M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z'></path></svg> <span>Загрузить файл…</span></label></div>")

            $id = $(this).attr('class')
            img = document.querySelector('.'+$id).style.backgroundImage
            ROUTE = {img:img,typeid:typeID,selector:data_route,pathTable:pathTable,template:template,success:'get_edit_content'}


        }

        console.log(document.querySelector('.'+$id).style.backgroundImage)

    })
    $(document).on('change',"#js-file",function(){
        if (window.FormData === undefined) {
            alert('В вашем браузере FormData не поддерживается')
        } else {
            pathTable = $('#pathTable').val()
            template = $('#template').val()

            var formData = new FormData();
            formData.append('file', $("#js-file")[0].files[0]);
            formData.append('route',JSON.stringify(ROUTE));
            formData.append('success','get_edit_content');
            formData.append('typeid','img');
            formData.append('template',template);
            formData.append('pathTable',pathTable);
            formData.append('selector',ROUTE.selector);
            formData.append('img',ROUTE.img);



            $.ajax({
                type: "POST",
                url: '/',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                dataType : 'json',
                success: function(data){

                    $('[data_route="'+ROUTE.selector+'"]').css('background-image','url('+data+')')

                },
                error: function(data) {

                    $file = $("#js-file")[0].files[0]['name'];
                    console.log($file)
                    $('[data_route="'+ROUTE.selector+'"]').css('background-image','url(/template/globalTemplate/images/'+$file+')')
                    console.log(data)
                }
            });
        }
    });
    $('#btn_popupadmin').on('click',function (){

        if (ROUTE.typeid == 'num'){
            ROUTE.data_ = ROUTE.data
            ROUTE.data = $('#popupadmin_input_num input').val()
        }
        $res = getAjax(ROUTE)
        console.log(ROUTE)
        if ($res == 1){
            new Noty({
                theme: 'relax',
                timeout: 2000,
                layout: 'topCenter',
                type: "success",
                text: "Успешно"
            }).show();

            if (ROUTE.typeid == 'num'){
               str = $('[data_route="'+ ROUTE.selector +'"]')
                str.html(str.html().replace(ROUTE.data_,ROUTE.data))
                $('#popupadmin').hide()

            }

            ROUTE = [];
        }else{
            new Noty({
                theme: 'relax',
                timeout: 2000,
                layout: 'topCenter',
                type: "warning",
                text: $res
            }).show();
        }

    })







//     function savedata(elementidsave,contentsave) {
//         //функция для сохранения отредактированного текста с помощью ajax
//         $.ajax({
//             url: 'save.php',    //url который обрабатывает и сохраняет наш текст
//             type: 'POST',
//             data: {
//                 content: contentsave,     //наш пост запрос
//                 id:elementidsave
//             },
//             success:function (data) { //получили ответ от сервера - обрабатываем
//                 if (data == contentsave)
//                     //сервер прислал нам отредактированный текст, значит всё ok
//                 {
//                     $('#'+elementidsave).html(data);
// //записываем присланные данные от сервера в элемент, который редактировался
//                     $('<div id="status">Данные успешно сохранены:'+data+'</div>')
//                         //выводим      сообщение об успешном ответе сервера
//                         .insertAfter('#'+elementidsave)
//                         .addClass("success")
//                         .fadeIn('fast')
//                         .delay(1000)
//                         .fadeOut('slow', function() {this.remove();});
//                     //уничтожаем элемент
//                 }
//                 else
//                 {
//                     $('<div id="status">Запрос завершился ошибкой:'+data+'</div>')
//                         // выводим данные про ошибку
//                         .insertAfter('#'+elementidsave)
//                         .addClass("error")
//                         .fadeIn('fast')
//                         .delay(3000)
//                         .fadeOut('slow', function() {this.remove();});
//                     //уничтожаем элемент
//                 }
//             }
//         });
//     }


        // $('[contenteditables="true"]')     //редактируемый элемент
        //     .mousedown(function (e)    //обрабатываем событие нажатие мышки
        //     {
        //         e.stopPropagation();
        //         elementid=this.id;
        //         contentold[elementid]=$(this).html();  //текст до редактирования
        //         $(this).bind('keydown', function(e) {    //обработчик нажатия Escape
        //             if(e.keyCode==27){
        //                 e.preventDefault();
        //                 $(this).html(contentold[elementid]);
        //                 //возвращаем текст до редактирования
        //             }
        //         });
        //
        //         $("#save").show();//показываем кнопку "сохранить"
        //     })
        //     .blur(function (event)      //обрабатываем событие потери фокуса
        //     {
        //         var elementidsave=this.id;             //id элемента потерявшего фокус
        //         var  contentsave = $(this).html();
        //         console.log(contentsave)//текст для сохранения
        //         event.stopImmediatePropagation();
        //         if (elementid===elementidsave)
        //             // если id не совпадает с id элемента, потерявшего фокус,
        //         {$("#save").hide(); }
        //         // значит фокус  в редактируемом элементе, кнопку не прячем
        //         if (contentsave!=contentold[elementidsave])  //если текст изменился
        //         {
        //             savedata(elementidsave,contentsave);   //отправляем на сервер
        //         }
        //     });

})