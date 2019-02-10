<?php
$this->title = 'Добавить сервис';
?>
<div class="ref-service-create">

    <?= $this->render('_form', [
        'model' => $model,
        'button' => 'Добавить'
    ]) ?>

</div>
