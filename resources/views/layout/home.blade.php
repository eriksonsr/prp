<div class="container-fluid">
    <div class="row" style="margin-top: 8px;">
        <div class="col-lg-6">
            <div class="col-lg-12" id="canvas-holder">
                <canvas id="chart-area"></canvas>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Receitas no mês</h5>
                    <p class="card-text">
                        <strong id="card_v_rec_no_mes"></strong>
                    </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-12" style="margin-top: 8px;">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Despesas no mês</h5>
                    <p class="card-text">
                        <strong id="card_v_desp_no_mes"></strong>
                    </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Receitas no ano</h5>
                    <p class="card-text">
                        <strong id="card_v_rec_no_ano"></strong>
                    </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-12" style="margin-top: 8px;">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Despesas no ano</h5>
                    <p class="card-text">
                        <strong id="card_v_desp_no_ano"></strong>
                    </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="margin-bottom: 50px;">
        <div class="col-lg-6">
            <div class="col-lg-12" id="canvas-holder">
                <canvas id="chart_principais_despesas"></canvas>
            </div>
        </div>
    </div>
</div>
@include('lancamentos.md_add_lancamento')