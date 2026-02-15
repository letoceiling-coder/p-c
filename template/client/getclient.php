<div class="contener ">
    <div class="client-head">
        <a href="" onclick="return false"><span id="value-client">Выбрать контрагента:</span></a>
        <ul class="client-hide client-newblock">
            <?php foreach ($this->route as $value):?>
                <li><a href="/client/smeta/<?=$value["id"]?>" data-adress="<?=$value["phone"]?> data-adress="<?=$value["adress"]?>"><?=$value["name"]?></a></li>
            <?php endforeach;?>
        </ul>
        <a href="/client/new"><span class="slesh">Новый контрагент:</span></a>
    </div>
</div>

