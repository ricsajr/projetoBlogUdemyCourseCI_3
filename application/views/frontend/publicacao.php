<!-- Page Content -->
<div class="container">

	<div class="row">

		<!-- Blog Entries Column -->
		<div class="col-md-8">



			<!-- First Blog Post -->

			<?php foreach($postagens as $destaque) :?>

				<h2>
					<?= $destaque->titulo ?>
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



				<p><i><?= $destaque->subtitulo ?></i></p>
				<p>
					<?= $destaque->conteudo ?>
				</p>


			<?php endforeach; ?>


			<hr>


		</div>
