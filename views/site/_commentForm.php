<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

 $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'comment')->textInput(['length' => [3,255]]) ?>


    <div class="form-group">
        <?= Html::submitButton('Add comment', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>