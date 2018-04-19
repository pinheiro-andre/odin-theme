<?php
/*
 * Developed by Leandro [leandro.barbosa@wengo.com] on 22/07/2016
 *
 * This script change the cache "cache_experts_tabs" on astrocentrobr DB
 *
 * Its called only by crontab to avoid overload the server
 *
 */
//ini_set('display_startup_errors', 1); ini_set('display_errors', 1); error_reporting(-1);


function get_experts_tabs($atts){

	if(isset($atts)){

		$atts = shortcode_atts(
			array(
				'zone' => 'sidebar'
			),
			$atts
		);
	}

	if($atts['zone'] == 'sidebar'){

		return get_transient('wengo_sense_sidebar');

	}elseif($atts['zone'] == 'menu_mobile'){

		return get_transient('wengo_sense_menu_mobile');

	}

}


/*
 * This function get all experts from ws.wengo.fr
 */
function set_experts_tabs(){


	$atts = shortcode_atts(
		array(
			'zone' => 'sidebar'
		),
		$atts
	);

	$tracker = 'v2_11560';

	$ws = "https://ws.wengo.fr/expert/server.php";
	$get_experts = array();
	$get_experts['apikey'] = '465b9b364090bec46deabece391b0188';
	$get_experts['t9n'] = 'por';
	$get_experts['i18n'] = 'bra';
	$get_experts['directory'] = '1270';
	$get_experts['wl'] = '140';
	$get_experts['sort_type'] = '4';
	$get_experts['private_tag'] = '';
	$get_experts['limit'] = '4';

	$data_s = '?method=search_expert_with_last_rating_v1&apikey='.$get_experts['apikey'].'&t9n='.$get_experts['t9n'].'&i18n='.$get_experts['i18n'].'&directory='.$get_experts['directory'].'&wl='.$get_experts['wl'].'&sort_type='.$get_experts['sort_type'].'&private_tag='.$get_experts['private_tag'].'&limit='.$get_experts['limit'].'';

	$url = $ws.$data_s;

	//  Initiate curl
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FAILONERROR, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 1);
	curl_setopt($ch, CURLOPT_URL, $url);
	$result = curl_exec($ch);
	curl_close($ch);

	$result = file_get_contents($url);
	$get_experts_most_consulted = json_decode($result, true);
	//var_dump ($get_experts_most_consulted);

	if(!$get_experts_most_consulted)
			return 0;

	$content = '';

		//if($atts['zone'] == 'sidebar'){
			foreach ($get_experts_most_consulted['data'] as $expert_mc):
				/* most consulted */
				$expert_mc_name = ucfirst(strtolower($expert_mc['title']));
				$expert_mc_job_title = ucfirst(mb_strtolower($expert_mc['speciality_tag_cache'],'UTF-8'));
				$expert_mc_link = $expert_mc['url'];
				$expert_mc_link .= '&tracker_id='.$tracker;
				$expert_mc_photo = $expert_mc['photo'];
				$expert_mc_rated = $expert_mc['satisfaction_rate'].'%';
				$expert_mc_consultations = $expert_mc['total_call_count'] + $expert_mc['total_chat_count'];
				$expert_mc_description = $expert_mc['description'];
				$expert_mc_rate = number_format($expert_mc['satisfaction_rate'], 0, '', '') . '%';
				$expert_mc_nb_consults = $expert_mc['total_call_count'] + $expert_mc['total_chat_count'];

					if (strlen($expert_mc_description) > 100)
					   $expert_mc_description = substr($expert_mc_description, 0, 96) . '...';

				$content .= '
						<div class="wg-card">
							<div class="wg-card-top d-flex">
								<a href="'.$expert_mc_link.'" title="'.$expert_mc_name.'" class="wg-card-link">
									<img src="'.$expert_mc_photo.'" alt="'.$expert_mc_name.'" class="wg-card-img">

									<div class="wg-card-info">
										<h3 class="wg-card-name"><a href="'.$expert_mc_link.'" title="'.$expert_mc_name.'">'.$expert_mc_name.'</a></h3>
										<p class="wg-card-tags">'.$expert_mc_job_title.'</p>
										<p class="wg-card-tags"><strong>'.$expert_mc_rate.'</strong> '.__('Avaliações positivas','odin').'</p>
										<p class="wg-card-tags"><strong>'.$expert_mc_nb_consults.'</strong> '.__('Consultas','odin').'</p>
									</div>
								</a>
							</div>
							<div class="wg-card-bottom">
								<a href="'.$expert_mc_link.'" title="'.$expert_mc_name.'" class="wg-card-link"><button class="btn call-specialist" type="button">'.__( 'Ligar agora', 'odin' ).'</button></a>
							</div>
						</div>
				';


			endforeach;


		set_transient('wengo_sense_sidebar', $content, 60*60);

		//elseif($atts['zone'] == 'menu_mobile'){

			$content = '';

			$content .= '
			<!-- swip experts -->
			<div class="swiper-container">
				<div class="swiper-wrapper">

			';
			foreach ($get_experts_most_consulted['data'] as $expert_mc):
				/* most consulted */
				$expert_mc_name = ucfirst(strtolower($expert_mc['title']));
				$expert_mc_job_title = ucfirst(mb_strtolower($expert_mc['speciality_tag_cache'],'UTF-8'));
				$expert_mc_link = $expert_mc['url'];
				$expert_mc_link .= '&tracker_id='.$tracker;
				$expert_mc_photo = $expert_mc['photo'];
				$expert_mc_rated = $expert_mc['satisfaction_rate'].'%';
				$expert_mc_consultations = $expert_mc['total_call_count'] + $expert_mc['total_chat_count'];
				$expert_mc_description = $expert_mc['description'];
				if (strlen($expert_mc_description) > 100)
				   $expert_mc_description = substr($expert_mc_description, 0, 96) . '...';

				$content .= '
					<div class="swiper-slide d-flex justify-content-center">
						<div class="wg-card">
						    <a href="'.$expert_mc_link.'" title="'.$expert_mc_name.'" class="wg-card-link d-flex justify-content-center">
						        <img src="'.$expert_mc_photo.'" alt="'.$expert_mc_name.'" class="wg-card-img">
								<div class="wg-card-info">
									<h3 class="wg-card-name">'.$expert_mc_name.'</h3>
									<p class="wg-card-tags">'.$expert_mc_job_title.'</p>
									<div class="wg-card-bottom">
										<button class="btn btn-sm">Consultar agora</button>
									</div>
								</div>
						    </a>
						</div>
					</div>
				';


			endforeach;

			$content .= '
				</div>
				<!-- Add Arrows -->
				<div class="swiper-button-next"></div>
				<div class="swiper-button-prev"></div>
			</div>

			';

	set_transient('wengo_sense_menu_mobile', $content, 60*60);

}

