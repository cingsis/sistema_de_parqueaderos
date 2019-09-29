
	<div class="container div-login">
      <h1 class="text-center title">Sistema Administrador de Parqueaderos</h1>
			<br/>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-3">
					&nbsp;
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6">
					<?php if (isset($_SESSION['message']) && isset($_SESSION['type']) &&
										$_SESSION['type'] == "danger"): ?>

						<div class="alert alert-<?= $_SESSION['type'] ?>" role="alert">
							<i class="far fa-angry fa-2x"></i>&nbsp;&nbsp;<?= $_SESSION['message']; ?>
						</div>

					<?php session_unset(); ?>
					<?php endif; ?>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-3">
					&nbsp;
				</div>
			</div>

			<form class="form-horizontal" action="<?= URL; ?>home/validate" method="post" autocomplete="off">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-4">
					<p>&nbsp;</p>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group top">
							<label for="Usuario">Usuario</label>
						</div>
						<div class="form-group text-field">
							<input type="text" name="usuario" class="form-control input" id="Usuario" autofocus="true" placeholder="Ingrese su Usuario" required="true">
						</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-4">
					<p>&nbsp;</p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-4">
					<p>&nbsp;</p>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-4">
				<div class="form-group top">
							<label for="Contrasenia">Contraseña</label>
						</div>
						<div class="form-group text-field">
							<input type="password" name="contrasenia" class="form-control input" id="Contrasenia" placeholder="Ingrese su Contraseña" required="true">
						</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-4">
					<p>&nbsp;</p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-4">
					<p>&nbsp;</p>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-4 top">
					<div class="form-group text-center">
						<input type="submit" name="login" value="Ingresar" id="Login" class="btn btn-login">
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-4">
					<p>&nbsp;</p>
				</div>
			</div>
		</form>
	</div>
