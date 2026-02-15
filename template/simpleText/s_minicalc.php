<div class="section s_minicalc">
    <div class="container">
        <div class="row">
            <div class="col-sm-12  clearfix">
                <h5>Онлайн расчет стоимости натяжного потолка:</h5>

                <div class="mc_block clearfix">

                    <div class="mc_input_place clearfix">
                        <div class="mc_label"><?=$cards[0]["measure"]?></div>
                        <input type="text" value="10">
                    </div>

                    <div class="mc_slider_place clearfix">
                        <div class="txt t1">1</div>
                        <div id="mc_slider-horizontal" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"><div class="ui-slider-range ui-widget-header ui-corner-all ui-slider-range-min" style="width: 9.09091%;"></div><span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 9.09091%;"></span><div class="ui-slider-range ui-widget-header ui-corner-all ui-slider-range-min" style="width: 9.09091%;"></div></div>
                        <div class="txt t2">100</div>
                    </div>

                    <div class="mc_price_place">
                        <div class="mc_price" id="mc_price">990<span> руб.</span></div>
                    </div>

                </div>

                <p>Данный расчет представлен для ознакомительных целей.<br>
                    <?php require_once __DIR__ . '/../../includes/town_helpers.php'; ?>
                    Для получения подробной информации Вы можете связаться с нами по телефону: <span class="comagic_phone"><?=town_phone()?></span></p>

            </div>
        </div>
    </div>
</div>
<script>
    var type="<?=s_replace($this->urlArray[0])?>";
    var cena= {
        <?=s_replace($this->urlArray[0])?> : <?=$cards[0]["price"]?>
    };
</script>