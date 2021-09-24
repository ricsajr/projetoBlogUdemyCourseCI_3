
<!-- Page Content -->
<div class="container">

	<div class="row">

		<!-- Blog Entries Column -->
		<div class="col-md-8">

			<h1 class="page-header">
				<?= $titulo ?>
				<small> > <?= $subtitulo ?></small>
			</h1>

			<div class="col-md-12 ">

				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

			</div>
			<br>
			<h1 class="page-header">
				Nossos autores
			</h1>
			<div class="col-md-12 row">

			<?php foreach($autores as $autor) :?>
					<div class="col-md-4  col-xs-6">
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
						<h4 class="text-center">
							<a href="<?= base_url('autor/'.$autor->id.'/'.limpar($autor->nome)) ?>"><?= $autor->nome ?></a>
						</h4>
					</div>
			<?php endforeach; ?>



			</div>





		</div>
