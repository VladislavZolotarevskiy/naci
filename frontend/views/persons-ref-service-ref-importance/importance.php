<?php
use yii\helpers\Html;
use frontend\models\PersonsRefService;
$service = PersonsRefService::ServiceList(['person_ref_service_id' => $person_ref_service_id]);

$this->title = 'Приоритеты для '.$service['refService']['name'];
?>
<div class="importance-change">
    <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th scope="col", class="col-md-0"></th>
                            <th scope="col", class="col-md-6">Приоритет</th>
                            <th scope="col", class="col-md-6">Описание</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($importance_list as 
                                $one): ?>
                            <tr>
                                <td scope="row"><?= Html::a('',[
                                    '/persons-ref-service-ref-importance/delete', 
                                    'id' => $one['id'],
                                    'person_ref_service_id' => $person_ref_service_id], [
                                    'class' => "fa fa-minus text-red",
                                    'title' => "Удалить приоритет",
                                    'data-confirm' =>"Удалить приоритет?",
                                    'data-method' => "post"])?></td>
                                <td scope="row"><?= $one['refImportance']['name']?>
                                </td>
                                <td scope="row"><?= $one['refImportance']['description']?></td>
                                
                            </tr>
                            <?php endforeach ?>
                        <tr>
                            <td scope="row"><?= Html::a('',[
                                '/persons-ref-service-ref-importance/create', 
                                'person_ref_service_id' => $person_ref_service_id],
                                ['class' => 'fa fa-plus text-blue'])?></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
    </table>
</div>
<?= Html::a('Назад', [
            'persons/view',
            'id' => 
                PersonsRefService::personsId($person_ref_service_id)], [
                'class' => 'btn btn-danger']) ?>