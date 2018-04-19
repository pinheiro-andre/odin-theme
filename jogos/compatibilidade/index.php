<?php

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

include "class-SignsGame.php";

$obj = new SignsGame();
?>

<div id="ajax-loader"><img src="../../wp-content/themes/odin/jogos/compatibilidade/img/preloader.gif" /></div>

<div id="jogo-compatibilidade-de-signos">

    <div class="modal fade" tabindex="-1" role="dialog" id="warning-modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Cadastra-se</h4>
          </div>
          <div class="modal-body">
            <h4 class="text-warning text-center">Já fez <span></span> compatibilidades de signos</h4>
          </div>
        </div>
      </div>
    </div>



        <div class="container-fluid">

            <div class="row">


                <div id="desktop-desk" class="row">
                    <div class="card-deck col-md-12"></div>
                    <form id="play-desk" class="col-md-12">
                        <button type="submit" name='combinar' id='signs_play' class="btn btn-action btn-lg btn-block" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Aguarde">Combinar os Signos</button>
                    </form>
                </div>

                <div id="mobile-desk" class="col-md-12">
                    <form class="form-inline" id="play-mobile">
                        <div class="form-group col-xs-6 col-md-6 text-center">
                            <label for="sign1" class="text-center">Seu signo</label>
                            <select class="form-control" id="Sign1" name="sign1" required><?php echo $obj->get_signs() ?></select>
                            <img id="sign1-image" class="img-responsive" src=''>
                        </div>
                        <div class="form-group col-xs-6 col-md-6 text-center" style="margin: 1rem 0 3rem;">
                            <label for="sign2" class="text-center">Signo dele(a)</label>
                            <select class="form-control col-md-12" id="Sign2" name="sign2" required><?php echo $obj->get_signs() ?></select>
                            <img id="sign2-image" class="img-responsive" src=''>
                        </div>

                        <button type="submit" name='combinar' id='signs_play' class="btn btn-action btn-lg btn-block" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Aguarde">Combinar os Signos</button>
                    </form>
                </div>

    <!-- results -->
                <div class="row" id="anwser">

                    <h3 class="col-md-12">Veja o resultado dos Signos selecionados</h3>

                    <div class="tab-group col-md-12">

            			<!-- start tab-1 -->
            			<div class="tab" id="love">
            				<input id="tab-1" type="radio" name="tabs">
            				<label for="tab-1" >Amor <div id="love-score" class="starrr" data-rating=''></div> <i class="fa fa-chevron-down" aria-hidden="true"></i></label>
            				<div class="tab-content">
                                <h4><strong class="sign1"></strong> e <strong class="sign2"></strong> no amor</h4>
                                <p></p>
            				</div>
            			</div>
            			<!-- end tab-1 -->

            			<!-- start tab-2 -->
            			<div class="tab" id="work">
            				<input id="tab-2" type="radio" name="tabs">
            				<label for="tab-2" >Trabalho <div id="work-score" class="starrr" data-rating=''></div> <i class="fa fa-chevron-down" aria-hidden="true"></i></label>
            				<div class="tab-content">
                                <h4><strong class="sign1"></strong> e <strong class="sign2"></strong> no trabalho</h4>
                                <p></p>
            				</div>
            			</div>
            			<!-- end tab-2 -->

            			<!-- start tab-3 -->
            			<div class="tab" id="friendship">
            				<input id="tab-3" type="radio" name="tabs">
            				<label for="tab-3" >Amizade <div id="friendship-score" class="starrr" data-rating=''></div> <i class="fa fa-chevron-down" aria-hidden="true"></i></label>
            				<div class="tab-content">
                                <h4><strong class="sign1"></strong> e <strong class="sign2"></strong> na amizade</h4>
                                <p></p>
            				</div>
            			</div>
            			<!-- end tab-3 -->

            			<!-- start tab-4 -->
            			<div class="tab" id="sex">
            				<input id="tab-4" type="radio" name="tabs">
            				<label for="tab-4" >Sexo <div id="sex-score" class="starrr" data-rating=''></div> <i class="fa fa-chevron-down" aria-hidden="true"></i></label>
            				<div class="tab-content">
                                <h4><strong class="sign1"></strong> e <strong class="sign2"></strong> no sexo</h4>
                                <p></p>
            				</div>
            			</div>
            			<!-- end tab-4 -->

            		</div>

                    <p class="col-md-12 text-center"><a href="#" class="btn btn-outline-info bt_again">Refazer</a></p>

              </div>

    <!-- end results -->

        </div>
    </div>

</div>
