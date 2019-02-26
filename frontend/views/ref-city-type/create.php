<?php
$this->title = 'Редактировать тип населённого пункта: ' . $model->name;
?>
<div class="ref-city-type-create">

    <?= $this->render('_form', [
        'model' => $model,
        'button' => 'Добавить'
    ]) ?>

</div>