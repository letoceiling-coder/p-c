<div id="popup_canvas">
    <center>
        Выберите фактуру:<br>
        <select id="select_facture" class="form-control inputbox"></select><br>
        Выберите производителя:<br>
        <select id="select_manufacturer" class="form-control inputbox"></select><br>
        <button id="btn_okSelectCanvas" class="sketch_hud btn btn-gm">Ок</button>
        <button id="btn_cancelSelectCanvas" class="sketch_hud btn btn-gm">Отмена</button>
    </center>
</div>
<div id="popup_canvasColor">
    <center>
        Выберите цвет:<br>
        <div class="container-colors" id="container_colors"></div>
        <button id="btn_okSelectColor" class="sketch_hud btn btn-gm">Ок</button>
        <button id="btn_cancelSelectColor" class="sketch_hud btn btn-gm">Отмена</button>
    </center>
</div>


<div class="container selectRoom-block" id="popup_input_new" style="display: none;">
    <div class="row">
        <div>
            <form class="form-inline">
                <div class="form-group">
                    <span class="popup_input">Стоимость : <span id="popup_input_new_span"></span></span><br>

                    <br>
                    <input type="number" class="form-control" id="popup_input_new_val" placeholder="">
                    <input type="hidden" id="popup_input_new_hidden">
                </div>
                <br>
                <br>
                <button id="btn_popup_input_new" class="sketch_hud btn btn-gm">Ок</button>
                <button id="btn_cancel_popup_input_new" class="sketch_hud btn btn-gm">Отмена</button>
            </form>

        </div>
    </div>

</div>
<div class="container selectRoom-block" id="popup_input" style="display: none;">
    <div class="row">
        <div>

            <span class="popup_input">Выберите помещение:</span><br>

            <br>

            <button id="btn_rename-popup_input" class="sketch_hud btn btn-gm">Ок</button>
            <button id="btn_cancel_popup_input" class="sketch_hud btn btn-gm">Отмена</button>

        </div>
    </div>

</div>
<div class="container selectRoom-block" id="popup_selectRoom" style="display: none;">
    <div class="row">
        <div>

            <span class="selectClient">Выберите помещение:</span><br>

            <select id="rename-selectRoom" class="form-control inputbox">


            </select><br>

            <br>

            <button id="btn_rename-selectRoom" class="sketch_hud btn btn-gm">Ок</button>
            <button id="btn_cancel_rename-selectRoom" class="sketch_hud btn btn-gm">Отмена</button>

        </div>
    </div>

