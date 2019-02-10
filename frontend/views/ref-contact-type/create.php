<?php
$this->title = 'Добавить тип контакта';
?>
<div class="ref-contact-type-create">

    <?= $this->render('_form', [
        'model' => $model,
        'button' => 'Добавить'
    ]) ?>

</div>
