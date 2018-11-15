<?php
/**
 * @author Leo Altíssimo
 * @version 1.0
 * 
 * Classe Pai para todos controllers
 */
class MainController extends UserLogin
{
	public $db;								// base de dados
	public $phpass;							// Classe phpass @see http://www.openwall.com/phpass/
	public $title;							// Título da página
	public $login_required = false;			// Se a página precisa de login
	public $permission_required = 'any';	// Permissão necessária
	public $parametros = array();			// Parametros enviados pelo usuario
	

	public function __construct ( $parametros = array() ) {
	
		$this->db = new CoreDB();
		$this->phpass = new PasswordHash(8, false);
		$this->parametros = $parametros;
		$this->check_userlogin();
		
	}
	
	/**
	 * Carrega o modelo requisistado pelo controller.
	 * @param model_name Caminho para o modelo
	 */
	public function load_model( $model_name = false ) {
	
		if ( ! $model_name ) return;
		
		// Garante que o nome do modelo tenha letras minúsculas
		$model_name =  strtolower( $model_name );
		
		$model_path = ABSPATH . '/models/' . $model_name . '.php';
		

		if ( file_exists( $model_path ) ) {
		
			require_once $model_path;
			
			$model_name = explode('/', $model_name);
			$model_name = end( $model_name );
			$model_name = preg_replace( '/[^a-zA-Z0-9]/is', '', $model_name );
			
			if ( class_exists( $model_name ) ) 
				return new $model_name( $this->db, $this );


			return;
			
		}
	}

}