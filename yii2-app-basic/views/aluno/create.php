<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Aluno */
/* @var $curso app\controllers\AlunoController */
$this->title = 'Create Aluno';
$this->params['breadcrumbs'][] = ['label' => 'Alunos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aluno-create">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= $this->render('_form', [
        'model' => $model, 'curso_lista'=>$curso_lista
    ]) ?>

</div>
