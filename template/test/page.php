<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="/template/calc/css/all.min.css">
    <link rel="stylesheet" href="/template/calc/css/bootstrap.min.css">
    <link rel="stylesheet" href="/template/calc/css/noty.css">
    <link rel="stylesheet" href="/template/test/css/style.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js" ></script>
    <script type="text/javascript" src="/template/calc/js/noty.js"></script>
    <script type="text/javascript" src="/template/test/js/script.js"></script>

</head>
<body>

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
                <div class="col-xs-10  h-30">
                    <select class="form-control selectRoom">
                        <option selected="" value="65">Кухня</option>
                        <option value="5">Гостиная</option>
                    </select>
                </div>
                <div class="col-xs-2 flex-block h-30">
                    <span id="deliteCeiling"><img src="/template/client/images/icon/delite.png" style="width: 30px; "></span>

                </div>
            </div>
        </div>

        <div class="container images-block">
            <img id="slides" style="max-width: 100%;" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjE1NHB4IiB3aWR0aD0iNDAxcHgiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTM3OS44MTIwOSwtMTIyLjYpIiBmaWxsPSJub25lIiBmaWxsLXJ1bGU9Im5vbnplcm8iIHN0cm9rZT0ibm9uZSIgc3Ryb2tlLXdpZHRoPSJub25lIiBzdHJva2UtbGluZWNhcD0iYnV0dCIgc3Ryb2tlLWxpbmVqb2luPSJtaXRlciIgc3Ryb2tlLW1pdGVybGltaXQ9IjEwIiBzdHJva2UtZGFzaGFycmF5PSIiIHN0cm9rZS1kYXNob2Zmc2V0PSIwIiBmb250LWZhbWlseT0ibm9uZSIgZm9udC13ZWlnaHQ9Im5vbmUiIGZvbnQtc2l6ZT0ibm9uZSIgdGV4dC1hbmNob3I9Im5vbmUiIHN0eWxlPSJtaXgtYmxlbmQtbW9kZTogbm9ybWFsIj48cGF0aCBkPSJNNzcyLjE3LDI2OC4yaC0zODIiIGRhdGEtcGFwZXItZGF0YT0ieyZxdW90O2lzX3dhbGwmcXVvdDs6dHJ1ZSwmcXVvdDtkcmF3X3N0ZXAmcXVvdDs6MCwmcXVvdDtpZCZxdW90OzowLCZxdW90O2NvZWZfd2FsbF9rb3MmcXVvdDs6JnF1b3Q7MCZxdW90OywmcXVvdDtyYXp2X3dhbGxfa29zJnF1b3Q7OnsmcXVvdDtwMSZxdW90OzpbJnF1b3Q7UG9pbnQmcXVvdDssNzcwLDI3OF0sJnF1b3Q7cDImcXVvdDs6WyZxdW90O1BvaW50JnF1b3Q7LDM4OCwyNzhdfSwmcXVvdDtmaXhlZCZxdW90Ozp0cnVlLCZxdW90O3RleHQmcXVvdDs6WyZxdW90O1BvaW50VGV4dCZxdW90Oyx7JnF1b3Q7YXBwbHlNYXRyaXgmcXVvdDs6ZmFsc2UsJnF1b3Q7bWF0cml4JnF1b3Q7OlsxLDAsMCwxLDU4MS4xNywyNzIuNF0sJnF1b3Q7Y29udGVudCZxdW90OzomcXVvdDszODImcXVvdDssJnF1b3Q7Zm9udEZhbWlseSZxdW90OzomcXVvdDthcmlhbCZxdW90OywmcXVvdDtmb250V2VpZ2h0JnF1b3Q7OiZxdW90O2JvbGQmcXVvdDssJnF1b3Q7Zm9udFNpemUmcXVvdDs6MTQsJnF1b3Q7bGVhZGluZyZxdW90OzoxNi44LCZxdW90O2p1c3RpZmljYXRpb24mcXVvdDs6JnF1b3Q7Y2VudGVyJnF1b3Q7fV19IiBmaWxsLW9wYWNpdHk9IjAiIGZpbGw9IiMwMDAwMDAiIHN0cm9rZT0iIzAwODAwMCIgc3Ryb2tlLXdpZHRoPSIyIi8+PHBhdGggZD0iTTM5MC4xNywyNjguMmwwLjAxLC0xMzAiIGRhdGEtcGFwZXItZGF0YT0ieyZxdW90O2lzX3dhbGwmcXVvdDs6dHJ1ZSwmcXVvdDtkcmF3X3N0ZXAmcXVvdDs6MCwmcXVvdDtpZCZxdW90OzoxLCZxdW90O2NvZWZfd2FsbF9rb3MmcXVvdDs6JnF1b3Q7SW5maW5pdHkmcXVvdDssJnF1b3Q7cmF6dl93YWxsX2tvcyZxdW90Ozp7JnF1b3Q7cDEmcXVvdDs6WyZxdW90O1BvaW50JnF1b3Q7LDM5Mi45OCwyNTIuNl0sJnF1b3Q7cDImcXVvdDs6WyZxdW90O1BvaW50JnF1b3Q7LDM5Mi45OCwxMjIuNl19LCZxdW90O2ZpeGVkJnF1b3Q7OnRydWUsJnF1b3Q7dGV4dCZxdW90OzpbJnF1b3Q7UG9pbnRUZXh0JnF1b3Q7LHsmcXVvdDthcHBseU1hdHJpeCZxdW90OzpmYWxzZSwmcXVvdDttYXRyaXgmcXVvdDs6WzAuMDAwMDgsLTEsMSwwLjAwMDA4LDM5NC4zNzUsMjAzLjIwMDMyXSwmcXVvdDtjb250ZW50JnF1b3Q7OiZxdW90OzEzMCZxdW90OywmcXVvdDtmb250RmFtaWx5JnF1b3Q7OiZxdW90O2FyaWFsJnF1b3Q7LCZxdW90O2ZvbnRXZWlnaHQmcXVvdDs6JnF1b3Q7Ym9sZCZxdW90OywmcXVvdDtmb250U2l6ZSZxdW90OzoxNCwmcXVvdDtsZWFkaW5nJnF1b3Q7OjE2LjgsJnF1b3Q7anVzdGlmaWNhdGlvbiZxdW90OzomcXVvdDtjZW50ZXImcXVvdDt9XX0iIGZpbGwtb3BhY2l0eT0iMCIgZmlsbD0iIzAwMDAwMCIgc3Ryb2tlPSIjMDA4MDAwIiBzdHJva2Utd2lkdGg9IjIiLz48cGF0aCBkPSJNMzkwLjE4LDEzOC4yaDM4MiIgZGF0YS1wYXBlci1kYXRhPSJ7JnF1b3Q7aXNfd2FsbCZxdW90Ozp0cnVlLCZxdW90O2RyYXdfc3RlcCZxdW90OzoxLCZxdW90O2lkJnF1b3Q7OjIsJnF1b3Q7Zml4ZWQmcXVvdDs6dHJ1ZSwmcXVvdDt0ZXh0JnF1b3Q7OlsmcXVvdDtQb2ludFRleHQmcXVvdDsseyZxdW90O2FwcGx5TWF0cml4JnF1b3Q7OmZhbHNlLCZxdW90O21hdHJpeCZxdW90OzpbMSwwLDAsMSw1ODEuMTgsMTQyLjRdLCZxdW90O2NvbnRlbnQmcXVvdDs6JnF1b3Q7MzgyJnF1b3Q7LCZxdW90O2ZvbnRGYW1pbHkmcXVvdDs6JnF1b3Q7YXJpYWwmcXVvdDssJnF1b3Q7Zm9udFdlaWdodCZxdW90OzomcXVvdDtib2xkJnF1b3Q7LCZxdW90O2ZvbnRTaXplJnF1b3Q7OjE0LCZxdW90O2xlYWRpbmcmcXVvdDs6MTYuOCwmcXVvdDtqdXN0aWZpY2F0aW9uJnF1b3Q7OiZxdW90O2NlbnRlciZxdW90O31dfSIgZmlsbC1vcGFjaXR5PSIwIiBmaWxsPSIjMDAwMDAwIiBzdHJva2U9IiMwMDgwMDAiIHN0cm9rZS13aWR0aD0iMiIvPjxwYXRoIGQ9Ik03NzIuMTgsMTM4LjJsLTAuMDEsMTMwIiBkYXRhLXBhcGVyLWRhdGE9InsmcXVvdDtpc193YWxsJnF1b3Q7OnRydWUsJnF1b3Q7ZHJhd19zdGVwJnF1b3Q7OjEsJnF1b3Q7aWQmcXVvdDs6MywmcXVvdDtmaXhlZCZxdW90Ozp0cnVlLCZxdW90O3RleHQmcXVvdDs6WyZxdW90O1BvaW50VGV4dCZxdW90Oyx7JnF1b3Q7YXBwbHlNYXRyaXgmcXVvdDs6ZmFsc2UsJnF1b3Q7bWF0cml4JnF1b3Q7OlswLjAwMDA4LC0xLDEsMC4wMDAwOCw3NzYuMzc1LDIwMy4yMDAzMl0sJnF1b3Q7Y29udGVudCZxdW90OzomcXVvdDsxMzAmcXVvdDssJnF1b3Q7Zm9udEZhbWlseSZxdW90OzomcXVvdDthcmlhbCZxdW90OywmcXVvdDtmb250V2VpZ2h0JnF1b3Q7OiZxdW90O2JvbGQmcXVvdDssJnF1b3Q7Zm9udFNpemUmcXVvdDs6MTQsJnF1b3Q7bGVhZGluZyZxdW90OzoxNi44LCZxdW90O2p1c3RpZmljYXRpb24mcXVvdDs6JnF1b3Q7Y2VudGVyJnF1b3Q7fV19IiBmaWxsLW9wYWNpdHk9IjAiIGZpbGw9IiMwMDAwMDAiIHN0cm9rZT0iIzAwODAwMCIgc3Ryb2tlLXdpZHRoPSIyIi8+PHBhdGggZD0iTTc3Mi4xNywyNjguMmwtMzgxLjk5LC0xMzAiIGRhdGEtcGFwZXItZGF0YT0ieyZxdW90O2NvdW50TmVhcldhbGxzJnF1b3Q7OjQsJnF1b3Q7Y291bnROZWFyRGlhZ3MmcXVvdDs6MCwmcXVvdDtmaXhlZCZxdW90Ozp0cnVlLCZxdW90O3RleHQmcXVvdDs6WyZxdW90O1BvaW50VGV4dCZxdW90Oyx7JnF1b3Q7YXBwbHlNYXRyaXgmcXVvdDs6ZmFsc2UsJnF1b3Q7bWF0cml4JnF1b3Q7OlswLjk0NjY4LDAuMzIyMTgsLTAuMzIyMTgsMC45NDY2OCw1ODAuMDE1MTYsMjA2LjYwODA1XSwmcXVvdDtjb250ZW50JnF1b3Q7OiZxdW90OzQwMy41JnF1b3Q7LCZxdW90O2ZvbnRGYW1pbHkmcXVvdDs6JnF1b3Q7dGltZXMmcXVvdDssJnF1b3Q7Zm9udFdlaWdodCZxdW90OzomcXVvdDtib2xkJnF1b3Q7LCZxdW90O2p1c3RpZmljYXRpb24mcXVvdDs6JnF1b3Q7Y2VudGVyJnF1b3Q7fV19IiBmaWxsLW9wYWNpdHk9IjAiIGZpbGw9IiMwMDAwMDAiIHN0cm9rZT0iIzAwODAwMCIgc3Ryb2tlLXdpZHRoPSIxIi8+PHRleHQgeD0iMzg0LjE3IiB5PSIyNjUuMiIgZGF0YS1wYXBlci1kYXRhPSJ7JnF1b3Q7aWRfbGluZTEmcXVvdDs6MCwmcXVvdDtpZF9saW5lMiZxdW90OzoxfSIgZmlsbD0iIzAwMDBmZiIgc3Ryb2tlPSJub25lIiBzdHJva2Utd2lkdGg9IjEiIGZvbnQtZmFtaWx5PSJsdWNpZGEgY29uc29sZSIgZm9udC13ZWlnaHQ9ImJvbGQiIGZvbnQtc2l6ZT0iMTQiIHRleHQtYW5jaG9yPSJtaWRkbGUiPkQ8L3RleHQ+PHRleHQgeD0iNzY2LjE3IiB5PSIyNjUuMiIgZGF0YS1wYXBlci1kYXRhPSJ7JnF1b3Q7aWRfbGluZTEmcXVvdDs6MCwmcXVvdDtpZF9saW5lMiZxdW90OzozfSIgZmlsbD0iIzAwMDBmZiIgc3Ryb2tlPSJub25lIiBzdHJva2Utd2lkdGg9IjEiIGZvbnQtZmFtaWx5PSJsdWNpZGEgY29uc29sZSIgZm9udC13ZWlnaHQ9ImJvbGQiIGZvbnQtc2l6ZT0iMTQiIHRleHQtYW5jaG9yPSJtaWRkbGUiPkM8L3RleHQ+PHRleHQgeD0iNzY2LjE4IiB5PSIxMzUuMiIgZGF0YS1wYXBlci1kYXRhPSJ7JnF1b3Q7aWRfbGluZTEmcXVvdDs6MiwmcXVvdDtpZF9saW5lMiZxdW90OzozfSIgZmlsbD0iIzAwMDBmZiIgc3Ryb2tlPSJub25lIiBzdHJva2Utd2lkdGg9IjEiIGZvbnQtZmFtaWx5PSJsdWNpZGEgY29uc29sZSIgZm9udC13ZWlnaHQ9ImJvbGQiIGZvbnQtc2l6ZT0iMTQiIHRleHQtYW5jaG9yPSJtaWRkbGUiPkI8L3RleHQ+PHRleHQgeD0iMzg0LjE4IiB5PSIxMzUuMiIgZGF0YS1wYXBlci1kYXRhPSJ7JnF1b3Q7aWRfbGluZTEmcXVvdDs6MSwmcXVvdDtpZF9saW5lMiZxdW90OzoyfSIgZmlsbD0iIzAwMDBmZiIgc3Ryb2tlPSJub25lIiBzdHJva2Utd2lkdGg9IjEiIGZvbnQtZmFtaWx5PSJsdWNpZGEgY29uc29sZSIgZm9udC13ZWlnaHQ9ImJvbGQiIGZvbnQtc2l6ZT0iMTQiIHRleHQtYW5jaG9yPSJtaWRkbGUiPkE8L3RleHQ+PHRleHQgeD0iNjE1LjY1Mjc5IiB5PSI4LjcyNDE0IiB0cmFuc2Zvcm09InJvdGF0ZSgxOC43OTQ2MikiIGZpbGw9IiMwMDAwMDAiIHN0cm9rZT0ibm9uZSIgc3Ryb2tlLXdpZHRoPSIxIiBmb250LWZhbWlseT0idGltZXMiIGZvbnQtd2VpZ2h0PSJib2xkIiBmb250LXNpemU9IjEyIiB0ZXh0LWFuY2hvcj0ibWlkZGxlIj40MDMuNTwvdGV4dD48dGV4dCB4PSItMjAzLjE0MDYiIHk9Ijc3Ni4zOTA2MyIgdHJhbnNmb3JtPSJyb3RhdGUoLTg5Ljk5NTU5KSIgZmlsbD0iIzAwMDAwMCIgc3Ryb2tlPSJub25lIiBzdHJva2Utd2lkdGg9IjEiIGZvbnQtZmFtaWx5PSJhcmlhbCIgZm9udC13ZWlnaHQ9ImJvbGQiIGZvbnQtc2l6ZT0iMTQiIHRleHQtYW5jaG9yPSJtaWRkbGUiPjEzMDwvdGV4dD48dGV4dCB4PSI1ODEuMTgiIHk9IjE0Mi40IiBmaWxsPSIjMDAwMDAwIiBzdHJva2U9Im5vbmUiIHN0cm9rZS13aWR0aD0iMSIgZm9udC1mYW1pbHk9ImFyaWFsIiBmb250LXdlaWdodD0iYm9sZCIgZm9udC1zaXplPSIxNCIgdGV4dC1hbmNob3I9Im1pZGRsZSI+MzgyPC90ZXh0Pjx0ZXh0IHg9Ii0yMDMuMTY5OTkiIHk9IjM5NC4zOTA2MyIgdHJhbnNmb3JtPSJyb3RhdGUoLTg5Ljk5NTU5KSIgZmlsbD0iIzAwMDAwMCIgc3Ryb2tlPSJub25lIiBzdHJva2Utd2lkdGg9IjEiIGZvbnQtZmFtaWx5PSJhcmlhbCIgZm9udC13ZWlnaHQ9ImJvbGQiIGZvbnQtc2l6ZT0iMTQiIHRleHQtYW5jaG9yPSJtaWRkbGUiPjEzMDwvdGV4dD48dGV4dCB4PSI1ODEuMTciIHk9IjI3Mi40IiBmaWxsPSIjMDAwMDAwIiBzdHJva2U9Im5vbmUiIHN0cm9rZS13aWR0aD0iMSIgZm9udC1mYW1pbHk9ImFyaWFsIiBmb250LXdlaWdodD0iYm9sZCIgZm9udC1zaXplPSIxNCIgdGV4dC1hbmNob3I9Im1pZGRsZSI+MzgyPC90ZXh0PjwvZz48L3N2Zz4=">
        </div>

        <div class="container-fluid hr"></div>

        <div class=" container specification-block">
            <div>
                Стороны:
                <table class="table-striped">
                    <tbody id="table-walls"><tr><td>CD</td><td>382.0</td></tr><tr><td>AD</td><td>130.0</td></tr><tr><td>AB</td><td>382.0</td></tr><tr><td>BC</td><td>130.0</td></tr></tbody>
                </table>
            </div>
            <div>
                Диагонали:
                <table class="table-striped">
                    <tbody id="table-diags"><tr><td>AC</td><td>403.5</td></tr></tbody>
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
                        <td>Кол-во углов (шт.):</td><td><span id="angles_result" readonly="" tabindex="-1">4</span></td>
                    </tr>
                    <tr>
                        <td>Периметр (м.):</td><td><span id="perimeter_result" readonly="" tabindex="-1">10.24</span></td>
                    </tr>
                    <tr>
                        <td>Площадь (м<sup>2</sup>.):</td><td><span id="area_result" readonly="" tabindex="-1">4.97</span></td>
                    </tr>
                    <tr>
                        <td>Криволинейность (м.):</td><td><span id="curvilinear_result" readonly="" tabindex="-1">0</span></td>
                    </tr>
                    <tr>
                        <td>Внутренний вырез (м.):</td><td><span id="inner_cutout_length" readonly="" tabindex="-1">0</span></td>
                    </tr>
                    <tr>
                        <td>Цвет:</td><td><span id="color_id" readonly="" tabindex="-1">303</span></td>
                    </tr>
                    <tr>
                        <td>Производитель:</td><td><span id="manufacturer_id" readonly="" tabindex="-1">MSD Classic(белые)</span></td>
                    </tr>
                    <tr>
                        <td>Фактура:</td><td><span id="texture_id" readonly="" tabindex="-1">Мат</span></td>
                    </tr>
                    <tr>
                        <td>Ширина материала:</td><td><span id="width_final" readonly="" tabindex="-1">360</span></td>
                    </tr>
                    </tbody>
                </table>
            </div>



        </div>
    </div>
    <div id="main-2">
        <p>main-2</p>
    </div>
    <div id="main-3">
        <p>main-3</p>
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
        <div class="container select-block ">
            <div class="row">
                <div class="col-xs-10  h-30">
                    <select class="form-control selectRoom">
                        <option selected="" value="65">Кухня</option>
                        <option value="5">Гостиная</option>
                    </select>
                </div>
                <div class="col-xs-2 flex-block h-30">
                    <span id="deliteCeiling"><img src="/template/client/images/icon/delite.png" style="width: 30px; "></span>

                </div>
            </div>

        </div>
        <div class="container">
            <div class="row table-smeta">
                <div class="col-xs-6 left flex-block h-50">
                    <img id="logoImg"  src="/template/client/images/logoCompany/logo.png" alt="">
                </div>
                <div class="col-xs-6">
                    <div class="row right flex-block h-50">
                        <div class="col-xs-12 fz-10 ">
                            <span>Компания: <span id="name-company">Proffi Center</span></span>
                        </div>
                        <div class="col-xs-12 fz-10">
                            <span>Адрес:<span id="name-company-adress">ул. Омелькова 20 к1</span></span>
                        </div>
                        <div class="col-xs-12 fz-10">
                            <span>Телефон:<span id="name-company-phone">78888888888</span></span>
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
                            <span>Номер заказа № <span id="number_order"> <a href="/client/1-30-1">1-30-1/1</a></span></span>
                        </div>
                        <div class="col-xs-12 fz-10">
                            <span>Клиент: <span id="client-smeta">Игорь</span></span>
                        </div>
                        <div class="col-xs-12 fz-10">
                            <span>Адрес: <span id="client-adress-smeta">Владимировская 144 кв 5</span></span>
                        </div>
                        <div class="col-xs-12 fz-10">
                            <span>Телефон: <span id="client-phone-smeta">+7 (999) 637-11-82</span></span>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="row right flex-block h-50">
                        <div class="col-xs-12 fz-10 ">
                            <span>Компания: <span> Дата заказа:</span></span>
                        </div>
                        <div class="col-xs-12 fz-10">
                            <span id="days">Четверг 16.02.2023</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="main-5">
        <p>main-5</p>
    </div>
    <div id="main-6">
        <p>main-6</p>
    </div>


</div>
</body>
</html>
