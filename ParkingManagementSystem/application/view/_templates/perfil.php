<p class="user">
  <a href="#" class="" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
    <i class="far fa-user"></i> <strong><?= $_SESSION['login']; ?> (<?= ($_SESSION['tipo'] == 2) ? 'Usuario Regular' : 'Administrador' ?>)</strong>&nbsp;
  </a>
</p>
