<script>
    window.addEventListener('load', (e) => {
        const result = localStorage.getItem('result');
        if (result) {
            const data = JSON.parse(localStorage.getItem('result'));
            const tableWalls = document.getElementById('table-walls');

            const tableDiags = document.getElementById('table-diags');
            const fillTable = (table, lines) => lines.forEach((line) => {
                const tr = document.createElement('tr');
                const tdKey = document.createElement('td');
                const tdVal = document.createElement('td');
                tdKey.innerHTML = line.name;
                tdVal.innerHTML = line.length;
                tr.appendChild(tdKey);
                tr.appendChild(tdVal);
                table.appendChild(tr);
            });
            fillTable(tableWalls, data.linesLength.lines);
            fillTable(tableDiags, data.linesLength.diags);
            document.getElementById('angles_result').innerHTML = data.angles;
            document.getElementById('perimeter_result').innerHTML = data.perimeter;
            document.getElementById('area_result').innerHTML = data.area;
            document.getElementById('curvilinear_result').innerHTML = data.curvilinear;
            const imgElement = document.getElementById('img-result');
            imgElement.innerHTML = atob(data.img);

            document.getElementById('btn-save').addEventListener('click', (e) => {
                const frame = document.createElement('iframe');
                const imgBlock = imgElement.children[0].cloneNode(true);
                imgBlock.style.maxHeight = '780px';

                const table = document.createElement('table');
                table.style.margin = '0 auto';
                table.innerHTML = '<caption style="text-align: center;">Контур и диагонали (см.)</caption>';
                data.linesLength.lines.forEach((line, index) => {
                    const tr = document.createElement('tr');
                    const tdLKey = document.createElement('td');
                    tdLKey.style.padding = '0 6px';
                    const tdLVal = document.createElement('td');
                    tdLVal.style.textAlign = 'right';
                    const tdDKey = document.createElement('td');
                    tdDKey.style.padding = '0 6px 0 64px';
                    const tdDVal = document.createElement('td');
                    tdDVal.style.textAlign = 'right';
                    tdLKey.innerHTML = line.name;
                    tdLVal.innerHTML = line.length;
                    tr.appendChild(tdLKey);
                    tr.appendChild(tdLVal);
                    if (data.linesLength.diags[index]) {
                        tdDKey.innerHTML = data.linesLength.diags[index].name;
                        tdDVal.innerHTML = data.linesLength.diags[index].length;
                        tr.appendChild(tdDKey);
                        tr.appendChild(tdDVal);
                    }
                    table.appendChild(tr);
                });

                const commonInfoBlock = document.getElementsByClassName('div-result-final')[0].children[0].cloneNode(true);
                commonInfoBlock.style.margin = '0 auto';
                document.body.append(frame);
                frame.contentWindow.document.body.append(imgBlock);
                frame.contentWindow.document.body.append(table);
                frame.contentWindow.document.body.append(commonInfoBlock);
                frame.contentWindow.print();
            });
        }
        document.getElementById('btn-back').addEventListener('click', (e) => {

            window.location.assign('/client/id/<?=$this->urlArray[2]?>');
        });
    });
</script>
<div class="result-container">

    <div id="img-result">

    </div>
    <div class="contener ">
        <div class="client-head">


            <form method="post" id="form_smeta">
                    <select  class="smeta_select" id="room" name="room">
                        <option value="0">ROOM</option>

                        <?php foreach ($this->route["room"] as $val):?>
                        <option value="<?=$val['id']?>"><?=$val['name']?></option>
                        <?php endforeach;?>
                    </select>
                <select  class="smeta_select" id="manufacture" name="manufacture">
                        <option value="0">BREND</option>
                        <?php foreach ($this->route["manufactures"] as $val):?>
                        <option value="<?=$val['id']?>"><?=$val['name']?></option>
                        <?php endforeach;?>
                    </select>
                <select  class="smeta_select" id="material" name="material">
                    <option value="0">MATERIAL</option>
                    <?php foreach ($this->route["material"] as $val):?>
                        <option value="<?=$val['id']?>"><?=$val['name']?></option>
                    <?php endforeach;?>
                </select>
                <input id="client_id" type="hidden"name="client_id" value="<?=$this->route["client"]["id"]?>">





            </form>



        </div>
    </div>
    <div class="result-length-container">
        <div>
            Контур (см.)
            <table>
                <tbody id="table-walls"></tbody>
            </table>
        </div>
        <div>
            Диагонали (см.)
            <table>
                <tbody id="table-diags"></tbody>
            </table>
        </div>
    </div>
    <div class="div-result-final">
        <table>
            <tr>
                <td>Кол-во углов (шт.):</td><td><span id="angles_result" readonly tabindex="-1"></span></td>
            </tr>
            <tr>
                <td>Периметр (м.):</td><td><span id="perimeter_result" readonly tabindex="-1"></span></td>
            </tr>
            <tr>
                <td>Площадь (м<sup>2</sup>.):</td><td><span id="area_result" readonly tabindex="-1"></span></td>
            </tr>
            <tr>
                <td>Криволинейность (м.):</td><td><span id="curvilinear_result" readonly tabindex="-1"></span></td>
            </tr>
        </table>
        <div class="right-buttons">
            <button id="btn-back" class="btn no-focus" tabindex="-1" title="Построить новый чертеж"><i class="fas fa-times-circle"></i></button>
            <button id="btn-save" class="btn no-focus" tabindex="-1" title="Печать (Сохранить в pdf)"><i class="fas fa-save"></i></button>
        </div>
    </div>
</div>
<div id="result_"></div>