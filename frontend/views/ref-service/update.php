<?php
$this->title = 'Редактировать сервис: ' . $model->name;
?>
<div class="ref-service-update">

    <?= $this->render('_form', [
        'model' => $model,
        'button' => 'Применить'
    ]) ?>

</div>
