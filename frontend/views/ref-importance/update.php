<?php
$this->title = 'Добавить приоритет';
?>
<div class="ref-importance-update">
    <?= $this->render('_form', [
        'model' => $model,
        'button' => 'Применить'
    ]) ?>

</div>