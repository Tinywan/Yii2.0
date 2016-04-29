<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CamSet */

$this->title = 'Create Cam Set';
$this->params['breadcrumbs'][] = ['label' => 'Cam Sets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cam-set-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
