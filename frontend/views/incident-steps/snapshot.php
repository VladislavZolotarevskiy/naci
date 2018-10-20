<?php
$json = json_decode($model['snapshot'],true);
if ($ref_importance_id == 4):?>
    <div class="row">
        <div class="col-md-6">
            <b>Телефон</b><br>
            <?php if (isset($json['phone'])):?>
            <?php foreach($json['phone'] as $phone):?>
            <?= $phone.'<br>' ?>
            <?php endforeach ?>
            <?php endif ?>
        </div>    
        <div class="col-md-6">
            <b>E-mail</b><br>
            <?php if (isset($json['mail'])):?>
            <?php foreach($json['mail'] as $mail):?>
            <?= $mail.'<br>' ?>
            <?php endforeach ?>
            <?php endif ?>
        </div>    
    </div>
<?php else :?>
<div class="row">
    <div class="col-md-12">
            <b>Телефон</b><br>
            <?php if (isset($json['phone'])):?>
            <?php foreach($json['phone'] as $phone):?>
            <?= $phone.'<br>' ?>
            <?php endforeach ?>
            <?php endif ?>
    </div>
</div>    
<?php endif ; 
 