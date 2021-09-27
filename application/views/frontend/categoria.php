<!-- Page Content -->
<div class="container">

	<div class="row">

		<!-- Blog Entries Column -->
		<div class="col-md-8">

			<h1 class="page-header">
				<?= $titulo ?>
				<small> > <?= $subtitulo ? $subtitulo : $subtitulodb[0]->titulo ?></small>
			</h1>

			<!-- First Blog Post -->

			<?php foreach($postagens as $destaque) :?>

				<h2>
					<a href="<?= base_url('postagem/'.$destaque->id.'/'.limpar($destaque->titulo)); ?>"><?= $destaque->titulo ?></a>
				</h2>
				<p class="lead">
					por <a href="<?= base_url('autor/'.$destaque->idautor.'/'.limpar($destaque->nome)); ?>"><?= $destaque->nome ?></a>
				</p>
				<p><span class="glyphicon glyphicon-time"></span> <?= postadoem($destaque->data); ?> </p>
				<hr>
				<?php

					if($destaque->img == 1) {
						
						$fotopub =  ('assets/frontend/img/publicacoes/' . md5($destaque->id) . '.jpg');
				?>				
						<img class="img-responsive" src=<?= $fotopub ?> alt="">
						<hr>
				<?php } ?>
				<p>
					<?= $destaque->subtitulo ?>
				</p>
				<a class="btn btn-primary" href="<?= base_url('postagem/'.$destaque->id.'/'.limpar($destaque->titulo)); ?>">Leia mais <span class="glyphicon glyphicon-chevron-right"></span></a>

			<?php endforeach; ?>


			<hr>


		</div>
