<?php
$json = json_decode($model['snapshot'],true);
$contacts_phone = $json['phone'];
?>

    <?php if ($ref_importance_id == 4):?>
    <?php $contacts_mail = $json['mail']?>
    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="contacts-phone">
                <table class="table table-condensed">
                    <thead>
                        <th scope="col", class="col-md-6">ФИО</th>
                        <th scope="col", class="col-md-6">Телефон</th>
                    </thead>
                    <tbody>
                        <?php foreach ($contacts_phone as $item):?>
                        <tr>
                            <td scope="row"><?= $item['persons_full_name']?></td>
                            <td scope="row"><?= $item['contact']?></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>    
                </table>
            </div>    
        </div>    
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="contacts-mail">
                <table class="table table-condensed">
                    <thead>
                        <th scope="col", class="col-md-6">ФИО</th>
                        <th scope="col", class="col-md-6">Телефон</th>
                    </thead>
                    <tbody>
                        <?php foreach ($contacts_mail as $item):?>
                        <tr>
                            <td scope="row"><?= $item['persons_full_name']?></td>
                            <td scope="row"><?= $item['contact']?></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>    
                </table>
            </div>
        </div>
    </div>      
    <?php else: ?>
        <table class="table table-condensed">
            <thead>
                <th scope="col", class="col-md-3">ФИО</th>
                <th scope="col", class="col-md-3">Телефон</th>
            </thead>
            <tbody>
                <?php foreach ($contacts_phone as $item):?>
                <tr>
                    <td scope="row"><?= $item['persons_full_name']?></td>
                    <td scope="row"><?= $item['contact']?></td>
                </tr>
                <?php endforeach ?>
            </tbody>    
        </table>
    <?php endif?>   