<?php
extract($dados);
?>
<div class="modal fade" id="md_add_lancamento" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Adicionar lançamento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-row">
          <div class="form-group col-md-12">
            <label for="input_descricao">Descrição:</label>
            <input type="text" class="form-control" id="input_descricao" autofocus="">
          </div>
          <div class="form-group col-md-12">
            <label for="input_valor">Valor:</label>
            <input type="text" class="form-control real" id="input_valor">
          </div>
          <div class="form-group col-md-12">
            <label for="input_data">Data:</label>
            <input type="text" class="form-control data" id="input_data">
          </div>
          <div class="form-group col-md-12" id="input_data">
            <label for="select_tipo">Tipo:</label>
            <select class="form-control" id="select_tipo">
              <option value="d">Despesa</option>
              <option value="r">Receita</option>
            </select>
          </div>
          <div class="form-group col-md-12">
            <label for="select_tags">Tags:</label>
            <select class="form-control select_2" id="select_tags" multiple="">
              @foreach($tags as $t)
                <option value="{{$t->id}}">{{$t->tag}}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" onclick="addLancamento(this);">Adicionar</button>
      </div>
    </div>
  </div>
</div>