<?php
extract($dados);
?>
<div class="modal fade" id="md_editar_lancamento" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar lançamento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id_lancamento" id="id_lancamento">
        <div class="form-row">
          <div class="form-group col-md-12">
            <label for="edit_input_descricao">Descrição:</label>
            <input type="text" class="form-control" id="edit_input_descricao" autofocus="">
          </div>
          <div class="form-group col-md-12">
            <label for="edit_input_valor">Valor:</label>
            <input type="text" class="form-control real" id="edit_input_valor">
          </div>
          <div class="form-group col-md-12">
            <label for="edit_input_data">Data:</label>
            <input type="text" class="form-control data" id="edit_input_data">
          </div>
          <div class="form-group col-md-12" id="edit_input_data">
            <label for="edit_select_tipo">Tipo:</label>
            <select class="form-control" id="edit_select_tipo">
              <option value="d">Despesa</option>
              <option value="r">Receita</option>
            </select>
          </div>
          <div class="form-group col-md-12">
            <label for="select_tags">Tags:</label>
            <select class="form-control select_2" id="edit_select_tags" multiple="">
              @foreach($tags as $t)
                <option value="{{$t->id}}">{{$t->tag}}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" onclick="SalvarLancamentoEditado(this);">Salvar</button>
      </div>
    </div>
  </div>
</div>