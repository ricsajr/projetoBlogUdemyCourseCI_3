
<!-- Page Content -->
<div class="container">

	<div class="row">

		<!-- Blog Entries Column -->
		<div class="col-md-8">

			<h1 class="page-header">
				<?= $titulo ?>
				<small> > <?= $subtitulo ?></small>
			</h1>

			<!-- First Blog Post -->

			<?php foreach($autores as $autor) :?>
				<div class="col-md-4">
					<?php

					if($autor->img == 1) {
						//img() helper do CI
						//informar caminho da imagem
						$mostraImg = 'assets/frontend/img/usuarios/' . md5($autor->id) . '.jpg';
					}
					else{
						$mostraImg = 'assets/frontend/img/img/semFoto.jpg';
					}

					?>
					<img class="img-responsive img-circle" src="<?= base_url($mostraImg)?>" alt="">
				</div>
				<div class="col-md-8 ">
					<h2>
						<?= $autor->nome ?>
					</h2>
					<hr>
					<p>
						<?= $autor->historico ?>
					</p>

					<hr>
				</div>
			<?php endforeach; ?>




		</div>
