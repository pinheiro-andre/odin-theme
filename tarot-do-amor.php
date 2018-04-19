<?php /* Template Name: Tarot-do-Amor */ ?>

<?php get_header(); ?>

	<main id="content" class="<?php echo odin_classes_page_full(); ?> tarot-do-amor container" tabindex="-1" role="main">

		<!-- Modal Game -->
		<div class="modal fade in" id="modal_tda" tabindex="-1" role="dialog" aria-labelledby="modal_tda_label" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modal_tda_label"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="container">
							<div class="row justify-content-center">
								<div class="col-sm-6 col-md-6 text-center" id="image"><img class="img-responsive" src=""></div>
								<div class="col-sm-6 col-md-6" id="description"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal Register -->
		<div class="modal fade in" id="modal_tda_register" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">
								<h2 style='text-align:center; color:#D2931E;'>VIDENTES ONLINE</h2>
								<h3 class="text-center" style="color:#D2931E;">CONSULTA DE 10 MINUTOS POR R$ 5</h3>
								<form id="estrala-tarot" style="margin-bottom: 20px" method="post" >
									<div class="form-group">
										<input type="text" class="form-control" id="tda_name" name="name" placeholder="Digite seu nome">
									</div>
									<div class="form-group">
										<input type="text" class="form-control" id="tda_phone" name="phonenumber" placeholder="Digite seu telefone">
									</div>
									<input type="hidden" id="from" value=<?php echo ",tda"; ?> name="from" />
									<button type="submit" class="btn btn-thrive btn-lg btn-block">EU QUERO!</button>
								</form>
								<div class="result alert text-center" role="alert" style="display: none"></div>
								<img src="https://s3-sa-east-1.amazonaws.com/uploads-astrocentro/blog/wp-content/uploads/2013/11/12145548/tarot-mitologico.jpg" class="img-fluid">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<h1 class="col-md-12">Tarot do Amor</h1>

			<div class="col-md-12">
				<p>Descubra no jogo de Tarot do Amor respostas imediatas para as suas dúvidas sobre relacionamentos.</p>
				<p>Receba orientações sobre o seu futuro amoroso com esse jogo de Tarot online e gratuito.</p>
			</div>

			<div class="col-md-12">
				<h3>Quais são as perspectivas da minha vida amorosa?</h3>
				<p>Por favor, concentre-se em sua pergunta por alguns instantes. Em seguida siga os passos abaixo:</p>
			</div>

			<div class="col-md-12 step1">
				<h4>1. Embaralhe as cartas</h4>
				<a href="#step2" class="btn btn-primary btn-lg" role="button" onclick='final_animation()'>Embaralhar!</a>
			</div>

			<div class="col-md-12 step2">
				<h4 id="step2">2. Selecione a sua carta</h4>
			</div>

		</div>

		<div id='pack_cont' class='row'>
			<div class="col-md-12">
				<div class='card col-md-1'></div>
			</div>
		</div>


		<div class="row">
			<div class="col-md-12">
				<p>Através do Tarot é possível descobrir o que o futuro reserva para a sua vida amorosa, profissional e familiar.</p>
				<p>O Tarot do Amor é um oráculo poderoso que te leva ao autoconhecimento e promove o bem-estar, trazendo a tranquilidade necessária para que você tome as decisões corretas.</p>
				<p>Não tenha mais dúvidas sobre o seu relacionamento, esclareça tudo agora com o jogo do Tarot do Amor!</p>
			</div>
		</div>

			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

					// Include the page content template.
					//get_template_part( 'content', 'page' );
					get_template_part( 'content-jogo' );
				endwhile;
			 ?>

	</main><!-- #main -->

<?php
get_footer();
