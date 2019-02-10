<?php
$this->title = 'Добавить тип населённого пункта';
?>
<div class="ref-city-type-update">

    <?= $this->render('_form', [
        'model' => $model,
        'button' => 'Применить'
    ]) ?>

</div>
