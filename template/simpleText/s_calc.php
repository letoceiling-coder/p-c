<div class="section s_calc">
    <div class="container">
        <div class="row">
            <div class="col-md-12  clearfix padding0">

                <div class="potplok_calc clearfix ">

                    <div class="discount"></div>
                    <div class="p_calc_left col-lg-7">
                        <div class="p_type">
                            <div class="hh">Тип потолка:</div>
                            <div class="ul_menu">
                                <ul class="calc_menu">
                                    <li id="o1" class="active">
                                        Матовые
                                    </li>

                                </ul>
                            </div>

                            <div class="o1 calc_sub hide">
                                <div id="mat" class="o1" style="border-top:none;">
                                    Матовые
                                </div>
                                <div id="gl" class="o1">
                                    Глянцевые
                                </div>
                                <div id="tkan" class="o1">
                                    Тканевые
                                </div>
                                <div id="ur" class="o1">
                                    Моногоуровневые
                                </div>
                                <div id="ft" class="o1">
                                    Фотопечать
                                </div>
                                <div id="st" class="o1">
                                    Звездное небо
                                </div>
                            </div>


                            <div class="room room_mat"><img src="<?=IMG?>p_calc/room_mat.jpg"></div>
                            <div class="room room_gl" style="display: none;"><img src="<?=IMG?>p_calc/room_gl.jpg"></div>
                            <div class="room room_tkan" style="display: none;"><img src="<?=IMG?>p_calc/room_tk.jpg"></div>
                            <div class="room room_ur" style="display: none;"><img src="<?=IMG?>p_calc/room_ur.jpg"></div>
                            <div class="room room_ft" style="display: none;"><img src="<?=IMG?>p_calc/room_ft.jpg"></div>
                            <div class="room room_st" style="display: none;"><img src="<?=IMG?>p_calc/room_st.jpg"></div>


                        </div>
                    </div>
                    <div class="p_calc_right col-lg-5">

                        <div class="p_made">
                            <div class="hh ec">Эконом</div>
                            <div class="hh pr">Премиум</div>
                            <div id="made1" class="flag selected"><img src="<?=IMG?>p_calc/1.png">Россия</div>
                            <div id="made2" class="flag"><img src="<?=IMG?>p_calc/2.png">Китай</div>
                            <div id="made3" class="flag" style=" margin-left:30px;"><img src="<?=IMG?>p_calc/3.png">Германия</div>
                            <div id="made4" class="flag"><img src="<?=IMG?>p_calc/4.png">Франция</div>
                            <div id="made5" class="flag"><img src="<?=IMG?>p_calc/5.png">Бельгия</div>
                        </div>

                        <div class="square">
                            <div class="hh">Площадь помещения:</div>
                            <div class="p_m2_txt" style="float: right;">М<sup>2</sup> </div>
                            <div class="slider_cont">
                                <div class="p_m2">4</div>
                                <div id="slider-horizontal" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"><div class="ui-slider-range ui-widget-header ui-corner-all ui-slider-range-min" style="width: 4%;"></div><span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 4%;"></span></div>
                            </div>

                        </div>

                        <div class="itogo_block">

                            <h3>Стоимость потолка:</h3>
                            <div class="all_pr_txt">Цена у всех:</div>
                            <div class="all_pr">594<span> руб.</span><div class="red_line"></div></div>
                            <div class="counter_itog_txt">Наша цена:</div>


                            <div class="counter_itog"> <span>396</span> руб.</div>

                            <div class="buy_rassr">
                                <a href="<?=URL?>potolki-v-rassrochku">купить<br>в рассрочку</a>
                            </div>


                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<script>

    // Цены

    var mat=99;  // матовые
    var gl=130;  // глянцевые
    var tkan=590;  // тканевые
    var ur=590;  // многоуровневые
    var ft=700;  // фото
    var st=750; // звездное небо

    // страна производитель
    // слева на право
    var flags ={made1:1,
        made2:1.1,
        made3:1,
        made4:1.6,
        made5:1.5,
    };

    var  current_id="mat";
    var m2=4;
    var made=1;

    $(function() {
        $( "#slider-horizontal" ).slider({
            range: "min",
            min: 0,
            max: 100,
            step:1,
            value: 4,
            slide: function( event, ui ) {
                m2=ui.value ;
                $(".p_m2").html(m2);
                pCalc();
            }
        });

    });

    $(".calc_menu").click(function(){
        $(".calc_menu li").removeClass('active');
        //var id=$(this).attr('id');
        var id='o1';
        $(".calc_sub").removeClass('hide');
        $(".calc_sub").addClass('hide');
        $(".calc_sub."+id).removeClass('hide');

    });

    $(".p_calc_left .calc_sub div").click(function(){
        var id=$(this).attr('class');
        //alert (id);
        current_id=$(this).attr('id');
        $(".p_calc_left .calc_sub").removeClass('hide');
        $(".p_calc_left .calc_sub").addClass('hide');
        $('#'+id).html($('#'+current_id).html());

        $('.room').hide();
        $('.room_'+current_id).show();

        $('#'+id).addClass('active');
        pCalc();
    });

    $(".flag").click(function(){
        var id=$(this).attr('id');
        $(".flag").removeClass("selected");
        $(this).addClass("selected");
        made=flags[id];
        // alert(made);
        pCalc();
    })

    function pCalc(){

        if (current_id=="mat"){var itog=m2*(mat*made);}
        if (current_id=="gl"){var itog=m2*(gl*made);}
        if (current_id=="tkan"){var itog=m2*(tkan*made);}
        if (current_id=="ur"){var itog=m2*(ur*made);}
        if (current_id=="ft"){var itog=m2*(ft*made);}
        if (current_id=="st"){var itog=m2*(st*made);}

        var itogo=Math.floor(itog);

        $('.counter_itog span').html(Math.floor(itogo));
        $('.all_pr').html(Math.floor(itogo*1.5)+'<span> руб.</span><div class="red_line"></div>');

    }

    $(function(){
        pCalc();
    })

</script>