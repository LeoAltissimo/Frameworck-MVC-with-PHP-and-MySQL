<?php
/**
 * @author Leo Altíssimo
 * @version 1.0
 * 
 * Definição de constates e configurações gerais
 */


define( 'ABSPATH', dirname( __FILE__ ) );               // Caminho para a raiz
define( 'UP_ABSPATH', ABSPATH . '/views/_uploads' );    // Caminho para a pasta de uploads
define( 'HOME_URI', 'http://127.0.0.1/bcc_aia' );       // URL da home
define( 'HOSTNAME', 'localhost' );                      // Nome do host da base de dados

define( 'DB_NAME', 'bccaia' );      // Nome do DB
define( 'DB_USER', 'root' );        // Usuário do DB
define( 'DB_PASSWORD', '' );        // Senha do DB
define( 'DB_CHARSET', 'utf8' );     // Charset da conexão PDO

define( 'DEBUG', true );           // Modo Debug


// Carrega o loader, que vai carregar a aplicação inteira
require_once ABSPATH . '/loader.php';

?>