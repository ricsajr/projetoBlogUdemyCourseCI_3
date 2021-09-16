<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"><?= 'Administrar '.$subtitulo ?></h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<?= 'Adicionar novo '.$subtitulo ?>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<?php
								echo validation_errors('<div class="alert alert-danger">','</div>');//helper para trazer os erros da validação do form no controller
								echo form_open('admin/usuarios/salvar-alteracoes');//helper para abrir form apónta pro metodo do controller responsável
								foreach($usuarios as $usuario) :
							?>
							<div class="form-group">
								<label id="txt-nome">Nome do Usuário</label>
								<input type="text" name="txt-nome" id="txt-nome" class="form-control" placeholder="Digite o nome do usuário" value="<?= $usuario->nome?>">
							</div>
							<div class="form-group">
								<label id="txt-email">Email</label>
								<input type="text" name="txt-email" id="txt-email" class="form-control" placeholder="Digite o email do usuário" value="<?= $usuario->email ?>">
							</div>
							<div class="form-group">
								<label id="txt-historico">Histórico</label>
								<textarea name="txt-historico" id="txt-historico" class="form-control"><?= $usuario->historico ?></textarea>
							</div>
							<div class="form-group">
								<label id="txt-user">User</label>
								<input type="text" name="txt-user" id="txt-user" class="form-control" placeholder="Digite o username" value="<?= $usuario->user ?>">
							</div>
							<div class="form-group">
								<label id="txt-senha">Senha</label>
								<input type="password" name="txt-senha" id="txt-senha" class="form-control" >
							</div>
							<div class="form-group">
								<label id="txt-confirmarsenha">Confirmar Senha</label>
								<input type="password" name="txt-confirmarsenha" id="txt-confirmarsenha" class="form-control">
							</div>
							<input type="hidden" name="txt-id" id="txt-id" class="form-control" value="<?= $usuario->id?>">
							<button type="submit" class="btn btn-default">Cadastrar</button>
							<?php
								echo form_close();
								endforeach;
							?>

						</div>

					</div>
					<!-- /.row (nested) -->
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-6 -->
		<div class="col-lg-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<?= 'Alterar '.$subtitulo.' existente' ?>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<?= 'Imagem de destaque do '.$subtitulo.' existente' ?>
						</div>

					</div>
					<!-- /.row (nested) -->
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-6 -->
	</div>
	<!-- /.row -->
</div>

<!--
<form role="form">
	<div class="form-group">
		<label>Titulo</label>
		<input class="form-control" placeholder="Entre com o texto">
	</div>
	<div class="form-group">
		<label>Foto Destaque</label>
		<input type="file">
	</div>
	<div class="form-group">
		<label>Conteúdo</label>
		<textarea class="form-control" rows="3"></textarea>
	</div>

	<div class="form-group">
		<label>Selects</label>
		<select class="form-control">
			<option>1</option>
			<option>2</option>
			<option>3</option>
			<option>4</option>
			<option>5</option>
		</select>
	</div>
	<button type="submit" class="btn btn-default">Cadastrar</button>
	<button type="reset" class="btn btn-default">Limpar</button>
</form>
-->
