<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CloneForm */
/* @var $form yii\widgets\ActiveForm */
/* @var $databases app\models\MetabaseDatabase[] */

$this->title = 'Clone Metabase Database';
?>

<div class="database-clone">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'source_db_id')->dropDownList(
        \yii\helpers\ArrayHelper::map($databases, 'id', 'name'),
        ['prompt' => 'Select Source Database']
    ) ?>

    <?= $form->field($model, 'new_db_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Clone', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
