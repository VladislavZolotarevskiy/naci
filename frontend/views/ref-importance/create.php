<?php
$this->title = 'Добавить приоритет';
?>
<div class="ref-importance-create">
    <?= $this->render('_form', [
        'model' => $model,
        'button' => 'Добавить'
    ]) ?>

</div>
