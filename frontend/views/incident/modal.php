<div class="modal fade in" id=<?= $modal_id ?> style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
              <h4 class="modal-title"><?= $modal_title ?></h4>
            </div>
            <div class="modal-body">
              <i class="fa fa-refresh fa-spin"></i>
            </div>
            <?php if ($footer == true):?>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary accept" data-dismiss="modal">Принять</button>
            </div>
            <?php endif ?>
        </div>
      <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>