<?php
// este include va a guardar el encabezado o menu del aplicativo
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <a class="navbar-brand" href="principal.php">Appweb</a>
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="principal.php">Principal <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="usuarios.php">Usuarios</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="clientes.php">Clientes</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="productos.php">Productos</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="pedidos.php">Pedidos</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <a href="salir.php" class="btn btn-dark my-2 my-sm-0">Salir</a>
    </form>
  </div>
</nav>