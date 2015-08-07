<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
$this->title = 'Instituto de Computação';
?>
<div class="site-index">

    <div class="jumbotron">

        <?= Html::img('@web/logo.ico') ?>
        <?= Html::cssFile('@web/css/main.css'); ?>
        <p id="nome_logo">Instituto de Computação<p>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>
</div>
