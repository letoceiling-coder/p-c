<?php
$orders = $this->sql->query("SELECT * FROM `orders`" )[0]["orders"];

$determine_month =  date('m', strtotime('last month'));

$array = array('01'=>'Январе','02'=>'Феврале','03'=>'Марте','04'=>'Апреле','05'=>'Мае','06'=>'Июне','07'=>'Июле','08'=>'Августе','09'=>'Сентябре','10'=>'Октябре','11'=>'Ноябре','12'=>'Декабре');

$key = $array[$determine_month];
?>

<div class="section s_zakazalo">
    <div class="container">
        <div class="row">
            <div class="col-md-12  clearfix">

                <div class="y_label">В <?=$key?><br>потолки<br>заказали<br><?=$orders?> человек!</div>
                <div class="z_blocks">
                    <div class="z_block">Будут<br>рекомендовать<br><img src="<?=IMG?>r1.png"><br><span>87%</span> </div>
                    <div class="z_block">Возможно будут<br>рекомендовать<br><img src="<?=IMG?>r2.png"><br><span>12%</span></div>
                    <div class="z_block">Не готовы<br>рекомендовать<br><img src="<?=IMG?>r3.png"><br><span>1%</span></div>
                </div>


            </div>
        </div>
    </div>
</div>