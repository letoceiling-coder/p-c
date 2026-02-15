
<div class="section s_market">
    <div class="container">
        <div class="row">
            <div class="col-sm-12  clearfix">
                <h1 class=""><?=$this->route["h1"]?></h1>
                <p class="light">
                    Компания «<?=COMPANY?>» рада предложить натяжные потолки по индивидуальным размерам на заказ. Благодаря собственному производству, срок изготовления изделий составляет всего 1 рабочий день, а стоимость самая минимальная на рынке в городе <?=$this->town["city_rus"]?>!
                </p>
            </div>
        </div>
        <div class="row">
            <div class="cat_menu">
                <a href="<?=$this->path?>gotovye-potolki"><img src="<?=IMG?><?=$this->urlArray[0] ?'cat_menu/all.png':'cat_menu/all_current.png'?>"></a>
                <a href="<?=$this->path?>gotovye-potolki/matovyye"><img src="<?=IMG?><?=$this->urlArray[0] == 'matovyye'?'cat_menu/mat_current.png':'cat_menu/mat.png'?>"></a>
                <a href="<?=$this->path?>gotovye-potolki/glyantsevyye"><img src="<?=IMG?><?=$this->urlArray[0] == 'glyantsevyye'?'cat_menu/gl_current.png':'cat_menu/gl.png'?>"></a>
                <a href="<?=$this->path?>gotovye-potolki/tkanevyye"><img src="<?=IMG?><?=$this->urlArray[0] == 'tkanevyye'?'cat_menu/tk_current.png':'cat_menu/tk.png'?>"></a>
                <a href="<?=$this->path?>gotovye-potolki/mnogourovnevyye"><img src="<?=IMG?><?=$this->urlArray[0] == 'mnogourovnevyye'?'cat_menu/ur_current.png':'cat_menu/ur.png'?>"></a>
                <a href="<?=$this->path?>gotovye-potolki/fotopechat"><img src="<?=IMG?><?=$this->urlArray[0] == 'fotopechat'?'cat_menu/foto_current.png':'cat_menu/foto.png'?>"></a>
                <a href="<?=$this->path?>gotovye-potolki/zvezdnoye-nebo"><img src="<?=IMG?><?=$this->urlArray[0] == 'zvezdnoye-nebo'?'cat_menu/stars_current.png':'cat_menu/stars.png'?>"></a>



            </div>
        </div>
        <?foreach ($this->cards as $key=>$value):?>
            <div class="row">
                <?foreach ($value as $val):?>

                    <div class="col-sm-6  clearfix" itemscope="" itemtype="http://schema.org/Product">
                        <div class="market_block clearfix">
                            <h3 itemprop="name"><?=$val["h3"]?></h3>
                            <meta itemprop="description" content="<?=$val["description"]?>">
                            <div class="col-lg-6">
                                <div class="c_border">
                                    <div class="red_lenta"></div>
                                    <img itemprop="image" alt="<?=$val["img_alt"]?>" src="<?=IMG.$val["img_path"]?>">
                                </div>
                            </div>
                            <div class=" col-lg-6">
                                <div class="m_sub ">
                                    <div class="razmer">Размер: 100x100 см</div>

                                    <div itemprop="offers" itemscope="" itemtype="http://schema.org/Offer" class="old_price">
                                        <span itemprop="price">
                                            <div class="red_line">

                                            </div><?=$val["price"]?>
                                        </span>
                                        <span>
                                            <i class="rub2"></i>
                                        </span>
                                        <meta itemprop="priceCurrency" content="RUB">
                                    </div>
                                    <div class="current_price">
                                        <span><?=$val["current_price"]?></span>
                                        <span><i class="rub"></i></span>
                                    </div>
                                    <div class="yellow_btn">
                                        <a href="<?=$this->path.str2url($val["h3"].' '.$val["brend"].' '.$val["id"])?>">Купить</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                <?endforeach;?>

            </div>

        <?endforeach;?>





        <div class="pagenation">
<?php $pag = (int)ceil($this->countcards/6);



     $x = 2;

if (in_array('list',$this->urlArray)){
    $a = array_search('list', $this->urlArray);
    $a++;
    if (!$this->urlArray[$a]){
        $a = 1;
    }else{
        $a = (int)$this->urlArray[$a];
    }
}else{
    $a = 1;
}



if ($a){

    if ($a + 3<$pag){
        $pag = $a + 3;
    }

    if ($a>3){
        $x = $a - 2;
    }


}
?>



            <div class="pagenation">

                <?if($a==1):?>
                    <span class="current_link"><?=$x-1?></span>
                <?else:?>
                    <a class="p_link" href="<?=$this->path?>gotovye-potolki/list/<?=$a-1?>">pref</a>
                    <a class="p_link" href="<?=$this->path?>gotovye-potolki/list/<?=$x-1?>"><?=$x-1?></a>

                <?endif;?>
                <?for (; $x<=$pag; $x++):?>

                    <a class="p_link" href="<?=$this->path?>gotovye-potolki/list/<?=$x?>"><?=$x?></a>

                <?endfor;?>
                <?php if ($pag !=$a):?><a class="p_link" href="<?=$this->path?>gotovye-potolki/list/<?=$a+1?>">next</a><?php endif;?>
            </div>
            <?if($a!=1):?>
                <script>

                    $('.p_link:contains(<?=$a?>)').after(' <span class="current_link"><?=$a?></span>')
                    $('.p_link:contains(<?=$a?>)').remove()
                </script>
            <?endif;?>
