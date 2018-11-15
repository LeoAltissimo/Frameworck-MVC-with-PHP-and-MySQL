<?php
/**
 * @author Leo Altíssimo
 * @version 1.0
 * 
 * Carrega Funcoes do core do programa
 */


// Evita que usuários acesse este arquivo diretamente
if ( ! defined('ABSPATH')) exit;
 
// Inicia a sessão
session_start();

// Verifica o modo debug
if ( ! defined('DEBUG') || DEBUG === false ) {
	
	error_reporting(0);
	ini_set("display_errors", 0); 
	
} else {
	
	error_reporting(E_ALL);
	ini_set("display_errors", 1); 

}

// Funções globais
require_once ABSPATH . '/functions/global-functions.php';

// Carrega a aplicação
$tutsup_mvc = new CoreMVC();

