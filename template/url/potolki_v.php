<?php $cards = $this->sql->query("SELECT * FROM `product_card` WHERE link = '".$this->urlArray[0]."'")?>
<div class="section s_p_vid">
    <div class="container">
        <div class="row">
            <div class="col-sm-12  clearfix">
                <h1 class=""><?=$this->route["h1"]?></h1>
                <p class="light">
                    <?=$this->route["p"]?>
                </p>
                <div class="row">
                    <?php $card = json_decode($this->route["img_count_json"],true);?>

                    <?php foreach ($card as $key=>$val):?>

                        <div class="col-md-6  clearfix">

                            <div class="p_img" itemscope itemtype="http://schema.org/ImageObject">
                                <div class="red_lenta"></div>
                                <meta itemprop="name" content="<?=$val["imgHref"]?>">
                                <meta itemprop="description" content="<?=$val["itempropDescription"]?>">
                                <img itemprop="contentUrl" alt="<?=$val["imgAlt"]?>" src="<?=IMG.$val["imgHref"]?>">
                            </div>
                        </div>


                    <?php endforeach;?>


                </div>
            </div>
        </div>
    </div>
</div>


<?
include SECTION."s_minicalc.php";


include SECTION."s_form_lowprice.php";
include SECTION."s_zamer.php";
include SECTION."s_simple_text.php";
include SECTION."s_form5min.php";
include SECTION."s25.php";
include SECTION."s30.php";
include SECTION."s_otz_car.php";
include SECTION."s_gallery.php";
?>