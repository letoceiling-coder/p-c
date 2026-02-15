<div class="section s_otable">
    <div class="container">
        <div class="row">
            <div class="col-sm-12  clearfix">
                <table>
                    <tbody><tr>
                        <th>Тип натяжного<br>потолка</th>
                        <th>Срок<br>изготовления</th>
                        <th>Цена за 1м<sup>2</sup></th>
                        <th>Гарантия</th>
                        <th class="small_hide" style="border:none;">Производитель</th>
                    </tr>
                    <tr>
                        <td>Матовый</td>
                        <td>от 1 дня</td>
                        <td><div class="o_best_price"></div><div class="price"><span>от 99</span><span> <i class="rub3"></i></span></div></td>
                        <td><img src="<?=IMG?>7let.png" alt=""></td>
                        <td class="small_hide" style="border:none;"><img src="<?=IMG?>mat_pro.png" alt=""></td>
                    </tr>
                    <tr>
                        <td>Глянцевый</td>
                        <td>от 1 дня</td>
                        <td><div class="price"><span>от 130 </span><span> <i class="rub3"></i></span></div></td>
                        <td><img src="<?=IMG?>7let.png" alt=""></td>
                        <td class="small_hide" style="border:none;"><img src="<?=IMG?>gl_pro.png" alt=""></td>
                    </tr>
                    <tr>
                        <td>Сатиновый</td>
                        <td>от 1 дня</td>
                        <td><div class="price"><span>от 130 </span><span> <i class="rub3"></i></span></div></td>
                        <td><img src="<?=IMG?>7let.png" alt=""></td>
                        <td class="small_hide" style="border:none;"><img src="<?=IMG?>satin_pro.png" alt=""></td>
                    </tr>
                    <tr>
                        <td>Тканевый</td>
                        <td>от 1 дня</td>
                        <td><div class="price"><span>от 590 </span><span> <i class="rub3"></i></span></div></td>
                        <td><img src="<?=IMG?>12let.png" alt=""></td>
                        <td class="small_hide" style="border:none;"><img src="<?=IMG?>tkan_pro.png" alt=""></td>
                    </tr>
                    <tr>
                        <td>С фотопечатью</td>
                        <td>от 1 дня</td>
                        <td><div class="price"><span>от 700 </span><span> <i class="rub3"></i></span></div></td>
                        <td><img src="<?=IMG?>20let.png" alt=""></td>
                        <td class="small_hide" style="border:none;"><img src="<?=IMG?>foto_pro.png" alt=""></td>
                    </tr>
                    <tr style="border:none;">
                        <td>Звездное небо</td>
                        <td>от 3 дней</td>
                        <td><div class="price"><span>от 750 </span><span> <i class="rub3"></i></span></div></td>
                        <td><img src="<?=IMG?>20let.png" alt=""></td>
                        <td class="small_hide" style="border:none;"><img src="<?=IMG?>zn_pro.png" alt=""></td>
                    </tr>




                    </tbody></table>
            </div>
        </div>
    </div>
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
    $('#days').text("До "+ primer.day_num+" "+primer.month)
</script>