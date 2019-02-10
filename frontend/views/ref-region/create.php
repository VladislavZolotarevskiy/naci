<?php
$this->title = 'Добавить регион';
?>
<div class="ref-region-create">

    <?= $this->render('_form', [
        'model' => $model,
        'button' => 'Добавить'
    ]) ?>

</div>
