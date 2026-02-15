<?php $reviews = $this->sql->query("SELECT * FROM `reviews` WHERE ban = '1' ORDER BY id DESC");?>

<div class="section s_otz_car">
    <div class="container">
        <div class="row">
            <div class="col-md-12  clearfix">
                <div class="ttl">Отзывы наших заказчиков</div>
                <div class="otz_carousel">
                    <?foreach ($reviews as $key=>$val):?>
                        <div class="item">
                            <div class="i_otz">
                                <img id="otz1" src="<?=IMG?>otz/otz.png" />
                            </div>
                            <div class="otz_name"><?=$val['name']?></div>
                            <div class="otz_prof">Заказал потолок в <?=COMPANY?></div>
                            <div class="otzyv">
                                <?=$val['txt']?>
                            </div>

                        </div>

                    <?endforeach;?>



                </div>

                <div class="otz_link">
                    <a href="<?=URL?>natyazhnyye-potolki-otzyvy">ВСЕ ОТЗЫВЫ</a>
                </div>
            </div>
        </div>
    </div>
</div>