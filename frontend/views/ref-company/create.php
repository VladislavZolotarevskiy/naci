<?php
$this->title = 'Добавить компанию';
?>
<div class="ref-company-create">

    <?= $this->render('_form', [
        'model' => $model,
        'button' => 'Добавить'
    ]) ?>

</div>
