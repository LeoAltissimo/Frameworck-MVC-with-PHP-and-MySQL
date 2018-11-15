<?php
/**
 * @author Leo Altíssimo
 * @version 1.0
 * 
 * Funcoes do core do programa
 */


/**
 * Verifica chaves de array se existe E se ela tem algum valor.
 *
 * @param array  $array O array
 * @param string $key   A chave do array
 * @return string|null  O valor da chave do array ou nulo
 */
function chk_array ( $array, $key ) {
	
	if ( isset( $array[ $key ] ) && ! empty( $array[ $key ] ) )
		return $array[ $key ];
	
	return null;
}

/**
 * Função para carregar automaticamente todas as classes padrão
 * O nome do arquivo deverá ser class-NomeDaClasse.php.
 */
function load_auto($class_name) {
	$file = ABSPATH . '/classes/class-' . $class_name . '.php';
	
	if ( ! file_exists( $file ) ) {
		require_once ABSPATH . '/includes/404.php';
		return;
	}
	
	// Inclui o arquivo da classe
    require_once $file;
}

spl_autoload_register('load_auto');