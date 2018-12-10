<?php
use yii\helpers\Html;?>
<div class="box box-primary">
    <div class="box-header with-border" style="text-align:center;">
        <h3 class="box-title">Телефон</h3>
    </div>
    <div class="box-body no-padding">
        <table class="table table-condensed">
            <thead>
                <th scope="col", class="col-md-1">#</th>
                <th scope="col", class="col-md-6">ФИО</th>
                <th scope="col", class="col-md-6">Телефон</th>
            </thead>
            <tbody>
                <?php $number=0?>
                <?php foreach ($contacts['phone'] as $item):?>
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
                'id' => 'modal-snapshot-phone-create',
                'data-toggle' => 'modal',
                'data-target' => '#modal-snapshot-phone-create',
                'class' => 'btn btn-primary',
                'onclick' => 
                "$('#modal-snapshot-phone-create .modal-dialog .modal-content .modal-body').load($(this).attr('href'))",
                ]) ?>
    </div>    
</div>