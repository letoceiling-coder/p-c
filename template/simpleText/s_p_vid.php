<div class="section s_p_vid">
    <div class="container">
        <div class="row">
            <div class="col-sm-12  clearfix">
                <h1 class=""><?=$this->route["h1"];?></h1>
                <p class="light"><?=$this->route["p"]?></p>

                <div class="row">

                    <?foreach ($this->route["imgcountjson"] as $value):?>
                        <div class="col-md-6  clearfix">
                            <div class="p_img" itemscope="" itemtype="http://schema.org/ImageObject">
                                <div class="red_lenta"></div>
                                <meta itemprop="name" content="<?=$value["itempropName"]?>">
                                <meta itemprop="description" content="<?=$value["itempropDescription"]?>">
                                <img itemprop="contentUrl" alt="<?=$value["imgAlt"]?>" src="<?=IMG.$value["imgHref"]?>">
                            </div>
                        </div>
                    <?endforeach;?>





                </div>

            </div>
        </div>
    </div>
</div>