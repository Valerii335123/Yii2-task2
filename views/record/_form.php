<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="record-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'text')->textInput(['maxlength' => 1024]) ?>
    <?= $form->field($model, 'active')->radioList([
            1 => 'active',
            0 => 'deactive'
        ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
