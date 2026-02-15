
<div class="smeta_" >
    <div class="container-fluid fixed">
        <div class="row justify-content-center text-center flex_">
            <div id="main" class="col block"><a href="main"><img src="/template/client/images/icon/blueprint.png" title=""></a></div>
            <div class="col block"><a href="mains"><img src="/template/client/images/icon/add.png" title="Новый чертеж"></a></div>
            <div class="col block "><a href="listing"><img src="/template/client/images/icon/listing.png" title=""></a></div>
            <div class="col block"><a href="project-management"><img src="/template/client/images/icon/project-management.png" title=""></a></div>
            <div class="col block documentroot"><a href="document"><img src="/template/client/images/icon/document.png" title=""></a></div>
            <div class="col block"><a href="user"><img src="/template/client/images/icon/user.png" title=""></a></div>
        </div>
    </div>
</div>
<div class="main" >
    <div class="container-fluid ">
        <div class="row justify-content-center text-center " style="padding-top: 10px;">
            <!--            <canvas id="myCanvas2" resize="" width="100%" style="-webkit-user-drag: none; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); height: 350px; width: 100%; resize: both;" height="350"></canvas>-->

            <div class="wid-6 " style="margin-top: 40px;">
                <select id="selectRoom" class="form-control inputbox selectOll" aria-label=".form-select-sm example">
                </select>
                <span class="deliteCeiling"><img src="/template/client/images/icon/delite.png" style="width: 30px; cursor: pointer; position: relative; left: -15px; top: 2px;"></span>
            </div>


        </div>

        <div style="display: none" id="calc_img" ></div>
        <div class="w-90" style="text-align: center;margin: 0 auto"><img id="slides"  style="max-width: 100%;" ></div>



        <div class="contener" style="padding-top: 10px;">
            <div class="row">
                <div class="result-length-container">
                    <div>
                        Стороны:
                        <table>
                            <tbody id="table-walls"></tbody>
                        </table>
                    </div>
                    <div>
                        Диагонали:
                        <table>
                            <tbody id="table-diags"></tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="result-length-container">
                    <div>
                        Спецификация:
                        <table>
                            <tbody>
                            <tr>
                                <td>Кол-во углов (шт.):</td><td><span id="angles_result" readonly="" tabindex="-1">4</span></td>
                            </tr>
                            <tr>
                                <td>Периметр (м.):</td><td><span id="perimeter_result" readonly="" tabindex="-1">6.16</span></td>
                            </tr>
                            <tr>
                                <td>Площадь (м<sup>2</sup>.):</td><td><span id="area_result" readonly="" tabindex="-1">2.07</span></td>
                            </tr>
                            <tr>
                                <td>Криволинейность (м.):</td><td><span id="curvilinear_result" readonly="" tabindex="-1">0</span></td>
                            </tr>
                            <tr>
                                <td>Внутренний вырез (м.):</td><td><span id="inner_cutout_length" readonly="" tabindex="-1">0</span></td>
                            </tr>
                            <tr>
                                <td>Цвет:</td><td><span id="color_id" readonly="" tabindex="-1">511</span></td>
                            </tr>
                            <tr>
                                <td>Производитель:</td><td><span id="manufacturer_id" readonly="" tabindex="-1">MSD(цветные)</span></td>
                            </tr>
                            <tr>
                                <td>Фактура:</td><td><span id="texture_id" readonly="" tabindex="-1">Бабочки</span></td>
                            </tr>
                            <tr>
                                <td>Ширина материала:</td><td><span id="width_final" readonly="" tabindex="-1">320</span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="listing">
    <div class="container-fluid">
        <div class="row justify-content-center text-center "  style="padding-top: 40px;">
            <div id="myModal" class="modal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Подтверждение</h5>

                        </div>
                        <div class="modal-body">
                            <p>Вы хотите сохранить изменения в этом документе перед закрытием?</p>
                            <p class="text-secondary"><small>Если вы не сохраните, ваши изменения будут потеряны.</small></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Отмена</button>
                            <button type="button" id="delite_categories" class="btn btn-warning">Удалить</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row justify-content-center text-center">
                    <div class="col-12 col-sm-12 col-md-10 col-lg-8	col-xl-6 col-xxl-4">
                        <col-12><label for="form-control" class="form-label">Добавить категорию</label></col-12>
                        <div class="row">
                            <div class="col-8" style="width: 90%;margin: 0 auto;">

                                <input style="float: left;width: 70%;" id="addCategories" class="form-control form-control-sm" type="text" placeholder="добавить категорию">
                                <button style="width: 90px;" id="submit_cat" type="submit" class="btn btn-primary">Добавить</button>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <hr>
            <div class="container-fluid">
                <div class="row justify-content-center text-center">
                    <div class="col-12">
                        <label for="form-control" class="form-label">Категории</label>
                        <div class="row">
                            <div class="col-8" style="width: 90%;margin: 0 auto;">
                                <select style="float: left;width: 70%;" id="groops" class="form-control" >
                                </select>
                                <button style="width: 90px;" id="submit_cat_delite" type="submit" class="btn btn-danger">Удалить</button>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row justify-content-center text-center"">
                <div class="col-10">
                    <label for="form2" class="form-label">Наименование</label>
                    <input style="width: 90%;margin: 0 auto;" id="name" class="form2 form-control form-control-sm" type="text" placeholder="Наименование">
                    <label for="form-control" class="form-label">Стоимость</label>
                    <input style="width: 90%;margin: 0 auto;" id="price" class="form-control form-control-sm" type="text" placeholder="Стоимость">
                    <label for="form-control" class="form-label">Ед.измерения</label>
                    <select style="width: 90%;margin: 0 auto;" id="unit" class="form-control" >
                    </select>
                    <label for="type_values" class="form-label">Тип услуги</label>
                    <select style="width: 90%;margin: 0 auto;" id="type_values" class="form-control" >
                        <option value="0">default</option>
                    </select>
                    <label for="type_services" class="form-label">Тип значения</label>
                    <select style="width: 90%;margin: 0 auto;"id="type_services" class="form-control" >
                        <option value="0">default</option>
                    </select>
                    <div class="row justify-content-center text-center" style="margin-top: 10px">
                        <div class="col-10 form-check">
                            <input  class="form-check-input" type="checkbox" value="" id="flexCheckChecked" >
                            <label class="form-check-label" for="flexCheckChecked">
                                Отметить если это товар
                            </label>
                        </div>
                        <div class="col-10 form-check">
                            <input  class="form-check-input" type="checkbox" value="" id="by_default" >
                            <label class="form-check-label" for="by_default">
                                Автоматически применять для расчета
                            </label>
                        </div>
                    </div>

                    <div id="files" style="display: none;width: 90%;margin: 0 auto;">
                        <label for="formFileMultiple" onchange="encodeImage(this) class="form-label">Загрузить фото товара</label>
                        <input class="form-control"  type="file" id="formFileMultiple" multiple />

                    </div>
                    <br>
                    <button id="submit" type="submit" class="btn btn-primary">Создать</button>
                </div>


            </div>
        </div>
    </div>
