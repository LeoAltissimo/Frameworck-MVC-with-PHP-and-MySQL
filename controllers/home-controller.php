<?php
/**
 * home - Controller
 * @author Léo Altíssimo Neto
 */
class HomeController extends MainController
{

	//Load page "/views/home/index.php"
    public function index() {

		$this->title = 'Title of Page';
		
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
    
        // exemple - how load model
		//$modeloMenu =   $this->load_model('menu/menu-model');
		
		/** Load Views **/
        require ABSPATH . '/views/_includes/header.php';
        // require another view here
        require ABSPATH . '/views/_includes/footer.php';
		
    }
}