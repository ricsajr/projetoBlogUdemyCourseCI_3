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
							echo form_open('admin/postagem/salvar_alteracoes');//helper para abrir form apónta pro metodo do controller responsável
							foreach($publicacoes as $publicacao) :
							?>
							<div class="form-group">
								<label id="select-categoria">Categoria</label>
								<select id="select-categoria" name="select-categoria" class="form-control">
									<?php  foreach($categorias as $categoria) : ?>
										<option value="<?php echo $categoria->id?>"
											<?php
												if($categoria->id == $publicacao->categoria){
													echo "selected";
												}
											?>
										>
											<?= $categoria->titulo ?></option>
									<?php  endforeach; ?>
								</select>
							</div>
							<div class="form-group">
								<label id="txt-titulo">Titulo </label>
								<input type="text" name="txt-titulo" id="txt-titulo" class="form-control" placeholder="Digite o título da postagem" value="<?= $publicacao->titulo?>">
							</div>
							<div class="form-group">
								<label id="txt-subtitulo">Subtitulo</label>
								<input type="text" name="txt-subtitulo" id="txt-subtitulo" class="form-control" placeholder="Digite o subtitulo da postagem" value="<?= $publicacao->subtitulo?>">
							</div>
							<div class="form-group">
								<label id="txt-conteudo">Conteúdo</label>
								<textarea name="txt-conteudo" id="txt-conteudo" class="form-control"><?= $publicacao->conteudo?></textarea>
							</div>
							<div class="form-group">
								<label id="txt-data">Data</label>
								<input type="datetime-local" name="txt-data" id="txt-data" class="form-control"
									   value="<?php echo strftime('%Y-%m-%dT%H:%M:%S', strtotime($publicacao->data));//estudar formatação ?>">
							</div>
							<input type="hidden" name="txt-usuario" id="txt-usuario" class="form-control" value="<?= $publicacao->user ?>">
							<input type="hidden" name="txt-id" id="txt-id" class="form-control" value="<?= $publicacao->id ?>">


							<button type="submit" class="btn btn-default">Salvar Alterações</button>
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
					<?= 'Imagem de destaque do '.$subtitulo.' existente';?>
				</div>
				<style>
					img{
						width:400px;
					};
				</style>
				<div class="panel-body">

					<div class="row" style="padding-bottom: 10px" >
						<div class="col-lg-8 col-lg-offset-2">
							<?php

							if($publicacao->img == 1) {
								//img() helper do CI
								//informar caminho da imagem
								echo img('assets/frontend/img/publicacoes/' . md5($publicacao->id) . '.jpg');
							}
							else{
								echo img('assets/frontend/img/img/semFoto.jpg');
							}

							?>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">
							<?php
							echo form_open_multipart('admin/postagem/nova_foto');//pesquisar documentação
							$divopen = '<div class="form-group">';
							$divclose = '</div>';
							//adicionando campos do form com helpers do codeigniter
							echo form_hidden('id',md5($publicacao->id));// nome,
							echo $divopen;
							$imagem = array('name' => 'userfile', 'id' => 'userfile', 'class' => 'form-control');
							echo form_upload($imagem);//o identificador deve ser obrigatóriamente 'userfile'
							echo $divclose;
							echo $divopen;
							$botao = array('name' => 'btn-adicionar', 'id' => 'btn-adicionar', 'class' => 'btn btn-default',
									'value' => 'Adicionar nova imagem'
							);
							echo form_submit($botao);
							echo $divclose;
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
