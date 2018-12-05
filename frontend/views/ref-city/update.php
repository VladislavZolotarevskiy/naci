<?php
$this->title = 'Редактировать населённый пункт: ' . $model->name;
?>
<div class="ref-city-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
