<?php
$i = 0;
$type = 0;
$types_of_work = $this->sql->query("SELECT `types_of_work`.*,`groups`.`name` as groupsname, `groups`.`class_name` as groupsclassname FROM `types_of_work` LEFT JOIN `groups` ON `groups`.`id` = `types_of_work`.`group_id`");
$manufacture = $this->sql->query("SELECT * FROM `manufacture`");
$groups = $this->sql->query("SELECT * FROM `groups`");
$material = $this->sql->query("SELECT * FROM `material`");
$room = $this->sql->query("SELECT * FROM `room`");
$rooms = $this->sql->query("SELECT * FROM `price_smeta` WHERE `id_client`= '".$this->urlArray[2]."'");
$sides = json_decode($this->route[0]["sides"],true);
$diags = json_decode($this->route[0]["diags"],true);
$client = $this->sql->query("SELECT * FROM `client` WHERE `id`=".$this->urlArray[2])[0];
$types_of_work_id = json_decode($this->route[0]["types_of_work"],true);

?>
<div class="contenner">
    <div class="row">
        <span class="spanClient_">Клиент: </span><span class="spanClient"><?=$client["name"]?></span>
    </div>
    <div class="row">
        <span class="spanClient_">Телефон: </span><span class="spanClient"><a href="tel:<?=$client["phone"]?>"><?=$client["phone"]?></a></span>

    </div>
    <div class="row">
        <span class="spanClient_">Адрес:</span><span class="spanClient"><?=$client["adress"]?></span>
    </div>

</div>
<input type="hidden" id="client_id" value="<?=$this->urlArray[2]?>">
<input type="hidden" id="id_rooms" value="<?=$this->urlArray[3]?>">

<?php if (is_array($this->route)):?>

    <?php foreach ($this->route as $key=>$value):?>

<div class="contener ">
    <div class="client-head">
    <div class="row">

            <div class="flex newType">



                <div class="flexrow">
                    <p>Room:</p>
                    <div>
                        <select  class="" id="Room" name="Room">



<?php if ($this->urlArray[3]== '0'):?>
    <?php foreach ($room as $valueRoom):?>

                                    <option  value="<?=$valueRoom["id"]?>"><?=$valueRoom["name"]?></option>

    <?php endforeach;?>
<?php else:?>

    <?php foreach ($rooms as $valueRooms):?>

    <?php foreach ($room as $k=>$v):?>

                    <?php if ($valueRooms['id_room'] == $v['id'] ):?>

                        <?php if ($this->urlArray[3] == $valueRooms["id"]):?>
                           <option  selected value="<?=$valueRooms["id"]?>"><?=$v["name"]?></option>

                        <?php else:?>
                           <option  value="<?=$valueRooms["id"]?>"><?=$v["name"]?></option>
                        <?php endif;?>
                     <?php endif;?>

    <?php endforeach;?>



    <?php endforeach;?>
<?php endif;?>


                        </select>
                    </div>
                </div>
                <form method="post" id="form_smeta_">
                <div class="flexrow">
                    <p>Brend:</p>
                    <div>
                        <select  class="smeta_select_" id="manufacture" name="manufacture">
                            <option value="0">BREND</option>
                        <?php foreach ($manufacture as $val):?>
                        <?php if ($value["id_manufacture"] == $val["id"]):?>
                            <option selected value="<?=$val['id']?>"><?=$val['name']?></option>
                        <?php else:?>
                            <option value="<?=$val['id']?>"><?=$val['name']?></option>
                        <?php endif;?>

                        <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="flexrow">
                    <p>Facture:</p>
                    <div>
                        <select  class="smeta_select_" id="material" name="material">
                            <option value="0">FACTURE</option>
                        <?php foreach ($material as $val):?>
                        <?php if ($value["id_material"] == $val["id"]):?>
                            <option selected value="<?=$val['id']?>"><?=$val['name']?></option>
                        <?php else:?>
                            <option value="<?=$val['id']?>"><?=$val['name']?></option>
                        <?php endif;?>
                        <?php endforeach;?>
                        </select>
                    </div>
                </div>




                        <?php foreach ($groups as $v):?>
                    <div class="flexrow ">
                    <p><?=$v['name']?>:</p>
                    <div class="">
                        <select  class="smeta_row" >
                            <option value="0"><?=$v['name']?></option>
                            <?php foreach ($types_of_work as $val):?>


                             <?php if ($v['id'] == $val['group_id']):?>


                                    <option  value="<?=$val['id']?>"><?=$val['name']?></option>

                                <?php endif;?>
                            <?php endforeach;?>
                        </select>
                    </div>
                    </div>
                        <?php endforeach;?>


                    </div>
                    <img id="newmaterial" src="<?=IMG?>news.png" alt="">
                </div>
                <input type="hidden" name="hidden_id_work" id="clientId" value="<?=$client["id"]?>">

                <? if(is_array($types_of_work_id)):?>
                <?php foreach ($types_of_work_id as $key=>$val):?>
                        <div class="flexrows border">
                            <?php foreach ($types_of_work as $k=>$v):?>
                            <? if($v["id"] == $key):?>
                            <p><?=$types_of_work[$k]['name']?></p>

                                    <div><input class="smeta_row update" type="number" name="id-<?=$types_of_work[$k]['id']?>" value="<?=$types_of_work_id[$key][0]?>"></div>
                                    <div><input class="smeta_row update" type="number" name="price-<?=$types_of_work[$k]['id']?>" value="<?=$types_of_work_id[$key][1]?>"></div>
                            <? endif;?>
                            <? endforeach;?>

                        </div>
                <? endforeach;?>
                <? endif;?>

        </form>
    </div>
        <div class="row">
            <div class="flexrow">
                <button onclick="return false" id="saveType">Сохранить</button>
                <button onclick="return false" id="newpotolok">Добавить потолок</button>
            </div>

        </div>
        <div class="row images">
            <img src="<?=$this->route[0]["img"]?>" alt="logo">
        </div>





    <div class="result-length-container">
    <div>
    Контур (см.)
    <table>
    <tbody id="table-walls">
    <?php foreach($sides as $key=>$value):?>
    <tr>
        <td><?=$value["name"]?></td>
        <td><?=$value["length"]?></td>
    </tr>
    <?php endforeach;?>
    </tbody>
    </table>
    </div>
    <div>
    Диагонали (см.)
    <table>
    <tbody id="table-diags">
    <?php foreach($diags as $key=>$value):?>
        <tr>
            <td><?=$value["name"]?></td>
            <td><?=$value["length"]?></td>
        </tr>
    <?php endforeach;?>
    </tbody>
    </table>
    </div>
    </div>
    <div class="div-result-final">
    <table>
    <tr>
    <td>Кол-во углов (шт.):</td><td><span id="angles_result" readonly tabindex="-1"><?=$this->route[0]["angles"]?></span></td>
    </tr>
    <tr>
    <td>Периметр (м.):</td><td><span id="perimeter_result" readonly tabindex="-1"><?=$this->route[0]["perimeter"]?></span></td>
    </tr>
    <tr>
    <td>Площадь (м<sup>2</sup>.):</td><td><span id="area_result" readonly tabindex="-1"><?=$this->route[0]["area"]?></span></td>
    </tr>
    <tr>
    <td>Криволинейность (м.):</td><td><span id="curvilinear_result" readonly tabindex="-1"><?=$this->route[0]["curvilinear"]?></span></td>
    </tr>
    </table>

    </div>

    <div id="result_">
    </div>
    </div>
</div>
    <?php endforeach;?>
<?php else:?>

<?php endif;?>
