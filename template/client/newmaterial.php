<?php
$client = $this->urlArray[2];
if (isset($_POST['submitnew'])){
    $sql = "INSERT INTO `types_of_work`( `name`, `id_unit_of_measurement`, `price`) 
            VALUES ('{$_POST["text"]}',{$_POST["unit_of_measurement"]},{$_POST["number"]})";
    $this->sql->query($sql);
    $post = $_POST;
}

?>
<div class="contener " style="height: 20px">
    <div class="row" style="height: 100px;padding-top: 50px;padding-left: 20px">
        <form method="post">
            <input type="text" name="text">

            <select  class="smeta_select_" id="unit_of_measurement" name="unit_of_measurement">
                <?php foreach ($this->route["unit_of_measurement"] as $value):?>

                    <option value="<?=$value["id"]?>"><?=$value["name"]?></option>

                <?php endforeach;?>
            </select>
            <input style="width: 50px" type="number" name="number">
            <input type="hidden" value="<?=$client?>" name="client">
            <input  type="submit" name="submitnew">


    </div>

    <div class="row" style="margin: 0 auto; width: 100%;text-align: center">
        <a style="padding: 15px;border: 1px solid black;margin-top: 40px" href="/client/smeta/<?=$client?>">Exit</a>
    </div>
    </form>
    <div class="row">
        <?php if ($post):?>
            <p><?=$post['text']?> :<?=$this->route["unit_of_measurement"][$post["unit_of_measurement"]]["id"]?>:<?=$post["number"]?></p>
        <?php endif;?>
    </div>
</div>



