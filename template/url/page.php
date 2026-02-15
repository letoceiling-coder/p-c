
<?php $cards = $this->sql->query("SELECT * FROM `product_card` WHERE link = '".$this->urlArray[0]."'")?>
<?php include SECTION."s_p_vid.php";?>

<?php include SECTION."s_minicalc.php";?>
<?if($this->route["block2_h2"]):?>
    <?php include SECTION."s_p_vid2.php";?>
<?php endif;?>
<?if($this->route["gallerryjson"][0]):?>
    <?php include SECTION."s_s_gallery.php";?>
<?php endif;?>
<?if($this->route["gallerryjson2"][0]):?>

    <?php include SECTION."catalog-05.php";?>
<?php endif;?>
<?if($this->route['id_price'][0]):?>
<?php endif;?>

<?php include SECTION."s_form_lowprice.php";?>
<?php include SECTION."s_zamer.php";?>
<?php include SECTION."s_simple_text2.php";?>
<?php include SECTION."s_form5min.php";?>
<?php include SECTION."s25.php";?>
<?php include SECTION."s30.php";?>
<?php include SECTION."s_gallery.php";?>
<?php include SECTION."s_otz_car.php";?>
<?php include SECTION."s23.php";?>
<?php include SECTION."s8.php";?>
