<?php

/* @var $this yii\web\View */

$this->title = 'OM Yii2';
?>

<div class="container">
    <div class="row">
        <div class="alert" role="alert">&nbsp;</div>
    </div>
    <h3>Сотрудники</h3>
    <div class="collapse_form">
        <p class="btn btn-group-xs btn-sm btn-success">+Добавить</p>
        <form class="form-group" id="user-form">
            <div class="form-group col-lg-3">
                <input class="form-control" type="text" name="name" readonly value="">
            </div>
            <div class="form-group col-lg-2">
                <input class="form-control" type="text" name="city" readonly value="">
            </div>
            <div class="form-group col-lg-2">
                <button class="form-control btn btn-info" id="create-btn" type="button">Отправить</button>
            </div>
        </form>
    </div>
    <hr>
    <hr>

    <table id="main_table" class="display"></table>
</div>

