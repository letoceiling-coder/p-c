
<!--[if lt IE 9]>
  <script src="<?=JS?>es5-shim.min.js"></script>
  <script src="<?=JS?>html5shiv.min.js"></script>
  <script src="<?=JS?>html5shiv-printshiv.min.js"></script>
  <script src="<?=JS?>respond.min.js"></script>
  <![endif]-->
<script src="<?=JS?>jquery-ui.min.js"></script>
<script src="<?=JS?>jquery.inputmask.min.js"></script>
<script src="<?=JS?>jquery.mousewheel.min.js"></script>
<?php if($this->urlArray[0] == 'gde-zakazat-potolki'):?>
<script src="<?=JS?>direct_geocode.js"></script>
<?php endif;?>
<script src="<?=JS?>owl.carousel.min.js"></script>
<script src="<?=JS?>jquery.plugin.js"></script>

<script src="<?=JS?>jquery.countdown.js"></script>

<?php if ($this->pathTable == 'client'):?>

<?php endif;?>

<?php if ($this->controller == 'classed\AdminController' || $this->admin):?>
    <script src="/template/globalTemplate/admin/js/script.js"></script>
<?php endif;?>
<!--  <script src="<?=JS?>snowfall.js"></script>
  <script type="text/javascript">

        $(document).snowfall({
            flakeCount: 300,
            image :"/img/snow3.png",
            minSize: 10,
            maxSize:20,
            round: true,
            shadow: false,
        });

</script>
-->
<script src="<?=JS?>jquery.ui.touch-punch.min.js"></script>
<script src="<?=JS?>jquery.cookie.js"></script>

<!--<script src="--><?//=JS?><!--canvas-video-player.js"></script>-->
<script src="<?=JS?>device.js"></script>
<script src="<?=JS?>custom-file-input.js"></script>
<script src="<?=JS?>common.js"></script>











<script>

    $(document).ready(function() {

        var wblocks = $('.w_blocks').children();
        wblocks.addClass('hidden');
        var wblocks = $('.stroki').children();
        wblocks.addClass('hidden');
    })

    $('#callback-spasibo, #hide-layout').click(function() {
        $('#hide-layout, #spasibo').fadeOut(300);
        $('.img-full img').fadeOut(600);

        $('.pop_name').val('');
        $('.pop_tel').val('');
    })

    $('#callback-spasibo-err, #hide-layout').click(function() {
        $('#hide-layout, #spasibo_error').fadeOut(300);

        $('.pop_name').val('');
        $('.pop_tel').val('');
    })

    $('.popup1 .f-close').click(function(){
        $( "#popup1" ).fadeOut( 400 );
        $( "#hide-layout" ).fadeOut( 400 );
    })

    $('.popup2_kupon .f-close').click(function(){
        $( "#popup2_kupon" ).fadeOut( 400 );
        $( "#hide-layout" ).fadeOut( 400 );
    })

</script>

</body>
</html>