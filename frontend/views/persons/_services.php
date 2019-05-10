


<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'title',                                           // title свойство (обычный текст)
        'description:html',                                // description свойство, как HTML
        [                                                  // name свойство зависимой модели owner
            'label' => 'Owner',
            'value' => $model->owner->name,            
            'contentOptions' => ['class' => 'bg-red'],     // настройка HTML атрибутов для тега, соответсвующего value
            'captionOptions' => ['tooltip' => 'Tooltip'],  // настройка HTML атрибутов для тега, соответсвующего label
        ],
        'created_at:datetime',                             // дата создания в формате datetime
    ],
]);