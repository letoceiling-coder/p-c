<div class="section s_form_lowprice">
    <div class="container">
        <div class="row">
            <div class="col-sm-12  clearfix">
                <h3 style="color:#000;" class="">Заказать по самой низкой цене</h3>

                <div class="cont_section">
                    <div class="zagl">До конца распродажи осталось:</div>
                    <div class="dd">
                        <div class="digits"></div>
                        <div class="clr"></div>
                        <div class="ddd">
                            <span>часов</span>
                            <span class="dd_s">минут</span>
                            <span style="margin-right:0;">секунд</span>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-2  clearfix">
                </div>
                <div class="col-md-5  clearfix">
                    <div class="low_tel">
                        <input id="low_tel" type="text" placeholder="Телефон">
                    </div>
                </div>

                <div class="col-md-3  clearfix">
                    <div class="blue_btn">
                        <a id="low_sand" href="#">
                            Отправить заявку
                        </a>
                    </div>
                </div>

            </div>

        </div>
        <div class="prav-info">Вписывая телефон, вы подтверждаете свое совершеннолетие, соглашаетесь на обработку персональных данных в&nbsp;соответствии с
            <a href="<?=IMG?>prav-info.pdf" class="b-link" onclick="newMyWindow(this.href); return false;">Правовой&nbsp;информацией</a>
        </div>
    </div>
</div>
<script>
    $(function(){

        $(".digits").countdown({
            image: "<?=IMG?>digits.png",
            format: "hh:mm:ss",
            digitWidth: 80,
            digitHeight: 108,   //106
            endTime: new Date(2221, 7, 12, 9, 0, 0)
        });



    })
</script>