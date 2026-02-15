<?php ?>
<div class="section s_potolok">
    <div class="container">
        <div class="row">
            <div class="col-sm-12  clearfix">
                <div class="potolok_block clearfix" itemscope itemtype="http://schema.org/Product">
                    <!--    <div class="red_lenta2"></div> -->
                    <div itemprop="name"> <h1><?=$this->pages["h3"]?></h1></div>
                    <div class="col-lg-7">
                        <div class="c_border1" itemprop="image">
                            <meta itemprop="image" content="<?=IMG.$this->pages["img_path"]?>" />
                            <meta itemprop="brand" content="<?=$this->pages["brend"]?>" />
                            <img src="<?=IMG.$this->pages["img_path"]?>" title="<?=$this->pages["h3"]?>">
                        </div>
                    </div>
                    <div class=" col-lg-5">
                        <div class="m_sub ">
                            <div class="i_art">
                                Артикул:
                                <span>Л-<?=$this->pages["id"]?></span>
                            </div>
                            <div class="razmer">Размер: 100x100 см</div>

                            <div class="clearfix" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                <div class="old_price" itemprop="price"><div class="red_line"></div><?=$this->pages["price"]?><span> руб.</span></div>
                                <meta itemprop="priceCurrency" content="RUB">
                                <div class="current_price"><?=$this->pages["current_price"]?><span> руб.</span></div>
                            </div>
                            <p class="light" itemprop="description">
                                <?=$this->str_transformations($this->pages["description"],$this->town)?>
                            </p>
                            <img class="p_features" src="<?=IMG?>potolok_f.png">
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-sm-12  clearfix">
                <div class="potolok_info">
                    <div class="i_options clearfix">

                        <div class="col-sm-6 clearfix">
                            <div class="info_block clearfix">
                                <div class="z_block_img">
                                    <img src="<?=IMG?>ii1.png">
                                </div>
                                <div class="z_block_txt" style="width: 293px; margin:0 auto;">
                                    <p class="ph">Как оплатить:</p>
                                    <p class="ph1"><span>Предоплата составляет 100%</span><br>
                                        Оплата производится в центральном<br>
                                        офисе компании “<?=COMPANY?>”.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 clearfix">
                            <div class="info_block clearfix">
                                <div class="z_block_img">
                                    <img src="<?=IMG?>ii2.png">
                                </div>
                                <div class="z_block_txt" style="width: 293px; margin:0 auto;">
                                    <p class="ph">Как забрать потолки:</p>
                                    <p class="ph1"><span>Самовывоз бесплатно.</span><br>
                                        Доставка в пределах <?=$this->town["city-rus-is"]?> 0 руб.<br>
                                        За пределы +10 руб. за каждый км.
                                    </p>
                                </div>
                            </div>
                        </div>


                    </div>


                    <div class=" tovar_zakaz clearfix">
                        <h2>Оформить заказ</h2>
                        <p class="sub_text"><?=$this->pages["h3"].' code-'.$this->pages["id"]?></p>
                        <div class="razmetka1">
                            <div class="low_name">
                                <input class="t_name" type="text" placeholder="Ваше имя" value="">
                            </div>
                            <div class="low_tel">
                                <input class="t_tel" type="text" placeholder="Телефон" value="">
                            </div>
                            <div class="low_adress">
                                <input class="t_email" type="text" placeholder="E-mail" value="">
                            </div>
                        </div>
                        <input class="t_art" type="hidden" value="<?='code-'.$this->pages["id"]?>">
                        <input class="t_id" type="hidden" value="1">

                        <div class="razmetka2">
                            <div class="low_text">
                                <textarea class="t_txt"></textarea>
                            </div>
                            <div class="blue_btn">
                                <a id="tovar_zakaz" class="">Отправить заявку</a>
                            </div>
                        </div>

                    </div>
                    <div class="prav-info clearfix">Вписывая телефон, вы подтверждаете свое совершеннолетие, соглашаетесь на обработку персональных данных в&nbsp;соответствии с
                        <a href="<?=IMG?>prav-info.pdf" class="b-link" onclick="newMyWindow(this.href); return false;">Правовой&nbsp;информацией</a>
                    </div>


                </div>

            </div>

        </div>
    </div>
</div>

<?php include SECTION."s8.php";?>