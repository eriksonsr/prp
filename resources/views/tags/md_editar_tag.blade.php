<div class="modal fade" id="md_editar_tag" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar tag</h5>
        <input type="hidden" name="id_tag" id="id_tag">
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-row">
          <div class="form-group col-md-12">
            <label for="tag">Tag:</label>
            <input type="text" class="form-control" id="edit_input_tag" autofocus="">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" id="bt_salva_edicao_tag" onclick="salvarTagEditada();">Salvar</button>
      </div>
    </div>
  </div>
</div>