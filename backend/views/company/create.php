<?php

use yii\helpers\Html;
use \yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Company */

$this->title = '添加新单位';
$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
