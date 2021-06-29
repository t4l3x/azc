<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Operator */

$this->title = Yii::t('app', 'Create Operator');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Operators'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="operator-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
