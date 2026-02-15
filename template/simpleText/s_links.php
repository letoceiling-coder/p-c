<?php if($this->admin):?>
<div id="popupadmin" class="popup1" style="display: none">
    <div id="btn-close1" class="f-close"> </div>

    <div class="header_sub">Изменение контента</div>

    <input type="hidden" id="pathTable" value="<?=$this->pathTable?>">
    <input type="hidden" id="template" value="<?=$this->template?>">
    <div class="razmetka1" id="editAdmin">

    </div>

    <div class="blue_btn">
        <a id="btn_popupadmin">Изменить</a>
    </div>

</div>

<?php endif;?>
<div class="section s_ind_banner">
    <div class="container">
        <div class="row">
            <div class="col-sm-12  clearfix">
                <div class="wooman">
                </div>
                <div class="i_banner" contenedit="img"  data_route="jsons_template:bg_baner" style="background-image: url(<?=$this->route['jsons_template']['bg_baner'] ? $this->route['jsons_template']['bg_baner'] : '/template/globalTemplate/images/index_banner.jpg'?>) ">
                    <div class="i_act">
                        <div class="np">
                            <strong>Натяжной потолок</strong>
                        </div>
                        <div class="za">
                            за
                        </div>

                        <div class="r99" contenedit="num" data_route="jsons_template:priceBaner">
                            <?=$this->route['jsons_template']['priceBaner']?>
                            <span>руб.</span>

                        </div>
                        <div class="tolko" id="tolko">Распродажа до 21 декабря</div>
                    </div>

                    <script>
                        function echo_date( date ){
                            var days = ["воскресение","понедельник","вторник","среда","четверг","пятница","суббота"],
                                months = ["января","февраля","марта","апреля","мая","июня","июля","августа","сентября","октября","ноября","декабря"];

                            echo_date = function(date){
                                date = new Date( date );
                                return {
                                    "date" : date,
                                    "day" : days[ date.getDay() ],
                                    "month" : months[ date.getMonth() ],
                                    "day_num" : date.getDate()
                                };
                            }
                            return echo_date(date);
                        };



                        var primer = echo_date( Date.now()+24*60*60*1000 );


                        $('#tolko').text("Распродажа до "+ primer.day_num+" "+primer.month)
                    </script>
                    <div class="i_zamer">
                        <a href="#" onclick="callback_zamer(); return false; ">
                            бесплатный<br>
                            <span contenedit="str">выезд замерщика</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--s_simple_text-->
<div class="section s_simple_text">
    <div class="container">
        <div class="row">
            <div class="col-sm-12  clearfix" >


                <h1 contenedit="str" data_route="h1"><?echo $this->route['h1'];?></h1>
                <div contenedit="str" data_route="p"><?echo $this->route['p']?></div>
            </div>
        </div>
    </div>
</div>
<!--end_s_simple_text-->
<!--section s_links-->
<?php $cards = dubl_row($this->sql->query("SELECT * FROM `product_card`"))?>

<div class="section s_links">
    <div class="container">

        <?foreach ($cards as $key=>$value):?>
            <div class="row">
                <?foreach ($value as $val):?>

                    <div class="col-md-6  clearfix" itemscope="" itemtype="http://schema.org/Product">
                        <meta itemprop="brand" content="<?=$val['brand']?>">
                        <meta itemprop="name" content="<?=$val['name']?>">
                        <meta itemprop="manufacturer" content="<?=$val['manufacturer']?>">
                        <div class="link_block">
                            <a href="<?=URL.$val['link']?>"><?=$val['name']?></a>
                            <meta itemprop="description" content="<?=$val['description']?>">
                            <div class="ramka"> <a href="<?=URL.$val['link']?>"><img itemprop="image" src="<?=IMG.$val['img_path']?>" alt="<?=$val['img_alt']?>"></a></div>
                            <div class="l_label" itemprop="offers" itemscope="" itemtype="http://schema.org/Offer"><div class="flex2"><span itemprop="price"><?=$val['price']?></span> <span><i class="rub5"></i></span></div>
                                <meta itemprop="priceCurrency" content="<?=$val['priceCurrency']?>">
                            </div>

                        </div>
                        <div itemprop="aggregateRating" itemscope="" itemtype="https://schema.org/AggregateRating">
                            <meta itemprop="ratingValue" content="<?=$val['ratingValue']?>">
                            <meta itemprop="reviewCount" content="<?=$val['reviewCount']?>">
                        </div>
                    </div>

                <?endforeach;?>

            </div>

        <?endforeach;?>

    </div>
</div>
<!--end section s_links-->