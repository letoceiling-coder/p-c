<div id="maps" style="display: none"></div>

<div class=" tovar_zakaz clearfix" id="getnewclient">
    <h2 >Новый клиент</h2>
    <div id="result"></div>
    <div class="razmetka11">
        <div class="low_name ">
            <input class="t_name "  type="text" placeholder="Имя клиента" value="">


        </div>
        <div class="low_tel">
            <input class="t_tel" name="phone"
                   pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
                   required placeholder="Телефон" value="">
        </div>
        <div class="low_adress">
            <input class="t_adress" id="low_name" type="text" placeholder="Адрес" value="">
            <div class="result">

            </div>
        </div>
    </div>

    <div class="blue_btn_">

        <a id="zayavka_client"  onclick="return false" class="">Создать контрагента</a>
    </div>
</div>
<script src="<?=JS?>ymaps.js"></script>