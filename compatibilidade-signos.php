<?php // Template Name: compatibilidade-dos-signos ?>

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
						<div class="row">
							<div class="col-md-4 col-xs-4" id="image"><img class="img-responsive" src=""></div>
							<div class="col-md-8 col-xs-8" id="description"></div>
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
								<h2 style='text-align:center; color:#CB00B1;'>Cadastro Astrocentro</h2>
								<p>Você precisa de um cadastro ativo para fazer uma consulta com um tarólogo do Astrocento.<br/>Complete os campos abaixo com seus dados para começar!</br /><a href='http://astrocentro.com.br/consultas/?wl=140&tracker_id=v2_7861'>Você já é cliente?</a></p>
								<iframe src="https://br222.hostgator.com.br/~viden718/projects/astrocentro-v2/index--prod.php?tracker_id=v2_7861" noresize="noresize" width="100%" height="400" scrolling="no" style="border:none; margin-top:20px;"></iframe>
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
				<p>Receba orientações sobre o seu futuro amoroso com nosso jogo de Tarot, online e gratuito.</p>
			</div>

			<div class="col-md-12">
				<h3>Quais são as perspectivas da minha vida amorosa?</h3>
				<p>Por favor, concentre-se em sua pergunta por alguns instantes. Em seguida, escolha uma carta.</p>
			</div>

			<div class="col-md-12 step1">
				<h4>1. Embaralhar as cartas</h4>
				<a href="#step2" class="btn btn-primary btn-lg" role="button" onclick='final_animation()'>Baralhar</a>
			</div>

			<div class="col-md-12 step2">
				<h4 id="step2">2. Selecione uma carta do baralho abaixo</h4>
			</div>

		</div>

		<div id='pack_cont' class='row'>
			<div class="col-md-12">
				<div class='card col-md-1'></div>
			</div>
		</div>


		<div class="row">
			<div class="col-md-12">
				<p>Através do Tarot é possível descobrir as novidades sobre o futuro amoroso, profissional e familiar.</p>
				<p>O Tarot do amor é um oráculo poderoso que te guia ao autoconhecimento e promove o bem-estar, ao te trazer tranquilidade para tomar as decisões corretas.</p>
				<p>Não tenha mais dúvidas sobre o relacionamento, esclareça tudo agora com o jogo do Tarot do amor.</p>
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
