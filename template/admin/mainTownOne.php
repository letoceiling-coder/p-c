<table>
    <?php foreach ($this->route as $key=>$value):?>

        <?php foreach ($value as $k=>$val):?>




            <?php foreach ($val as $i=>$v):?>

                                 <tr>
                                     <td><?=$i;?></td>
                                     <td><textarea name="" id="" cols="200" rows="5"><?=$v;?></textarea></td>

                                 </tr>

            <?php endforeach;?>


        <?php endforeach;?>
    <?php endforeach;?>
</table>
