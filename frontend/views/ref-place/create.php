<?php
$this->title = 'Добавить площадку';
?>
<div class="ref-place-create">

    <?= $this->render('_form', [
        'model' => $model,
        'button' => 'Добавить'
    ]) ?>

</div>
