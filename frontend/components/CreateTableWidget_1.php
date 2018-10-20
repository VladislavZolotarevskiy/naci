<?php
namespace app\components;

use Yii;
use yii\helpers\Html;
use yii\base\Widget;

class CreateTableWidget_1 extends Widget
{
    public $title;
    public $column;
    public $action;
    private $columns;
///    public $

    public function init()
    {

        if ($this->title === null){
            $this->title = 'default';
        }
        if (($this->column === 1)&&($this->action)){
            $this->columns = 
                    '<tr>
                    <th scope="col", class="col-md-0"></th>
                    <th scope="col", class="col-md-12">Населённый пункт</th>
                    </tr>';
        }
        elseif (($this->column === 2)&&($this->action)){
            $this->columns =
                    '<tr>
                    <th scope="col", class="col-md-0"></th>
                    <th scope="col", class="col-md-6">Населённый пункт</th>
                    <th scope="col", class="col-md-6">Населённый пункт</th>
                    </tr>';
        }
        elseif (($this->column === 2)&&(!$this->action)){
            $this->columns =
                    '<tr>
                    <th scope="col", class="col-md-6">Населённый пункт</th>
                    <th scope="col", class="col-md-6">Населённый пункт</th>
                    </tr>';
        }
        else {
            $this->columns = 
                    '<tr>
                <th scope="col", class="col-md-12">Населённый пункт</th>
                </tr>';
        }
    }

    public function run() {
        return
    '<div class="box box-default box-solid collapsed-box">
        <div class="box-header with-border">
        <h3 class="box-title">' . $this->title . '</h3>
        <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" 
        data-widget="collapse"><i class="fa fa-plus"></i>
        </button>
        </div>
        <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="display: none;">
        <table class="table table-striped table-bordered">
            <thead>
                '.$this->columns.'
            </thead>
        <tbody>
				<tr>
					<td scope="row"><?= Html::a('', ['del-cit', 'id' => $one['id'], 'viewid' => $model->id], ['class' => "glyphicon glyphicon-remove text-danger", 'title' => "Удалить контакт", 'data-confirm' => "Удалить контакт?", 'data-method' => "post"])?></td>
					<td scope="row"><?= $one['name']?></td>
				</tr>
				<?php endforeach?>
				<tr>
					<td scope="row"><?= Html::a('', ['add-cit', 'id' => $model->id], ['class' => 'glyphicon glyphicon-plus'])?></td>
					<td></td>
					<td></td>
				</tr>
			</tbody>
        </table>
        
        
        
        </div>
        <!-- /.box-body -->
    </div>'
        ;
    }

}