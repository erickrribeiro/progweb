<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Este trabalho foi solicitado pelo Professor David Fernandes na dispiciplina de Programação Web, e será utilizado
        como trabalho final dessa disciplina.
    </p>
    <p> </p>
    <p>Hora:  <?=$hora ?></p>
    <code><?= __FILE__ ?></code>
</div>
