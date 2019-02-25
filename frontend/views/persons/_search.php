<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PersonsSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="col-md-6" style="text-align: right">
<?php if (!($model->full_name == null)) :?>
    <a class="btn btn-primary disabled" role="button" data-toggle="collapse" href="#persons-search" aria-expanded="false" aria-controls="persons-search">Фильтр</a>
            </div><!--close col-->
        </div><!--close row-->
    </div><!--close management-->
<div class="collapse show" id="persons-search">
<?php else :?>
    <a class="btn btn-primary" role="button" data-toggle="collapse" href="#persons-search" aria-expanded="false" aria-controls="persons-search">Фильтр</a>
            </div>
        </div>
    </div>
<div class="collapse" id="persons-search">
<?php endif ?>




<div class="collapse show" id="persons-search">
    
        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
            'options' => [
                'data-pjax' => 1
            ],
        ]); ?>

        <?= $form->field($model, 'full_name') ?>

        <div class="form-group">
            <?= Html::submitButton('Найти', ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('Сброс', ['class' => 'btn btn-default']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
