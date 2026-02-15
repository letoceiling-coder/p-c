<div class="section s_p_vid">
    <div class="container">
        <div class="row">
            <div class="col-sm-12  clearfix">
                <h1 class=""><?=$this->route["block2_h2"];?></h1>
                <p class="light"><?=$this->route["block2_p"]?></p>

                <div class="row">



                    <?foreach ($this->route["gallerryjson2"] as $v):?>
                        <div class="col-md-6  clearfix">
                            <div class="p_img rell" itemscope="" itemtype="http://schema.org/ImageObject">
                                <div class="red_lenta"></div>
                                <meta itemprop="name" content="<?=$v["itempropName"]?>">
                                <meta itemprop="description" content="<?=$v["itempropDescription"]?>">
                                <img itemprop="contentUrl" alt="<?=$v["imgAlt"]?>" src="<?=IMG.$v["imgHref"]?>">
                                <p data-text="<?=$v["p"]?> <br> <?=$v["price"]?>"><?=$v["p"]?> <br> <?=$v["price"]?></p>
                            </div>
                        </div>
                    <?endforeach;?>





                </div>

            </div>
        </div>
    </div>
</div>