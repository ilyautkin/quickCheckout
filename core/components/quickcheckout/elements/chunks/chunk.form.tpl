<div class="modal fade" id="QCorderModal" tabindex="-1" role="dialog" aria-labelledby="QCorderModalLabel">
  <div class="modal-dialog" role="document">
    <form action="" method="post" class="ajax_form modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="QCorderModalLabel">Оформление покупки</h4>
      </div>
      <div class="modal-body">
        <textarea class="QCproductOuter" id="af_product" name="product"></textarea>
        
        <div id="QCproductRowHandler"></div>
        
        <div class="form-group">
            <label class="control-label" for="af_name">Ваше имя</label>
            <div class="controls">
                <input type="text" id="af_name" name="name" value="" placeholder="" class="form-control"/>
                <span class="error_name"></span>
            </div>
        </div>
    
        <div class="form-group">
            <label class="control-label" for="af_phone">Телефон</label>
            <div class="controls">
                <input type="text" id="af_phone" name="phone" value="" placeholder="" class="form-control"/>
                <span class="error_phone"></span>
            </div>
        </div>
    
        <div class="form-group">
            <label class="control-label" for="af_address">Адрес</label>
            <div class="controls">
                <textarea id="af_address" name="address" class="form-control" rows="5"></textarea>
                <span class="error_address"></span>
            </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
        <button type="submit" class="btn btn-primary">Отправить заказ</button>
      </div>
    </form>
  </div>
</div>
