<div class="section s_gallery gallerry_page">
    <div class="container">
        <div class="row">
            <div class="col-sm-12  clearfix">

                <div class="carousel-gallery2" style="width:90%;margin:0 auto;">

                    <?foreach($this->route["gallerryjson"] as $key=>$val):?>
                        <div class="item" >
                            <img  src="<?=IMG.$val[0]?>" alt="<?=$val[1]?>"/>

                        </div>
                    <?endforeach;?>



                </div>


            </div>
        </div>
    </div>
</div>
