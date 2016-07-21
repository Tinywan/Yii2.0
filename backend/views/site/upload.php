<?php
/**
 * Created by PhpStorm.
 * User: 1
 * Date: 2016/5/21
 * Time: 16:39
 */
use yii\widgets\ActiveForm;
use yii\bootstrap\Alert;
use kartik\datetime\DateTimePicker;
?>
<?php
    if(Yii::$app->getSession()->hasFlash('success'))
    {
        echo Alert::widget([
            'options' => [
                'class' => 'alert-success', //这里是提示框的class
            ],
            'body' => Yii::$app->getSession()->getFlash('success'), //消息体
        ]);
    }

    if(Yii::$app->getSession()->hasFlash('error'))
    {
        echo Alert::widget([
            'options' => [
                'class' => 'alert-danger', //这里是提示框的class
            ],
            'body' => Yii::$app->getSession()->getFlash('error'), //消息体
        ]);
    }
?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $form->field($model, 'imageFile')->fileInput() ?>


    <button>Submit</button>

<?php ActiveForm::end() ?>