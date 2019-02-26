<?php
$this->title = 'Добавить населённый пункт';
?>
<div class="ref-city-create">

    <?= $this->render('_form', [
        'model' => $model,
        'button' => 'Добавить'
    ]) ?>

</div>
