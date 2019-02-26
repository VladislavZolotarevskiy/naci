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
                <th scope="col", class="col-md-6">ФИО</th>
                <th scope="col", class="col-md-6">e-mail</th>
                <th scope="col", class="col-md-1"></th>
            </thead>
            <?php if (isset($contacts['mail'][0])):?>
            <tbody>
                <?php foreach ($contacts['mail'] as $key=>$item):?>
                <tr>
                    <td scope="row"><?= $counter=$key+1?></td>
                    <td scope="row"><?= $item['persons_full_name']?></td>
                    <td scope="row"><?= $item['contact']?></td>
                    <?php if ($item['persons_id'] == 0):?> 
                    <td scope="row"><?=Html::a('', [
                                        'snapshot-delete',
                                        'id' => $key,
                                        'contact_type' => 2,
                                        'incident_steps_id' => $incident_steps_id], [
                                        'class' => "fa fa-remove text-red",
                                        'title' => "Удалить из рассылки",
                                        'data-confirm' => "Удалить из "
                                            . "рассылки?",
                                        'data-method' => "post"])?></td>
                    <?php endif ?>
                </tr>
                <?php endforeach ?>
            </tbody>   
            <?php else :?>
            <tbody>
                <tr>
                    <td colspan="3" style="text-align:center;">
                        Контакты отсутствуют
                    </td>
                </tr>
            </tbody>
            <?php endif ?>
        </table>
    </div>
    <div class="box-footer">
            <?= Html::a('<span class="fa fa-plus"></span> ' .
                'Добавить', ['/incident-steps/snapshot-add','incident_steps_id' => $incident_steps_id, 'contact_type' => 2], [
                'id' => 'modal-snapshot-mail-add',
                'data-toggle' => 'modal',
                'data-target' => '#modal-snapshot-mail-create',
                'class' => 'btn btn-primary',
                'onclick' => 
                "$('#modal-snapshot-mail-create .modal-dialog .modal-content .modal-body').load($(this).attr('href'))",
                ]) ?>
    </div>    
</div>