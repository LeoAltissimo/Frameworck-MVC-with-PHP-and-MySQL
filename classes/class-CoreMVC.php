<?php
/**
 * @author Leo Altíssimo
 * @version 1.0
 * 
 * Nucleo do controlador MVC (Model View Controller)
 */

class CoreMVC{

	/**
	 * Receberá o valor do controlador (Vindo da URL).
	 * exemplo.com/controlador/
	 * @access private
	 */
	private $controlador;
	
	/**
	 * Receberá o valor da ação (Vindo da URL):
	 * exemplo.com/controlador/acao
	 * @access private
	 */
	private $acao;
	
	/**
	 * Receberá um array dos parâmetros (Vindo da URL):
	 * exemplo.com/controlador/acao/param1/param2/param50
	 * @access private
	 */
	private $parametros;
	
	/**
	 * Caminho da página não encontrada
	 * @access private
	 */
	private $not_found = '/includes/404.php';
	
	/**
	 * Responsavel por carregar o controller correto 
	 * seguno a url recebida
	 */
	public function __construct () {
		
		$this->get_url_data();
		
		if ( ! $this->controlador ) {

			// Envaminha para a home
			require_once ABSPATH . '/controllers/home-controller.php';
			
			$this->controlador = new HomeController();
			$this->controlador->index();
			
			return;
		}
		
		if ( ! file_exists( ABSPATH . '/controllers/' . $this->controlador . '.php' ) ) {

			// Pagina não encontrada
			require_once ABSPATH . $this->not_found;

			return;
		}
				

		require_once ABSPATH . '/controllers/' . $this->controlador . '.php';
		$this->controlador = preg_replace( '/[^a-zA-Z]/i', '', $this->controlador );
		
		if ( ! class_exists( $this->controlador ) ) {
			
			// Página não encontrada
			require_once ABSPATH . $this->not_found;

			return;
		}
		
		$this->controlador = new $this->controlador( $this->parametros );
		$this->acao = preg_replace( '/[^a-zA-Z]/i', '', $this->acao );
		

		if ( method_exists( $this->controlador, $this->acao ) ) {
			
			$this->controlador->{$this->acao}( $this->parametros );
			
			return;
		}
		
		if ( ! $this->acao && method_exists( $this->controlador, 'index' ) ) {
			
			$this->controlador->index( $this->parametros );		
			
			return;
		}
		
		require_once ABSPATH . $this->not_found;

		return;
	}
	
	/**
	 * Obtém os vores vindos da url e configura os seguites parametros
	 * $this->controlador, $this->acao e $this->parametros
	 *
	 * A URL tem o seguinte formato:
	 * http://www.example.com/controlador/acao/parametro1/parametro2/etc...
	 */
	public function get_url_data () {
		
		if ( isset( $_GET['path'] ) ) {
	
			$path = $_GET['path'];
			
            $path = rtrim($path, '/');
            $path = filter_var($path, FILTER_SANITIZE_URL);
            
			$path = explode('/', $path);
			
			$this->controlador  = chk_array( $path, 0 );
			$this->controlador .= '-controller';
			$this->acao         = chk_array( $path, 1 );
			

			if ( chk_array( $path, 2 ) ) {
				unset( $path[0] );
				unset( $path[1] );
				
				$this->parametros = array_values( $path );
			}
		}
	
	}
	
}