</div>
</div>


<div class="project-management">
    <div class="rows">

        <div class="vcladka">

            <span id="oneCeiling" class="activeCeiling">Текущий потолок</span>
            <span id="allCeiling" >Все потолки в заказе</span>
        </div>
        <br>
        <div class="vcladka-2">

            <span id="currentTypeClient" >Клиент</span>
            <span id="currentTypeMontaj" >Монтаж</span>

        </div>
        <div class="oneCeiling">
            <div class="wid-6">
                <select id="select_room_client" class="form-control inputbox selectOll">
                </select>
                <span class="deliteCeiling"><img src="/template/client/images/icon/delite.png" style="width: 30px; cursor: pointer; position: relative; left: -15px; top: 2px;"></span>
                <!--            <button id="btn_client" class="sketch_hud btn btn-gm">Текущий потолок</button>-->
                <!--            <button id="btn_client" class="sketch_hud btn btn-gm">Все потолки в заказе</button>-->
            </div>
            <div class="wid-align-items-center-6 hr-bottom">
                <div class="w-40"><img class="logoImg" style="height: 50px;margin: 0 10%" src="<?=$this->settings['logoImage']?>" alt=""></div>
                <div class="w-60 fz-10 ta-right fw-bold">
                    <span >Компания: <span class="nameCompany">Proffi Center</span></span><br>
                    <span >Адрес:<span class="nameCompanyAdress"></span></span><br>
                    <span >Телефон:<span class="nameCompanyPhone">78888888888</span></span>
                </div>
            </div>

            <div class="wid-6">
                <div class="w-60 fz-10 ta-left fw-bold">
                    <span >Номер заказа № <span class="number_order"></span></span><br>
                    <span >Клиент: <span class="clientSmeta"></span></span><br>
                    <span >Адрес: <span class="client_adressSmeta"></span></span><br>
                    <span >Телефон: <span class="client_phoneSmeta"></span></span>
                </div>
                <div class="w-40 fz-10 fw-bold ta-center">
                    <span > Дата заказа:</span><br>
                    <span class="day"></span>
                </div>
            </div>
            <div class="w-100 fz-10 fw-bold ta-center" >
                <div class="w-100">
                    <table class="table col-11">



                    </table>

                </div>


            </div>
        </div>
