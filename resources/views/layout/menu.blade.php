<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
  <a class="navbar-brand" href="#">PRP</a>

  <div class="collapse navbar-collapse">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown_lancamentos" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Lançamentos</a>
        <div class="dropdown-menu" aria-labelledby="dropdown_lancamentos">
          <a class="dropdown-item" href="#">Adicionar</a>
          <a class="dropdown-item" href="<?= route('lancamentos.listar') ?>">Listar</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown_tarefas" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tarefas</a>
        <div class="dropdown-menu" aria-labelledby="dropdown_tarefas">
          <a class="dropdown-item" href="#">Adicionar</a>
          <a class="dropdown-item" href="#">Listar</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown_tags" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tags</a>
        <div class="dropdown-menu" aria-labelledby="dropdown_tags">
          <a class="dropdown-item" href="<?= route('tags.listar') ?>">Listar</a>
        </div>
      </li>
    </ul>
  </div>
</nav>