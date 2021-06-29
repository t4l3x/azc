<?php

use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PhoneNumbers */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="phone-numbers-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'cat_id')
            ->dropDownList(
                ArrayHelper::map(\common\models\CategoryT::find()->where(['locale' => Yii::$app->language])->orWhere(['in', 'locale', ['az']])->asArray()->all(), 'category_id', 'name')
            )
        ?>

        <?= $form->field($model, 'vendor_id')
            ->dropDownList(
                ArrayHelper::map(\common\models\Vendors::find()->asArray()->all(), 'id', 'name')
            )
        ?>


        <?= $form->field($model, 'operator_id')
            ->dropDownList(
                ArrayHelper::map(\common\models\Operator::find()->asArray()->all(), 'id', 'prefix')
            )
        ?>
        <div class="col-md-12">
            <div style="padding: 15px" class="form-group bg-info">
                <label>from</label>
                <input id="from" placeholder="3847748">

                <label>to</label>
                <input id="to" placeholder="3848848">

                <label>Rise</label>
                <input id="rise" placeholder="10">

                <a class="btn btn-primary" id="generate">Generate</a>
            </div>
        </div>

        <?=
        $form->field($model, 'number')->widget(Select2::classname(), [
            'data' => [],
            'id' => 'numbers',
            'size' => Select2::MEDIUM,
            'options' => ['placeholder' => 'Numbers ...', 'multiple' => true, 'id' => 'numbers',],
            'pluginOptions' => [
                'tags' => true,
                'tokenSeparators' => [',', ' '],
                'maximumInputLength' => 10,
            ],
        ])->label('Tag Multiple');
        ?>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
<?php
$this->registerJs(<<< EOT_JS_CODE
 (function($) {
  'use strict';
     $(document).on('click', '#generate', function () { 
        if( $('#from').val() !== '' && $('#to').val() !== '' && $('#rise').val() !== '')
        {
           let i = parseInt($('#from').val());
           let to = parseInt($('#to').val());
           let range = parseInt($('#rise').val());
           let numbers = [];
           if(!isNaN(i) && !isNaN(to) && !isNaN(range)){
               for(i; i <= to; i+=range){
                   numbers.push($("<option selected='selected'></option>").val(i).text(i));
               }
           }
        $("#numbers").append(numbers).trigger('change');
           
        }
    });
})(jQuery);
EOT_JS_CODE
    , \yii\web\View::POS_END);