<div class="allCeiling">

            <div class="wid-align-items-center-6 hr-bottom">
                <div class="w-40"><img class="logoImg" style="height: 40px;;margin: 0 10%" src="<?=$this->settings['logoImage']?>" alt=""></div>
                <div class="w-60 fz-10 ta-right fw-bold">
                    <span >Компания: <span class="nameCompany">Proffi Center</span></span><br>
                    <span >Адрес:<span class="nameCompanyAdress"></span></span><br>
                    <span >Телефон:<span class="nameCompanyPhone">78888888888</span></span>
                </div>
            </div>

            <div class="wid-6">
                <div class="w-60 fz-10 ta-left fw-bold">
                    <span >Номер заказа № <span class="number_order"></span></span><br>
                    <span >Клиент: <span class="clientSmeta"></span></span><br>
                    <span >Адрес: <span class="client_adressSmeta"></span></span><br>
                    <span >Телефон: <span class="client_phoneSmeta"></span></span>
                </div>
                <div class="w-40 fz-10 fw-bold ta-center">
                    <span > Дата заказа:</span><br>
                    <span class="day"></span>
                </div>
            </div>
            <div class="w-100 fz-10 fw-bold ta-center" >
                <div class="w-100">
                    <table class="table col-11">



                    </table>

                </div>


            </div>
        </div>
    </div>

</div>

<div class="document ">
    <select id="select_smeta_client" class="form-control inputbox selectOll"></select>
    <div class="vcladkaSmeta">

        <span id="oneCeilingSmeta" class="activeCeiling">Текущий потолок</span>
        <span id="allCeilingSmeta">Все потолки в заказе</span>
        <span id="materialCeilingSmeta">Материалы</span>
    </div>
    <ul id="navs">
    </ul>
</div>
<div class="user">

    <button id="btn_get_href_client_save" class="sketch_hud btn btn-gm">Сохранить проект</button>
    <button id="btn_get_href_client" class="sketch_hud btn btn-gm">Отправить ссылку</button>
    <div id="resultUrlSmeta"></div>
    <div id="popup_canvas_user" style="display: block;">
        <center>
            Выберите фактуру:<br>
            <select id="select_facture_user" class="form-control inputbox"><option value="1">Мат</option><option value="2">Сатин</option><option value="3">Глянец</option><option value="6">Искры</option><option value="9">Перламутр</option><option value="10">Металлик</option><option value="15">Мечта</option><option value="16">Фантазия, Парча</option><option value="20">Хамелеон глянец</option><option value="21">Фактура</option><option value="22">Иллюзия</option><option value="23">Вдохновение, Весна, Кожа белые</option><option value="25">Ткань</option><option value="27">Штукатурка</option><option value="28">Небо на глянце</option><option value="29">Кружочки</option><option value="30">Шанжан (Фантазия)</option><option value="31">Бабочки</option><option value="32">Листочки</option><option value="33">Velur</option><option value="35">Весна</option></select><br>
            Выберите производителя:<br>
            <select id="select_manufacturer_user" class="form-control inputbox"><option value="4">MSD Classic(белые)</option><option value="3">MSD Premium(белые)</option><option value="2">MSD(цветные)</option><option value="10">MSD Evolution</option><option value="1">Longwei</option><option value="11">Teqtum</option><option value="13">Cold Stretch</option><option value="12">LumFer</option><option value="14">Folien</option></select><br>
            <button id="btn_okSelectCanvas_user" class="sketch_hud btn btn-gm">Ок</button>
            <button id="btn_cancelSelectCanvas_user" class="sketch_hud btn btn-gm">Отмена</button>
        </center>
    </div>
</div>

</div>
<div class="mains" style="display: block">
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
    <div id="popup_client_select_to" style="display: none;">
        <center>
            Выберите адрес:<br>

            <select id="get_select_client_to" class="form-control inputbox">


            </select><br>


            <button id="btn_select_client_to" class="sketch_hud btn btn-gm">Ок</button>
            <button id="btn_cancel_select_client_to" class="sketch_hud btn btn-gm">Отмена</button>
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
                <button class="sketch_hud btn btn-gm" id="btn_placel">Разместить люстру</button>

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




