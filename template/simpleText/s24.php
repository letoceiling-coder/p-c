<?php $reviews = $this->sql->query("SELECT * FROM `reviews` WHERE ban = '1' ORDER BY id DESC");
foreach ($reviews as $key => $value) {
    if(!empty($value['files'])){
        $files = explode(",", $value['files']);

        array_push($reviews[$key], $files);
    }
}
?>

<div class="section s24">
    <div class="content">
        <div class="otz_page clearfix">
            <div class="col-lg-6 col-lg-offset-1 clearfix">
                <div class="otz_left">
                    <?foreach ($reviews as $key=>$val):?>
                        <div class="otz_block">
                            <div class="otz_head clearfix">
                                <div class="otz_name"><?=$val['name']?></div>
                                <div class="otz_date"><?=$val['data']?></div>
                                <div class="clr"></div>
                            </div>
                            <div class="otz_text">
                                <?=$val['txt']?>
                            </div>
                            <?if(!empty($val[0])):?>
                                <div id='corusel_<?=$key?>' class="carousel-gallery owl-carousel otz_left">
                                    <?foreach ($val[0] as $k=>$v):?>
                                        <img src="<?=IMG.'/img/'.$v?>" alt="fdgdg">
                                    <?endforeach;?>
                                </div>
                            <?endif;?>
                        </div>
                    <?endforeach;?>
                </div>
            </div>
            <div class="col-lg-5  clearfix">
                <div class="otz_right">
                    <div style="height:564px;display:block"><div class="zakaz_vp" id="callback3otz" >
                            <div class="zagl-otz">Оставьте отзыв</div>
                            <form  id="my_form" method="post" enctype="multipart/form-data">
                                <div class="razmetka1">
                                    <div class="low_name">
                                        <input class="v_name" type="text" value="" placeholder="Ваше имя">
                                    </div>
                                </div>
                                <div class="razmetka1">
                                    <div class="low_tel">
                                        <input class="v_tel" type="text" value="" placeholder="Телефон">
                                    </div>
                                </div>
                                <div class="razmetka1">
                                    <div class="low_text">
                                        <textarea class="v_text" placeholder="Отзыв"></textarea>
                                    </div>
                                </div>
                                <div class="box">
                                    <input type="file" name="multi_img_file[]" id="file-1" accept=".gif,.jpg,.jpeg,.png,.svg" class="inputfile inputfile-1" data-multiple-caption="{count} Загруженых файлов" multiple />
                                    <label for="file-1"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Загрузить файл&hellip;</span></label>
                                </div>
                                <div class="blue_btn">
                                    <a id="callback-send_otz">Отправить</a>
                                </div>
                            </form>
                            <div class="prav-info">Вписывая телефон, вы подтверждаете свое совершеннолетие, соглашаетесь на обработку персональных данных в&nbsp;соответствии с
                                <a href="/img/prav-info.pdf" class="b-link" onclick="newMyWindow(this.href); return false;">Правовой&nbsp;информацией</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    if ($(document).width()>1200){
        $.lockfixed("#callback3otz",{offset: {top: 10, bottom: 1300}});
    }
</script>