<body itemscope itemtype="http://schema.org/Organization">

<div class="contener">
    <div class="row">
        <div class="img-full"></div>
    </div>
</div>
<?php if (!$_COOKIE['user']):?>
<div id="popup2" class="popup2 cookies" ">
    <form action="" name="start">
        <div id="btn-close" class="f-close took_advantage_of_the_offer"> </div>
        <div class="hidecookies">
        <div class="header ">Внимание!</div>

        <div class="header_sub">Компания работает <strong>без предоплат и авансов</strong></div>
        <div class="header_sub">Потому что мы уверены:</div>
        <div class="header_sub">В качестве монтажа и материалов!</div>
        <div class="header_sub"><strong>Оплата производиться только по факту выполненных работ.</strong></div>
        <div class="header_sub">Так же имеется <strong>раcсрочка</strong> до одного года.</div>
        <div class="header_sub">Чтобы узнать подробности, заполните форму.</div>

        <input type="hidden" class="pop_type" value="">
        <div class="prav-info clearfix ">
            <a href="dogovor" class="b-link">Подробнее</a>
        </div>
        </div>
        <div class="razmetka1">
            <div class="low_tel" id="pop_phone">
                <input class="pop_tel" id="pop_tel_bo" type="text" placeholder="Телефон" value="">
            </div>
        </div>


        <div class="grey_btn " title="Введите номер телефона">
            <a class="disabled" id="callback-send9">Оставить заявку</a>
        </div>
        <div class="prav-info clearfix ">Вписывая телефон, вы подтверждаете свое совершеннолетие, соглашаетесь на обработку персональных данных в&nbsp;соответствии с
            <a href="<?=IMG?>prav-info.pdf" class="b-link" onclick="newMyWindow(this.href); return false;">Правовой&nbsp;информацией</a>
        </div>
    </form>
</div>
<?php else:?>

<?php endif;?>
<?php if($this->town):?>
    <div id="maps" style="display: none"></div>
    <script src="<?=JS?>ymaps.js"></script>
<?php endif;?>



<script>
    $(window).on("scroll", function() {
        // Если высота больше 200px
        // Добавляем классу header класс fixed
        if ($(window).scrollTop() > 100) $('.pop_up_block').addClass('fixed');
        // Иначе удаляем класс fixed
        else $('.pop_up_block').removeClass('fixed');
    });

    $(function() {
        $(window).on('load resize', function() {
            var height = $(window).height();
            height = height - 100;

            $('.newblock').css({
                'height': height
            });

        });
    });
</script>

<div class="toptop"></div>
<div id="popup1" class="popup1" >
    <div id="btn-close1" class="f-close"> </div>
    <div class="header ">ЗАКАЗАТЬ ЗВОНОК</div>
    <div class="header_sub"></div>

    <input type="hidden" class="pop_type" value="">
    <div class="razmetka1">
        <div class="low_name">
            <input class="pop_name" type="text" placeholder='Ваше имя' value=''>
        </div>
    </div>
    <div class="razmetka1">
        <div class="low_tel">
            <input class="pop_tel" type="text" placeholder='Телефон' value=''  >
        </div>
    </div>


    <div class="blue_btn">
        <a id="callback-send1">Жду звонка</a>
    </div>
    <div class="prav-info clearfix">Вписывая телефон, вы подтверждаете свое совершеннолетие, соглашаетесь на обработку персональных данных в&nbsp;соответствии с
        <a href="<?=IMG?>prav-info.pdf" class="b-link" onclick="newMyWindow(this.href); return false;">Правовой&nbsp;информацией</a>
    </div>
</div>
<div id="spasibo" class="spasibo" >
    <div id='headers' class="header">СПАСИБО!</div>
    <div id='p1_msg' class="p1_msg">
        Ваша заявка отправлена успешно.
    </div>

    <a  id="callback-spasibo" class="btn b_red">ЗАКРЫТЬ</a>

</div>

<div id="gettown" class="gettown" >
    <div id='headers' class="header">Ваш город</div>
    <div id='town_msg' class="p1_msg">

    </div>

    <a  id="gettown_yes" class="btn b_red">Это так?</a>
    <a  id="gettown_not" class="btn b_red">Нет</a>

</div>



<div id="pozdr" class="pozdr" >
    <div id="btn-close2" class="f-close"> </div>
    <div class="header ">Внимание !!!</div>
    <div class="header_sub">
        Наша компания работает <strong> без предоплат и авансов!!!</strong>
        Оплата производиться только по факту выполненных работ.
        <br>
        Оплата производится как <strong>наличными, так и безналичным расчетом</strong>.
        <br>
        Так же имеется раcсрочка до одного года.
        <br>
        Чтобы узнать подробности, заполните форму.
    </div>
    <div class="razmetka1">
        <!-- <div class="low_name">
            <input class="pozdr_name" type="text" value='' placeholder="Ваше имя" >
        </div>-->
    </div>
    <div class="razmetka1">
        <div class="low_tel">
            <input id="inputmask" class="pozdr_tel" type="text" value='' placeholder="Телефон"  >
        </div>
    </div>
    <div class="blue_btn">
        <a id="callback-pozdr">Отправить</a>
    </div>


    <div class="prav-info clearfix">Вписывая телефон, вы подтверждаете свое совершеннолетие, соглашаетесь на обработку персональных данных в&nbsp;соответствии с
        <a href="<?=IMG?>prav-info.pdf" class="b-link" onclick="newMyWindow(this.href); return false;">Правовой&nbsp;информацией</a>
    </div>
</div>

<div id="hide-layout" class="hide-layout" ></div>
<div id="hide-layout_pozdr" class="hide-layout" ></div>



