<?php

$city = $this->sql->query("SELECT  `adress` FROM `town` WHERE `domen_city`='".$this->town['domen_city']."'")[0]['adress'];

?>
<script>
    var town = '<?=$city?>'
</script>
<div class="section s_contacts">
    <div class="container">
        <div class="row">
            <div class="col-sm-12  clearfix">
                <div class="col-sm-7  clearfix">
                    <div class="c_adr">
                        <h1 itemprop="name" class="h1">Устанавливаем потолки в <?=$this->town['city-rus-rod']?><br> и <?=$this->town['rayon']?>!	</h1>		</div>
                </div>
                <div class="col-sm-5  clearfix">
                    <div class="c_time">
                        Работаем без выходных<br>8:00-23:00
                    </div>
                </div>
            </div>
        </div>
        <br>


    </div>
</div>
<div id="map"> </div>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="map-phone">
                Позвоните Нам по телефону <a class="comagic_phone" href="tel:<?=TEL?>" style="text-decoration:none;"><?=TEL?></a>
            </div>


        </div>
    </div>
</div>