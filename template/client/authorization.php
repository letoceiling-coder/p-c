
<?php if (!$this->client):?>
    <div class="cssload-thecube">
        <div class="cssload-cube cssload-c1"></div>
        <div class="cssload-cube cssload-c2"></div>
        <div class="cssload-cube cssload-c4"></div>
        <div class="cssload-cube cssload-c3"></div>
    </div>

<div class="none">
    <h2>Авторизация</h2>

    <div class="razmetka11">
        <div class="low_name ">
            <input class="t_name " id="low_name" type="text" placeholder="Login" value="">


        </div>

        <div class="low_adress">
            <input class="t_adress" id="low_password" type="password" placeholder="Password" value="">
        </div>

    </div>

    <div class="blue_btn" style="text-align: center;padding-left: 0;">

        <a id="autz_client" onclick="return false" class="">Авторизация</a>
    </div>
</div>
<?php else:?>
<h1>Доступ закрыт</h1>
<?php endif;?>
