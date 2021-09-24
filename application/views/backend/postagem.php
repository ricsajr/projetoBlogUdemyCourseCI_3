<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"><?= 'Administrar '.$subtitulo ?></h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<?= 'Adicionar nova '.$subtitulo ?>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<?php
							echo validation_errors('<div class="alert alert-danger">','</div>');//helper para trazer os erros da validação do form no controller
							echo form_open('admin/postagem/inserir');//helper para abrir form apónta pro metodo do controller responsável
							?>
							<div class="form-group">
								<label id="select-categoria">Categoria</label>
								<select id="select-categoria" name="select-categoria" class="form-control">
									<?php  foreach($categorias as $categoria) : ?>
										<option value="<?php echo $categoria->id?>"><?= $categoria->titulo ?></option>
									<?php  endforeach; ?>
								</select>
							</div>
							<div class="form-group">
								<label id="txt-titulo">Titulo </label>
								<input type="text" name="txt-titulo" id="txt-titulo" class="form-control" placeholder="Digite o título da postagem" value="<?= set_value('txt-titulo')?>">
							</div>
							<div class="form-group">
								<label id="txt-subtitulo">Subtitulo</label>
								<input type="text" name="txt-subtitulo" id="txt-subtitulo" class="form-control" placeholder="Digite o subtitulo da postagem" value="<?= set_value('txt-subtitulo')?>">
							</div>
							<div class="form-group">
								<label id="txt-conteudo">Conteúdo</label>
								<textarea name="txt-conteudo" id="txt-conteudo" class="form-control"><?= set_value('txt-historico')?></textarea>
							</div>
							<div class="form-group">
								<label id="txt-data">Data</label>
								<input type="datetime-local" name="txt-data" id="txt-data" class="form-control" value="<?= set_value('txt-data')?>">
							</div>
							<input type="hidden" name="txt-usuario" id="txt-usuario" class="form-control" value="<?= $this->session->userdata('userlogado')->id; ?>">

							<button type="submit" class="btn btn-default">Publicar</button>
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
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<?= 'Alterar '.$subtitulo.' existente' ?>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<style>
								img{
									width: 60px;
								}
							</style>
							<?php
							$this->table->set_heading("Foto","Titulo", "Alterar", "Data","Excluir"); // cabeçalho da tabela
							//criando as linhas da tabela
							foreach($publicacoes as $publicacao){
								$fotopub = "Foto";
								$data = postadoem($publicacao->data);
								$titulo= $publicacao->titulo;
								$alterar= anchor(base_url('admin/postagem/alterar/'.md5($publicacao->id)),'<i class="fa fa-refresh fa-fw"></i> Alterar');
								$excluir= anchor(base_url('admin/postagem/excluir/'.md5($publicacao->id)),'<i class="fa fa-remove fa-fw"></i> Excluir');

								$this->table->add_row($fotopub,$titulo,$alterar,$data,$excluir);
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