add_shortcode('wengosense','get_experts_tabs');
add_shortcode('set_wengosense','set_experts_tabs');





/* AstroShopSense */
function get_astroshopping_products($atts){
	if(isset($atts)){
		$atts = shortcode_atts(
			array(
				'zone' => 'sidebar',
			),
			$atts
		);
	}

	if($atts['zone'] == 'sidebar'){
		return get_transient('astroshopping_sense_sidebar');
	}elseif($atts['zone'] == 'article'){
		return get_transient('astroshopping_sense_article');
	}
}

function set_astroshopping_products() {

	$headers    = [];
	$headers[]  = 'Accept: application/json';
	$headers[]  = 'Content-Type: application/json';
	$headers[]  = 'token: dQnlwHUCbHojgtR0u4zDOzC7ytOsGU';

	$url_api = "http://api.agileecommerce.com.br/ConsultarProdutos?codcategoria=27887&limit=2&novidade=s";

	$curl = curl_init($url_api);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($curl, CURLOPT_HEADER, 1);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($curl, CURLOPT_COOKIESESSION, 1);
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');

	$result = curl_exec($curl);
	curl_close($curl);

	$header_size = strpos($result, "{");
	$products = substr($result, $header_size);
	$products = json_decode($products, true);

//sidebar
	$content = '';
		foreach ($products['produtos'] as $product):
			$name = ucfirst(strtolower($product['nome']));
			$cdn = 'https://astroshopping.agilecdn.com.br/';
			$url = 'https://www.astroshopping.com.br/'.$product['url'].'?utm_source=astrocentro&utm_medium=astrosense';
			$image = $product['imagem'];
			$price = $product['preco'];

			$x ++;
			echo $x.'\n';
			$content .= '
				<div class="card p-1 card-outline-primary astroshopping">
					<a href="'.$url.'" target="_blank"><h4><span>'.$name.'</span></h4></a>
					<a href="'.$url.'" target="_blank"><img src="'.$cdn.$image.'" alt="'.$name.'" class="img-fluid"></a>
					<a href="'.$url.'" class="btn btn-block call-specialist" target="_blank">Comprar por R$'.$price.'</a>
				</div>
			';

		endforeach;
	$content .= '';
	// set_transient('astroshopping_sense_sidebar', '', 60*60);
	// set_transient('astroshopping_sense_sidebar', $content, 60*60);


//Article
	$content = '<div class="card-columns">';
		foreach ($products['produtos'] as $product):
			$name = ucfirst(strtolower($product['nome']));
			$cdn = 'https://astroshopping.agilecdn.com.br/';
			$url = 'https://www.astroshopping.com.br/'.$product['url'].'?utm_source=astrocentro&utm_medium=astrosense';
			$image = $product['imagem'];
			$price = $product['preco'];

			$content .= '
				<div class="card p-1 card-outline-primary astroshopping">
					<a href="'.$url.'" target="_blank"><h4><span>'.$name.'</span></h4></a>
					<a href="'.$url.'" target="_blank"><img src="'.$cdn.$image.'" alt="'.$name.'" class="img-fluid"></a>
					<a href="'.$url.'" class="btn btn-block" target="_blank">Comprar por R$'.$price.'</a>
				</div>
			';

		endforeach;
	$content .= '</div>';
	// set_transient('astroshopping_sense_article', '', 60*60);
	// set_transient('astroshopping_sense_article', $content, 60*60);

}

add_shortcode('astroshoppingsense','get_astroshopping_products');
add_shortcode('set_astroshoppingsense','set_astroshopping_products');

?>