</div>
<div class="content">

    <div class="header-block container">
        <div class="icons" data-includes="main-1"><img src="/template/client/images/icon/blueprint.png" title=""></div>
        <div class="icons" data-includes="main-2"><img src="/template/client/images/icon/add.png" title="Новый чертеж"></div>
        <div class="icons" data-includes="main-3"><img src="/template/client/images/icon/listing.png" title=""></div>
        <div class="icons" data-includes="main-4"><img src="/template/client/images/icon/project-management.png" title=""></div>
        <div class="icons" data-includes="main-5"><img src="/template/client/images/icon/document.png" title=""></div>
        <div class="icons" data-includes="main-6"><img src="/template/client/images/icon/user.png" title=""></div>
    </div>



    <div id="main-1">
        <div class="container select-block">
            <div class="row">
                <div class="col-xs-9  h-30">
                    <select class="form-control selectRoom">

                    </select>
                </div>
                <div class="col-xs-3 flex-block h-30">
                    <span class="deliteCeiling"><img src="/template/client/images/icon/delite.png" style="width: 30px; "></span>
                    <span class="renameCeiling"><img src="/template/client/images/icon/Rename.png" style="width: 30px; "></span>

                </div>
            </div>
        </div>
        <div style="display: none" id="calc_img"></div>
        <input type="hidden" id="img_hidden" value="">
        <div class="container images-block">
            <img id="slides" style="max-width: 100%;" src="">
        </div>

        <div class="container-fluid hr"></div>

        <div class=" container specification-block">
            <div>
                Стороны:
                <table class="table-striped">
                    <tbody id="table-walls"></tbody>
                </table>
            </div>
            <div>
                Диагонали:
                <table class="table-striped">
                    <tbody id="table-diags"></tbody>
                </table>
            </div>

        </div>
        <div class="container-fluid hr"></div>

        <div class="container specification-block">


            <div style="width: 90%;">
                Спецификация:
                <table class="table-striped" >
                    <tbody>
                    <tr>
                        <td>Кол-во углов (шт.):</td><td><span id="angles_result" readonly="" tabindex="-1"></span></td>
                    </tr>
                    <tr>
                        <td>Периметр (м.):</td><td><span id="perimeter_result" readonly="" tabindex="-1"></span></td>
                    </tr>
                    <tr>
                        <td>Площадь (м<sup>2</sup>.):</td><td><span id="area_result" readonly="" tabindex="-1"></span></td>
                    </tr>
                    <tr>
                        <td>Криволинейность (м.):</td><td><span id="curvilinear_result" readonly="" tabindex="-1"></span></td>
                    </tr>
                    <tr>
                        <td>Внутренний вырез (м.):</td><td><span id="inner_cutout_length" readonly="" tabindex="-1"></span></td>
                    </tr>
                    <tr>
                        <td>Цвет:</td><td><span id="color_id" readonly="" tabindex="-1"></span></td>
                    </tr>
                    <tr>
                        <td>Производитель:</td><td><span id="manufacturer_id" readonly="" tabindex="-1"></span></td>
                    </tr>
                    <tr>
                        <td>Фактура:</td><td><span id="texture_id" readonly="" tabindex="-1"></span></td>
                    </tr>
                    <tr>
                        <td>Ширина материала:</td><td><span id="width_final" readonly="" tabindex="-1"></span></td>
                    </tr>
                    </tbody>
                </table>
            </div>



        </div>
    </div>
    <div id="main-2">
        <!-- форма для чертилки-->
        <form method="POST" action="/" style="display: none" id="form_url">
            <input type="hidden" value="0" id="changes">
            <input type="hidden" value="1" id="internet">
            <input type="hidden" value="" id="id_table">
            <input type="hidden" value="" id="manufacturer_id">
            <input type="hidden" value="" id="texture_id">
            <input type="hidden" value="" id="color_id">
            <input name="texturesData" id="texturesData" value="" type="hidden">
            <input name="texture" id="texture" value="" type="hidden">
            <input name="color" id="color" value="" type="hidden">
            <input name="manufacturer" id="manufacturer" value="" type="hidden">
            <input name="walls" id="walls" value="" type="hidden">
            <input name="width" id="width" value='[{"id":"146","width":"500","price":"165.00"},{"id":"143","width":"450","price":"165.00"},{"id":"140","width":"400","price":"165.00"},{"id":"137","width":"360","price":"110.00"},{"id":"1477","width":"340","price":"110.00"},{"id":"132","width":"320","price":"110.00"},{"id":"951","width":"300","price":"110.00"},{"id":"129","width":"270","price":"110.00"},{"id":"125","width":"240","price":"110.00"},{"id":"921","width":"220","price":"110.00"},{"id":"120","width":"200","price":"110.00"},{"id":"115","width":"150","price":"110.00"}]' type="hidden">
            <input name="calc_id" id="calc_id" value="208331" type="hidden">
            <input name="n4" id="n4" value="" type="hidden">
            <input name="n5" id="n5" value="" type="hidden">
            <input name="n9" id="n9" value="" type="hidden">
            <input name="triangulator_pro" id="triangulator_pro" value="0" type="hidden">
            <input name="type_url" id="type_url" value="&type=calculator" type="hidden">
            <input name="subtype_url" id="subtype_url" value="&subtype=precalc" type="hidden">
            <input name="precalculation" id="precalculation" value="" type="hidden">
            <input name="addition" id="addition" value="" type="hidden">
            <input name="device" id="device" value="" type="hidden">
            <input name="api" id="api" value="" type="hidden">
            <input name="latitude" id="latitude" value="" type="hidden">
            <input name="longitude" id="longitude" value="" type="hidden">
            <input name="advt" id="advt" value="" type="hidden">
            <input name="user_url" id="user_url" value="" type="hidden">
        </form>

        <div id="popup_client" style="display: block;">
            <center>

                <input type="hidden" id="client_id" value="">

                Клиент:<br>
                <input type="text" id="client" value=""><br>
                Телефон клиента:<br>
                <input type="text" id="client_phone" value=""><br>
                Адрес клиента:<br>
                <input type="text" id="client_adress" style="margin-bottom: 10px" value=""><br>
                Помещение:<br>
                <select id="select_client" class="form-control inputbox">



                </select>

                <br>
                <!--            <button id="btn_new_client_select" class="sketch_hud btn btn-gm">Новый клиент</button>-->
                <button id="btn_client_select" class="sketch_hud btn btn-gm">Клиенты</button>
                <button id="btn_client" class="sketch_hud btn btn-gm">Новый заказ</button>

            </center>
        </div>
        <div id="popup_get_rooms" style="display: none;" >
            <center>
                <input type="text" id="input_get_rooms">
                <br>
                <br>
                <button id="btn_get_rooms" class="sketch_hud btn btn-gm">Ок</button>
                <button id="btn_cancel_get_rooms" class="sketch_hud btn btn-gm">Отмена</button>
            </center>
        </div>
        <div id="popup_client_select" style="display: none;">
            <center>
                <span class="selectClient">Выберите клиента:</span><br>

                <select id="get_select_client" class="form-control inputbox">


                </select><br>

                <button id="btn_select_client_adress" class="sketch_hud btn btn-gm">По адресу</button>
                <button id="btn_select_client" class="sketch_hud btn btn-gm">Ок</button>
                <button id="btn_cancel_select_client" class="sketch_hud btn btn-gm">Отмена</button>
            </center>
        </div>



        <div id="preloader" style="display:none;z-index: 99999" class="PRELOADER_GM PRELOADER_GM_OPACITY">
            <div class="PRELOADER_BLOCK"></div>
            <img src="/template/client/images/GM_R_HD.png" class="PRELOADER_IMG">
        </div>

        <form method="POST" action="http://calc.gm-vrn.ru/sketch/index.php" style="display: none" id="form_data">
            <input name="n4" id="input_n4" value="0.00" placeholder="Площадь" type="hidden">
            <input name="n5" id="input_n5" value="0.00" placeholder="Периметр" type="hidden">
            <input name="n9" id="input_n9" value="" placeholder="Углы" type="hidden">
        </form>
        <div id="popup2">
            <center>
                <p>Выберите режим построения диагоналей.</p>
                <button id="triangulate_auto" class="sketch_hud btn btn-gm">Автоматический</button>
                <button id="triangulate_manual" class="sketch_hud btn btn-gm">Ручной</button>
            </center>
        </div>
        <div id="popup_coordinates">
            <center>
                <p>Вставить координаты чертежа:</p>
                <p><textarea id="textarea_coordinates"></textarea></p>
                <button id="coordinates_ok" class="sketch_hud btn btn-gm">Ок</button>
                <button id="coordinates_cancel" class="sketch_hud btn btn-gm">Отмена</button>
            </center>
        </div>
        <div id="popup_build">
            <center>
                <div class="row" style="text-align: right;">
                    <div class="col-md-8 col-xs-8" style="padding-right: 0px; margin-top: 6px;">
                        <label>Введите кол-во стен:</label>
                    </div>
                    <div class="col-md-3 col-xs-3">
                        <input id="input_walls_count" class="form-control" maxlength="3">
                    </div>
                </div>
                <div style="max-height: 300px; overflow-y: auto; margin-top: 6px;">
                    <table class="table-build">
                        <thead><tr><th>Стена</th><th>Длина</th><th>Крив. Лин.</th></tr></thead>
                        <tbody id="tbody_build_walls"></tbody>
                    </table>
                    <hr>
                    <table class="table-build">
                        <thead><tr><th>Диагональ</th><th>Длина</th></tr></thead>
                        <tbody id="tbody_build_diags"></tbody>
                    </table>
                </div>
                <button id="btn_build_ok" class="sketch_hud btn btn-gm">Ок</button>
                <button id="btn_build_cancel" class="sketch_hud btn btn-gm">Отмена</button>
            </center>
        </div>
        <div id="popup_innerCutout">
            <center>
                <p>Выберите фигуру для внутреннего выреза.</p>
                <button class="sketch_hud btn btn-gm" id="ellipse" style="width: 200px;">Овал/Круг</button><br>
                <button class="sketch_hud btn btn-gm" id="rectangle" style="margin-top: 10px; width: 200px;">Прямоугольник/Квадрат</button><br>
                <button class="sketch_hud btn btn-gm" id="rhomb" style="margin-top: 10px; width: 200px;">Ромб</button><br>
                <button id="btn_figure_cancel" class="sketch_hud btn btn-danger" style="margin-top: 10px; width: 200px;">Отмена</button>
            </center>
        </div>
        <div id="popup_level">
            <center>
                <p>Выберите вид потолка.</p>
                <button id="btn_level1" class="sketch_hud btn btn-gm">Простой</button>
                <button id="btn_level2" class="sketch_hud btn btn-gm">Двухуровневый</button>
            </center>
        </div>



        <div class="tar">
            <div id="sketch_editor" class="sketch_window">
                <button class="sketch_hud btn btn-gm" id="hamburger" style="margin-left: 10px;"><i class="fas fa-bars" aria-hidden="true"></i></button>
                <label class="line_check btn btn-gm">
                    <input id="useLine" type="checkbox" class="check" checked="true"><span></span>
                </label>
                <button class="sketch_hud btn btn-gm" id="cancelLastAction"><i class="fas fa-undo" aria-hidden="true"></i></button>
                <button class="sketch_hud btn btn-gm" id="reset"><i class="fas fa-eraser" aria-hidden="true"></i></button>

                <button class="sketch_hud btn btn-gm" id="back"><i class="fas fa-times" aria-hidden="true"></i></button>
            </div>

            <div class="div_canvas" style="width: calc(100% - 190px);">
                <div id="menu">
                    <label class="curve_check btn btn-gm">
                        <input type="checkbox" id="curve"><span></span>
                    </label><br>
                    <label class="arc_check btn btn-gm">
                        <input type="checkbox" id="arc"><span></span>
                    </label><br>
                    <button class="sketch_hud btn btn-gm" id="btn_inner_cutout"><i class="fas fa-cut" aria-hidden="true"></i></button><br>
                    <button class="sketch_hud btn btn-gm" id="btn_build_by_lengths"><i class="fas fa-drafting-compass"></i></button><br>
                    <button class="sketch_hud btn btn-gm" id="btn_paste_coordinates"><i class="fas fa-ruler-combined"></i></button><br>
                    <button class="sketch_hud btn btn-gm" id="btn_place2" style="width:14px;"><i class="fas fa-light fa-lightbulb"></i></button>
                </div>
                <canvas id="myCanvas" resize="" width="1166" style="-webkit-user-drag: none; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); height: 495px; width: 1166px; resize: both;" height="495"></canvas>
            </div>

            <div id="sketch_editor2" class="sketch_window" style="width: 180px;">
                <center>
                    <label class="btn btn-gm line_check">
                        <input id="useLine2" type="checkbox" checked="true"><span></span>
                    </label>
                    <label class="btn btn-gm curve_check">
                        <input type="checkbox" id="curve2"><span></span>
                    </label>
                    <label class="btn btn-gm arc_check">
                        <input type="checkbox" id="arc2"><span></span>
                    </label>
                    <button class="sketch_hud btn btn-gm" id="back2"><i class="fas fa-times" aria-hidden="true"></i></button>
                    <br>
                    <button class="sketch_hud btn btn-gm" id="btn_inner_cutout2"><i class="fas fa-cut" aria-hidden="true"></i></button>
                    <button class="sketch_hud btn btn-gm" id="cancelLastAction2"><i class="fas fa-undo" aria-hidden="true"></i> Отмена</button>
                    <br>
                    <button class="sketch_hud btn btn-gm" id="reset2"><i class="fas fa-eraser" aria-hidden="true"></i> Очистить</button>
                    <button class="sketch_hud btn btn-gm" id="btn_build_by_lengths2"><i class="fas fa-drafting-compass"></i></button>
                    <button class="sketch_hud btn btn-gm" id="btn_paste_coordinates2"><i class="fas fa-ruler-combined"></i></button><br>
                    <button class="sketch_hud btn btn-gm" id="btn_place">Разместить светильники</button>
                    <!--                <button class="sketch_hud btn btn-gm" id="btn_placel">Разместить люстру</button>-->

                    <button id="close_sketch2" class="sketch_hud btn btn-gm"><i class="far fa-save" aria-hidden="true"></i> Сохранить и закрыть</button>
                </center>
            </div>
        </div>

        <div id="window">
            <center>
                <table col="5" id="numpadMobile" class="numpad">
                    <tbody><tr>
                        <td>
                            <button class="but_num" id="num1">1</button>
                        </td>
                        <td>
                            <button class="but_num" id="num2">2</button>
                        </td>
                        <td>
                            <button class="but_num" id="num3">3</button>
                        </td>
                        <td colspan="2">
                            <input name="newLength" id="newLength" value="" placeholder="Длина" type="text" readonly="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button class="but_num" id="num4">4</button>
                        </td>
                        <td>
                            <button class="but_num" id="num5">5</button>
                        </td>
                        <td>
                            <button class="but_num" id="num6">6</button>
                        </td>
                        <td>
                            <button class="but_num" id="numback"><i class="fas fa-arrow-left" aria-hidden="true"></i></button>
                        </td>
                        <td>
                            <button class="but_num" id="ok"><i class="fas fa-check" aria-hidden="true"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button class="but_num" id="num7">7</button>
                        </td>
                        <td>
                            <button class="but_num" id="num8">8</button>
                        </td>
                        <td>
                            <button class="but_num" id="num9">9</button>
                        </td>
                        <td>
                            <button class="but_num" id="num0">0</button>
                        </td>
                        <td>
                            <button class="but_num" id="comma">.</button>
                        </td>
                    </tr>
                    </tbody></table>
                <table col="3" id="numpadMonitor" class="numpad">
                    <tbody><tr>
                        <td colspan="2">
                            <input name="newLength" id="newLength2" value="" placeholder="Длина" type="text" readonly="">
                        </td>
                        <td>
                            <button class="but_num" id="ok2"><i class="fas fa-check" aria-hidden="true"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button class="but_num" id="num12">1</button>
                        </td>
                        <td>
                            <button class="but_num" id="num22">2</button>
                        </td>
                        <td>
                            <button class="but_num" id="num32">3</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button class="but_num" id="num42">4</button>
                        </td>
                        <td>
                            <button class="but_num" id="num52">5</button>
                        </td>
                        <td>
                            <button class="but_num" id="num62">6</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button class="but_num" id="num72">7</button>
                        </td>
                        <td>
                            <button class="but_num" id="num82">8</button>
                        </td>
                        <td>
                            <button class="but_num" id="num92">9</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button class="but_num" id="comma2">.</button>
                        </td>
                        <td>
                            <button class="but_num" id="num02">0</button>
                        </td>
                        <td>
                            <button class="but_num" id="numback2"><i class="fas fa-arrow-left" aria-hidden="true"></i></button>
                        </td>
                    </tr>
                    </tbody></table>
            </center>
        </div>

        <center>
            <button id="close_sketch" class="sketch_hud btn btn-gm"><i class="far fa-save" aria-hidden="true"></i> Сохранить и закрыть</button>
        </center>
    </div>
    <div id="main-3">
        <div class="container">
            <div class="row">
                        <div class="col-xs-8">
                            <input  id="addCategories" class="form-control form-control-sm" type="text" placeholder="добавить категорию">
                        </div>
                        <div class="col-xs-4">
                            <button  id="btn_categories" type="submit" class="btn btn-primary">Добавить</button>
                        </div>
            </div>
        </div>
        <div class="container-fluid hr"></div>

        <div class="container formGroops">

            <div class="row">
                <div class="col-xs-8">
                    <select  id="groops" class="form-control">

                    </select>
                </div>
                <div class="col-xs-4">
                    <button  id="btn_categories_delete" type="submit" class="btn btn-danger">Удалить</button>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 ta-center">
                    <label for="name" class="form-label">Наименование</label>
                    <input  id="name" class=" form-control form-control-sm" type="text" placeholder="Наименование">
                </div>


            </div>
            <div class="row ">
                <div class="col-xs-12 ta-center">
                    <label for="unit" class="form-label">Ед.измерения</label>
                </div>
                <div class="col-xs-12 ">
                    <select  id="unit" class="form-control">

                    </select>
                </div>
                <div class="col-xs-12 ">
                    <div class="col-xs-12 ta-center price-multiple">
                        <label for="price-multiple" class="form-label">Кратность ед.</label>
                        <input  id="price-multiple" class=" form-control form-control-sm" type="number" placeholder="0.01">
                    </div>
                </div>

            </div>
            <div class="row ">
                <div class="col-xs-12 ta-center form-check">
                    <input class="form-check-input" type="checkbox" value="" id="priceCheckChecked">
                    <label class="form-check-label" for="priceCheckChecked">
                        Отметить если это материал
                    </label>
                </div>

            </div>


            <div class="row ">

                    <div class="col-xs-12 ta-center price-client">
                        <label for="price-client" class="form-label">Стоимость для клиента</label>
                        <input  id="price-client" class=" form-control form-control-sm" type="number" placeholder="Стоимость">
                    </div>
                    <div class="col-xs-12 ta-center price-montaj">
                        <label for="price-montaj" class="form-label">Стоимость для монтажника</label>
                        <input  id="price-montaj" class=" form-control form-control-sm" type="number" placeholder="Стоимость">
                    </div>
                    <div class="col-xs-12 ta-center price-materiall" style="display: none">
                        <label for="price-materiall" class="form-label">Стоимость материала</label>
                        <input  id="price-materiall" class=" form-control form-control-sm" type="number" placeholder="Стоимость">
                    </div>
                    <div class="col-xs-12 ta-center formFileMultiple" style="display: none">
                        <label for="formFileMultiple"  class="form-label"="">Загрузить фото товара</label>
                        <input class="form-control" type="file" id="formFileMultiple" multiple="">
                    </div>



            </div>
            <div class="row ">
                <div class="col-xs-12 ta-center">
                    <label for="communications" class="form-label">Тип значения</label>
                </div><div class="col-xs-12 ">
                    <select  id="communications" class="form-control">

                    </select>
                </div>

            </div>
            <div class="row ">
                    <div class="col-xs-12 ta-center" style="margin-top: 25px;">
                        <button id="btn-new-price" type="submit" class="btn btn-primary">Создать</button>
                    </div>

            </div>

        </div>

        <div class="container-fluid hr"></div>

    </div>
    <div id="main-4">

        <div class="container btn-block btn-block-ceiling">
            <button id="ceiling-one" type="button" class="btn btn-success active" >Текущий потолок</button>
            <button id="ceiling-all" type="button" class="btn btn-info " >Все потолки в заказе</button>
        </div>
        <div class="container btn-block btn-block-client">
            <button id="smata-client" type="button" class="btn btn-success active">Клиент</button>
            <button id="smata-montaj" type="button" class="btn btn-info">Монтаж</button>
            <button id="smata-material" type="button" class="btn btn-info">Материал</button>
        </div>
        <div class="container select-block selectRoomBlock">
            <div class="row">
                <div class="col-xs-9  h-30">
                    <select class="form-control selectRoom">

                    </select>
                </div>
                <div class="col-xs-3 flex-block h-30">
                    <span class="deliteCeiling"><img src="/template/client/images/icon/delite.png" style="width: 30px; "></span>
                    <span class="renameCeiling"><img src="/template/client/images/icon/Rename.png" style="width: 30px; "></span>

                </div>
            </div>

        </div>
        <div class="contener-smeta">
            <div class="container">
                <div class="row table-smeta">
                    <div class="col-xs-6 left flex-block h-50">
                        <img id="logoImg"  src="" alt="">
                    </div>
                    <div class="col-xs-6">
                        <div class="row right flex-block h-50">
                            <div class="col-xs-12 fz-10 ">
                                <span>Компания: <span id="name-company"></span></span>
                            </div>
                            <div class="col-xs-12 fz-10">
                                <span>Адрес:<span id="name-company-adress"></span></span>
                            </div>
                            <div class="col-xs-12 fz-10">
                                <span>Телефон:<span id="name-company-phone"></span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid hr"></div>
            <div class="container">
                <div class="row table-smeta">
                    <div class="col-xs-6 left flex-block h-50">
                        <div class="row left flex-block">
                            <div class="col-xs-12 fz-10 ">
                                <span>Номер заказа № <span id="number_order"> <a href=""></a></span></span>
                            </div>
                            <div class="col-xs-12 fz-10">
                                <span>Клиент: <span id="client-smeta"></span></span>
                            </div>
                            <div class="col-xs-12 fz-10">
                                <span>Адрес: <span id="client-adress-smeta"></span></span>
                            </div>
                            <div class="col-xs-12 fz-10">
                                <span>Телефон: <span id="client-phone-smeta"></span></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="row right flex-block h-50">
                            <div class="col-xs-12 fz-10 ">
                                <span> <span> Дата заказа:</span>
                            </div>
                            <div class="col-xs-12 fz-10">
                                <span id="days"></span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="container table-smeta-one">

                <table class="table-bordered">


                </table>

            </div>
        </div>
    </div>

    <div id="main-5">
        <div class="container select-block ">
            <div class="row">
                <div class="col-xs-9  h-30">
                    <select class="form-control selectRoom"></select>
                </div>
                <div class="col-xs-3 flex-block h-30">
                    <span class="deliteCeiling"><img src="/template/client/images/icon/delite.png" style="width: 30px; "></span>
                    <span class="renameCeiling"><img src="/template/client/images/icon/Rename.png" style="width: 30px; "></span>

                </div>
            </div>

        </div>
        <div class="container btn-block btn-block-client" style="margin-top: 20px">
            <button id="smata-works" type="button" class="btn btn-success active">Работы</button>
            <button id="smata-materials" type="button" class="btn btn-info">Материалы</button>

        </div>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <ul id="navs"></ul>
                </div>
            </div>
        </div>
    </div>
    <div id="main-6">
        <div class="container btn-block btn-block-ceiling">


            <div class="container btn-block btn-block-client">
                <button id="files-admin" type="button" class="btn btn-success active">Формирование файлов</button>
                <button id="smeta-admin" type="button" class="btn btn-info">Редактор Наменклатуры Сметы</button>
                <button id="" type="button" class="btn btn-info">Настройки компании</button>
            </div>
            <div class="block-admins">
                <div class="admin files-admin">
                    <button id="form-smeta-client" type="button" class="btn btn-success active btn-info">Сформировать смету клиента</button>
                    <button id="form-smeta-montaj" type="button" class="btn btn-success active btn-info">Сформировать смету монтажника</button>
                    <div id="resultHREF"></div>
                    <div class="container-fluid hr"></div>
                </div>
                <div class="admin smeta-admin" style="display:none;">
                    <div class="container btn-block btn-block-client" style="margin-top: 20px">
                        <button id="smata-works-redactor" type="button" class="btn btn-success active">Работы</button>
                        <button id="smata-materials-redactor" type="button" class="btn btn-info">Материалы</button>

                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div id="navsRedactor"></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>


</div>

