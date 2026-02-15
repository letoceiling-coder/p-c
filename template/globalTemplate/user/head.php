

<!DOCTYPE html>
<!--[if lt IE 7]><html lang="ru" class="lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html lang="ru" class="lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html lang="ru" class="lt-ie9"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="ru">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <title><?=$this->route["name_title"]?></title>

    <meta name="yandex-verification" content="fb2b0bcd34ff382e" />
    <meta name="google-verification" content="7f2W8JkyGzDsTiSfVdDcKRrH4wUyBjgMKaLsXD3ndnc" />
    <meta name="description" content="<?=$this->route["description"]?>" />
    <meta name="keywords" content="<?=$this->route["keywords"]?>" />
    <meta name="robots" content="index,follow" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta property="og:title" content="<?=$this->route["name_title"]?>">
    <meta property="og:image" content="<?=IMG?>logo.png" />
    <meta property="og:url" content="<?=SITES?>"/>
    <meta property="og:locale" content="ru_RU"/>
    <meta property="og:name" content="Производство, продажа и монтаж натяжных потолков и комплектующих от компании <?=COMPANY?>"/>
    <meta property="og:description" content="<?=$this->route["description"]?>"/>
    <meta property="og:updated_time" content="<?=$this->newData?>"/>
    <meta property="og:type" content="Company <?=COMPANY?>">
    <meta property="og:video" content="/video/video.mp4" />

<?php if ($this->template != 'error'):?>
    <link rel="canonical" href="<?=$this->canonical?>"/>
<? endif;?>

    <link rel="shortcut icon" href="/favicon.svg" type="image/svg+xml">


    <link rel="stylesheet" href="<?=CSS?>reset.css" />

    <link rel="stylesheet" href="<?=CSS?>jquery-ui.css">
    <link rel="stylesheet" href="<?=CSS?>bootstrap-grid-3.3.1.min.css" />
    <link rel="stylesheet" href="<?=CSS?>font-awesome.min.css" />
    <link rel="stylesheet" href="<?=CSS?>jquery.fancybox.css" />
    <link rel="stylesheet" href="<?=CSS?>owl.carousel.css" />
    <link rel="stylesheet" href="<?=CSS?>owl.theme.default.css" />
    <link rel="stylesheet" href="<?=CSS?>jquery.countdown.css" />
    <link rel="stylesheet" href="<?=CSS?>fonts.css" />
    <link rel="stylesheet" href="<?=CSS?>main2.css" />
    <link rel="stylesheet" href="<?=CSS?>media.css" />
    <!--	<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/jsxgraph/1.1.0/jsxgraph.css" />-->

    <link rel="stylesheet" href="<?=CSS?>normalize.css" />
    <link rel="stylesheet" href="<?=CSS?>component.css" />



    <script src="<?=JS?>jquery-1.11.1.min.js"></script>
    <script src="<?=JS?>jquery.lockfixed.min.js"></script>

    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=a79c56f4-efea-471e-bee5-fe9226cd53fd
" type="text/javascript"></script>


    <script>
        $(function() {
            if (navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i)) {
                var viewportmeta = document.querySelector('meta[name="viewport"]');
                if (viewportmeta) {
                    viewportmeta.content = 'width=device-width, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1.0';
                    document.body.addEventListener('gesturestart', function () {
                        viewportmeta.content = 'width=device-width, minimum-scale=0.25, maximum-scale=1.6';
                    }, false);
                }
            }

        })
    </script>
    <link rel="stylesheet" href="<?=CSS?>noty.css" />
    <script src="<?=JS?>noty.min.js"></script>
    <?php if ($this->pathTable == 'client'):?>
        <link rel="stylesheet" href="<?=CSS?>client.css" />

        <link rel="stylesheet" href="<?=CSS?>all.min.css" />
        <link rel="stylesheet" href="<?=CSS?>styles.css" />


        <script src="<?=JS?>client.js"></script>

        <script src="<?=JS?>noty.min.js"></script>
        <script src="<?=JS?>decimal.js"></script>
        <script src="<?=JS?>paper-full.js"></script>
        <script src="<?=JS?>delaunay.js"></script>
        <script src="<?=JS?>sketch_class.min.js"></script>
        <script src="<?=JS?>sketch.min.js"></script>
        <script>
            window.addEventListener('load', () => {
                const popupInfo = document.getElementById('popup-info');
                document.getElementById('btn-info').addEventListener('click', () => {
                    popupInfo.style.display = 'block';
                });
                if (localStorage.getItem('result')) {
                    popupInfo.style.display = 'none';
                }
            });
        </script>
    <?php endif;?>
    <?php if ($this->template != '500'):?>
<!-- Yandex.Metrika counter -->

<script type="text/javascript">
    var yaParams = {ip: "<? echo $_SERVER['REMOTE_ADDR']; ?>"};
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter54757786 = new Ya.Metrika({id:54757786,
                        params:window.yaParams,
              webvisor:true,
                        clickmap:true,
                        trackLinks:true,
                        accurateTrackBounce:true});
            } catch(e) { }
        });
    
        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";
    
        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<!-- /Yandex.Metrika counter -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-147635853-1"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'UA-147635853-1', { 'optimize_id': 'GTM-KR9QN9D'});
</script>
    <?php endif;?>
    <style>
        #map {
            width: 100%;
            min-height: 85vh;

            margin: 0;
            padding: 0;
        }

    </style>
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
        function newMyWindow(e) {
            var h = 500,
                w = 500;
            window.open(e, '', 'scrollbars=1,height='+Math.min(h, screen.availHeight)+',width='+Math.min(w, screen.availWidth)+',left='+Math.max(0, (screen.availWidth - w)/2)+',top='+Math.max(0, (screen.availHeight - h)/2));
        }
    </script>
</head>