<meta itemprop="name" content="<?=COMPANY?>" />



<div class="section s_top" >
    <div class="container" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">

        <meta itemprop="addressLocality" content="<?=$this->town["city_rus"]?>" />
        <meta itemprop="streetAddress" content="<?=$this->town["streetaddress"]?>" />
        <meta itemprop="postalCode" content="<?=$this->town["postalcode"]?>" />
        <div class="row">
            <div class="col-sm-12  clearfix padding0">
                <div class="col-sm-6 col-md-4 col-xs-6 logo">
                    <a href="/"><img itemprop="image" src="<?=IMG?>logo.png" alt="Логотип компании <?=COMPANY?>"></a>
                </div>
                <!--<div class="mapicon col-sm-2 col-md-1 col-xs-3"><img class="img-responsive img-fluid " src="<?=IMG?>iconmap.png" alt=""></div>-->
                <div class="col-sm-6 col-md-8 col-xs-6">
                    <div class="row">
                        <div class="col-lg-3 hidden-md hidden-sm hidden-xs">

                                <div class="moscow" data-town="<?=$this->town["city_rus"]?>" style="background: rgba(0, 0, 0, 0) url('<?=IMG?>m_gerb.png') no-repeat scroll left top;">
                                    <?php echo $this->town["city_rus"] ?  $this->town["city_rus"]: 'Выбрать город';?>&nbsp;&#9660;<br>
                                    <span class="under">- - - - - - - - - -</span>

                                    <div class="newblock">


                                        <ul>


                                            <?php foreach ($this->towns as $value):?>
                                                <li>
                                                    <div>
                                                   
                                                        <a href="https://<?=$value["domen_city"]?>.proffi-center.ru"><?=$value["city_rus"]?></a>
                                                    </div>
                                                </li>
                                            <?php endforeach;?>

                                        </ul>
                                    </div>
                                    <div class="rasprod_moscow" ><?php echo $this->town["city_rus"] ?  "+20 км от ".$this->town['city-rus-is']: '';?>  </div>

                                </div>
                    </div>

                    <div class="col-lg-3 hidden-md hidden-sm hidden-xs">
                        <div class="rasprod">
                            <a href="<?=$this->path?>aktsiya">Подарки</a><br>
                            <!--  <span class="under">- - - - - - - - - - - -</span> -->
                            <a href="<?=$this->path?>skidki-na-potolki" class="rasprod_comment">до конца недели</a>
                        </div>
                    </div>

                    <div class="hidden-sm col-md-12 col-lg-6 hidden-xs ">

                        <div class="tel">
                            <p class="">
                                <a class="comagic_phone" itemprop="telephone" href="tel:<?=TEL?>" style="text-decoration:none;"><?=TEL?></a>

                            </p>
                            <div class="call" onclick="callback_tel();  return false;">Вам перезвонить?
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 hidden-md hidden-lg col-xs-12  ">
                        <div class="mmenu"> Меню<img  src="<?=IMG?>mmenu.png"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 padding0">
                        <div id="menunav"class="menu clearfix">

                            <a href="#" style="z-index:9999" id="m_close" class="m_close"><img src="<?=IMG?>m_close.png"></a>


                            <ul>
                                <?php foreach ($this->menu as $key=>$nav):?>

                                    <li>
                                        <div >

                                            <a  href="<?=$this->path.$this->menu[$key][0]["name"]?>" ><?=$this->menu[$key][0]["title"]?></a>
                                        </div>
                                        <ul>
                                            <?php foreach ($nav as $nave):?>

                                                <li ><div><a href="<?=$this->path.$nave["name"]?>"><?=$nave["title"]?></a></div></li>


                                            <? endforeach;?>
                                        </ul>

                                    </li>

                                <? endforeach;?>
                                <li class="noseparator m_last"><div><a href="<?=$this->path?>gde-zakazat-potolki">Контакты</a></div></li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="b_line">
                <div class="menu_place clearfix">
                    <div class="tel">
                        <a class="comagic_phone" href="tel:<?=TEL?>" style="text-decoration:none;"><?=TEL?></a>
                    </div>
                    <div class="call"  onclick="callback_tel(); return false;">Вам перезвонить?</div>

                    <div class="trubka">
                        <a href="tel:<?=TEL?>" >
                            <img src="<?=IMG?>trubka.png">
                        </a>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
<!--nav mobail-->
<div class="nav-mobail ">
    <!-- Модальное окно №2 -->
    <a href="#" class="overlay" id="win2"></a>
    <div class="popup">
        <ul>


            <?php foreach ($this->towns as $value):?>
                <li>
                    <div>
                        <a href="<?=$value["domen_city"]?>"><?=$value["city_rus"]?></a>
                    </div>
                </li>
            <?php endforeach;?>

        </ul>
    </div>
    </div>

<div class="pre-loader">
    <div class="box1"></div>
    <div class="box2"></div>
    <div class="box3"></div>
    <div class="box4"></div>
    <div class="box5"></div>
</div>

    <!---->
    <div class="probel">
    </div>
<?if($_SERVER['REMOTE_ADDR'] == '85.174.194.91'):?>

<?php if(!empty($this->urlArray[0])):?>
<div itemscope="" itemtype="http://schema.org/BreadcrumbList" id="breadcrumbs">
   <span itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
       <a rel="nofollow" itemprop="item" title="Главная" href="/">
          <span itemprop="name">Главная</span>
          <meta itemprop="position" content="1">
       </a>&#10144;
   </span>

    <span itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">

          <span itemprop="name"><?=$this->route['title']?$this->route['title']:$this->route['h1']?></span>
          <meta itemprop="position" content="2">
       </a>
   </span>

</div>
<?php endif;?>
<?php endif;?>