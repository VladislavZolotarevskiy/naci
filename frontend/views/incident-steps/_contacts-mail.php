<?php
use yii\helpers\Html;?>
<?= $this->render ('_modal')?>
<div class="box box-primary">
    <div class="box-header with-border" style="text-align:center;">
        <h3 class="box-title">E-mail</h3>
    </div>
    <div class="box-body no-padding">
        <table class="table table-condensed">
            <thead>
                <th scope="col", class="col-md-1">#</th>
                <th scope="col", class="col-md-5">ФИО</th>
                <th scope="col", class="col-md-6">Телефон</th>
            </thead>
            <tbody>
                <?php $number=0?>
                <?php foreach ($contacts['mail'] as $item):?>
                <?php $number++ ?>
                <tr>
                    <td scope="row"><?= $number?></td>
                    <td scope="row"><?= $item['persons_full_name']?></td>
                    <td scope="row"><?= $item['contact']?></td>
                </tr>
                <?php endforeach ?>
            </tbody>    
        </table>
    </div>
    <div class="box-footer">
            <?= Html::a('<span class="fa fa-plus"></span> ' .
                'Добавить', ['/incident-steps/snapshot-add','incident_steps_id' => $incident_steps_id], [
                'id' => 'modal-snapshot-mail-add',
                'data-toggle' => 'modal',
                'data-target' => '#modal-snapshot-mail-create',
                'class' => 'btn btn-primary',
                'onclick' => 
                "$('#modal-snapshot-mail-create .modal-dialog .modal-content .modal-body').load($(this).attr('href'))",
                ]) ?>
    </div>    
</div>