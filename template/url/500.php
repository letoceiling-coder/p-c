<div id="popup12" class="popup1">
    <script>
        $(document).ready(function () {
            $('#popup12').show();
            $(".pop_tel1").inputmask("+7 (999) 999-99-99");
        })

    </script>
    <div class="header ">Доступ запрещен!</div>
    <div class="header_sub">
        <p>С сожалением сообщаем что <br>ваш ip адрес <?=$ip?> был заблокирован <br>нашей системой безопасности</p>
        <p>Иногда это происходит из-за излишней агрессивности нашей системы обнаружения угроз безопасности если это не так нам очень жаль, и мы поможем Вам разблокировать Ваш IP-адрес как можно скорее.</p>
    </div>
    <style>
        .superbutton {
            width:150px;
            height:40px;
            border-radius:20px;
            background:#459DE5;
            color:#fff;
            font-size:18px;
            cursor:pointer;
            z-index: 9999;
            margin: 10px;
        }
        .superbutton:hover{
            background:#358DE5;
        }
        . superbutton:focus{
            outline:none;
        }
    </style>
    <form method="post">
        <input type="hidden" class="pop_type" name="ip" value="<?=$ip?>">
        <div class="razmetka1">
            <div class="low_name">
                <input class="pop_name1" type="text" name="name" placeholder="Ваше имя" value="">
            </div>
        </div>
        <div class="razmetka1">
            <div class="low_tel">
                <input class="pop_tel1" type="text" name="phone" placeholder="Телефон" value="">
            </div>
        </div>


        <div >
            <input type="submit" onclick="return false" class="superbutton" name="checkusers" value="Жду звонка" />
        </div>
    </form>
</div>