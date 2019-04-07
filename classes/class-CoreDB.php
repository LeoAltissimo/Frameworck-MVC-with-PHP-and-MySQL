<?php
/**
 * @author Leo Altíssimo
 * @version 1.0
 * 
 * Nucleo do controlador de requisisções para banco de dado MySQL
 */

class CoreDB
{
	public $host      = '', 	 // Host da base de dados 
	       $db_name   = '',    	 // Nome do banco de dados
	       $password  = '',          // Senha do usuário da base de dados
	       $user      = '',      	 // Usuário da base de dados
	       $charset   = 'utf8',      // Charset da base de dados
	       $pdo       = null,        // Nossa conexão com o BD
	       $error     = null,        // Configura o erro
	       $debug     = false,       // Mostra todos os erros 
	       $last_id   = null;        // Último ID inserido
	

	/**
	 * Construtor da classe
	 * @param string $host     
	 * @param string $db_name
	 * @param string $password
	 * @param string $user
	 * @param string $charset
	 * @param string $debug
	 */
	public function __construct( $host     = null, $db_name  = null,
								 $password = null, $user     = null,
								 $charset  = null, $debug    = null ) 
	{
		$this->host     = defined( 'HOSTNAME'    ) ? HOSTNAME    : $this->host;
		$this->db_name  = defined( 'DB_NAME'     ) ? DB_NAME     : $this->db_name;
		$this->password = defined( 'DB_PASSWORD' ) ? DB_PASSWORD : $this->password;
		$this->user     = defined( 'DB_USER'     ) ? DB_USER     : $this->user;
		$this->charset  = defined( 'DB_CHARSET'  ) ? DB_CHARSET  : $this->charset;
		$this->debug    = defined( 'DEBUG'       ) ? DEBUG       : $this->debug;
	
		$this->connect();
		
	}
	
	/**
	 * Cria a conexão PDO
	 * @since 0.1
	 * @final
	 * @access protected
	 */
	final protected function connect() {
		 
		try {

			$this->pdo = new mysqli( $this->host , 
									 $this->user, 
									 $this->password, 
									 $this->db_name ); 
			
			unset( $this->host     );
			unset( $this->db_name  );
			unset( $this->password );
			unset( $this->user     );
			unset( $this->charset  );

			if ($this->pdo->connect_errno) 
       			 throw new Exception($this->pdo->connect_error);
		
		} catch (Exception $e) {
			if ( $this->debug === true )
				echo "Erro: " . $e->getMessage();
			
			die();
		}

	} // connect
	
	/**
	 * query - Consulta Mysql
	 * @since 0.1
	 * @access public
	 * @return object|bool Retorna a consulta ou falso
	 */
	public function query( $stmt ) {
		
		$result = $this->pdo->query( $stmt );
		
		if ( $result )
			return $result;
		
		else
			return false;
	}
	
	/**
	 * insert - Insere valores
	 * @since 0.1
	 * @access public
	 * @param string $table O nome da tabela
	 * @param array ... Ilimitado número de arrays com chaves e valores
	 * @return object|bool Retorna a consulta ou falso
	 */
	public function insert( $table ) {

		$cols = array();
		$values = '(';
		
		// O $j assegura que colunas serão configuradas apenas uma vez
		$j = 1;
		
		// Obtém os argumentos enviados
		$data = func_get_args();
		
		if ( ! isset( $data[1] ) || ! is_array( $data[1] ) ) {
			return;
		}
		
		for ( $i = 1; $i < count( $data ); $i++ ) {

			foreach ( $data[$i] as $col => $val ) {

				if ( $i === 1 ) {
					$cols[] = "`$col`";
				}
				
				if ( $j <> $i ) {
					$values .= '), (';
				}
				
				$values .= '`$val`, ';				
				
				$j = $i;
			}
			
			$values = substr( $values, 0, strlen( $values ) - 2 );
		}
		
		$cols = implode(', ', $cols);
		
		$stmt = "INSERT INTO `$table` ( $cols ) VALUES $values) ";
		
		$insert = $this->query( $stmt );
		
		return $insert; 
	}
	
	/**
	 * Update simples
	 * Atualiza uma linha da tabela baseada em um campo
	 * @since 0.1
	 * @access protected
	 * @param string $table Nome da tabela
	 * @param string $where_field WHERE $where_field = $where_field_value
	 * @param string $where_field_value WHERE $where_field = $where_field_value
	 * @param array $values Um array com os novos valores
	 * @return object|bool Retorna a consulta ou falso
	 */
	public function update( $table, $where_field, $where_field_value, $values ) {

		if ( empty($table) || empty($where_field) || empty($where_field_value)  ) {
			return;
		}

		$set = array();
		$stmt = " UPDATE `$table` SET ";
		$where = " WHERE `$where_field` = `$where_field_value` ";
		
		if ( ! is_array( $values ) ) {
			return;
		}
		
		foreach ( $values as $column => $value ) {
			$set[] = " `$column` = `$value`";
		}
		
		$set = implode(', ', $set);
		
		$stmt .= $set . $where;
				
		$update = $this->query( $stmt );
		
		return $update;

	}

	/**
	 * Deleta uma linha da tabela
	 * @since 0.1
	 * @access protected
	 * @param string $table Nome da tabela
	 * @param string $where_field WHERE $where_field = $where_field_value
	 * @param string $where_field_value WHERE $where_field = $where_field_value
	 * @return object|bool Retorna a consulta ou falso
	 */
	public function delete( $table, $where_field, $where_field_value ) {

		if ( empty($table) || empty($where_field) || empty($where_field_value)  ) {
			return;
		}
		
		$stmt = " DELETE FROM `$table` ";

		$stmt .= " WHERE `$where_field` = `$where_field_value` ";
		
		$delete = $this->query( $stmt );
		
		return $delete;
	}
	
}
