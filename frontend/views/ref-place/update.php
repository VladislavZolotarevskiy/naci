<?php
$this->title = 'Редактировать площадку: ' . $model->name;
?>
<div class="ref-city-update">
    <?= $this->render('_form', [
        'model' => $model,
        'button' => 'Применить'
    ]) ?>

</div>
