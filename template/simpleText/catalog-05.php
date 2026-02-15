<div class="catalog-05" >
    <div class="container" >
        <div class="row">
            <div class="col-xs-12">
                <h2 itemprop="about">Цены на работу по установке карниза</h2>
            </div>
        </div>
        <div class="row" >
            <div class="col-xs-12">
                <table class="table" >
                    <thead>
                    <tr>
                        <th>Наименование</th>
                        <th width="120">Ед. изм.</th>
                        <th width="164">Цена</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $price = $this->sql->query("SELECT * FROM `price` WHERE `id_cat` = '{$this->route['id_price']}'");?>
                    <?foreach($price as $key=>$val):?>
                        <tr>
                            <td><?=$val['name']?></td>
                            <td><?=$val['unit']?></td>
                            <td><?=$val['price']?></td>
                        </tr>
                    <?endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>