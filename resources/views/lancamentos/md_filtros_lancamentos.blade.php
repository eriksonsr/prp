<?php
extract($dados);
?>
<div class="modal fade" id="md_filtrar_lancamento" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Filtrar lançamento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-row">
          <div class="form-group col-md-12">
            <label for="input_filtro_descricao">Descrição:</label>
            <input type="text" class="form-control" id="input_filtro_descricao" autofocus="">
          </div>
          <div class="form-group col-md-6">
            <label for="criterio_valor">Critério valor:</label>
            <select class="form-control" id="criterio_valor">
              <option value="=">=</option>
              <option value=">">></option>
              <option value="<"><</option>
              <option value=">=">>=</option>
              <option value="<="><=</option>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="input_filtro_valor">Valor:</label>
            <input type="text" class="form-control real" id="input_filtro_valor">
          </div>
          <div class="form-group col-md-6">
            <label for="filtro_criterio_data_inicial">Critério data inicial:</label>
            <select class="form-control" id="filtro_criterio_data_inicial">
              <option value="=">=</option>
              <option value=">">></option>
              <option value="<"><</option>
              <option value=">=">>=</option>
              <option value="<="><=</option>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="input_filtro_data">Data inicial:</label>
            <input type="text" class="form-control data" id="input_filtro_data_inicial">
          </div>
          <div class="form-group col-md-6">
            <label for="filtro_criterio_data_final">Critério data final:</label>
            <select class="form-control" id="filtro_criterio_data_final">
              <option value="=">=</option>
              <option value=">">></option>
              <option value="<"><</option>
              <option value=">=">>=</option>
              <option value="<="><=</option>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="input_filtro_data_final">Data final:</label>
            <input type="text" class="form-control data" id="input_filtro_data_final">
          </div>
          <div class="form-group col-md-12" id="input_data">
            <label for="select_filtro_tipo">Tipo:</label>
            <select class="form-control" id="select_filtro_tipo">
              <option value="t">Todas</option>
              <option value="d">Despesa</option>
              <option value="r">Receita</option>
            </select>
          </div>
          <div class="form-group col-md-12">
            <label for="select_filtro_tags">Tags:</label>
            <select class="form-control select_2" id="select_filtro_tags" multiple="">
              @foreach($tags as $t)
                <option value="{{$t->id}}">{{$t->tag}}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="filtrarLancamentos(this);">Filtrar</button>
      </div>
    </div>
  </div>
</div>