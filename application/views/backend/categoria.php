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
					<?= 'Adicionar nova '.$subtitulo ?>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<?php
								echo validation_errors('<div class="alert alert-danger">','</div>');//helper para trazer os erros da validação do form no controller
								echo form_open('admin/categoria/inserir');//helper para abrir form apónta pro metodo do controller responsável
							?>
								<div class="form-group">
									<label id="txt-categoria">Nome da categoria</label>
									<input type="text" name="txt-categoria" id="txt-categoria" class="form-control" placeholder="Digite o nome da categoria">
								</div>
								<button type="submit" class="btn btn-default">Cadastrar</button>
							<?php
								echo form_close();
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
							<?php
								$this->table->set_heading("Nome da categoria", "Alterar", "Excluir"); // cabeçalho da tabela
								//criando as linhas da tabela
								foreach($categorias as $categoria){
									$nomecat= $categoria->titulo;
									$alterar= anchor(base_url('admin/categoria'),'<i class="fa fa-refresh fa-fw"></i> Alterar');
									$excluir= anchor(base_url('admin/categoria/excluir/'.md5($categoria->id)),'<i class="fa fa-remove fa-fw"></i> Excluir');

									$this->table->add_row($nomecat,$alterar,$excluir);
								}
								//formatando a tabela
								$this->table->set_template(array(
										'table_open' => '<table class="table table-striped">'
								));
								//gerando a tabela
								echo $this->table->generate();

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
