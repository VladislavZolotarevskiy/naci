<?php
$this->title = 'Редактировать тип контакта: ' . $model->name;
?>
<div class="ref-city-update">

    <?= $this->render('_form', [
        'model' => $model,
        'button' => 'Применить'
    ]) ?>

</div>
