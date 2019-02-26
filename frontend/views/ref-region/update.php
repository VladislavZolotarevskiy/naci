<?php
$this->title = 'Редактировать регион: ' . $model->name;
?>
<div class="ref-region-update">

    <?= $this->render('_form', [
        'model' => $model,
        'button' => 'Применить',
    ]) ?>

</div>
