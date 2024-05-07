<?php 
session_start();

class Login { 
	private $name = 'vestibular'; 
	private $password = 'fatec'; 
	 
	public function verificar_credenciais( $name, $password ) { 
        if ( $name == $this->name ) {
            if ( $password == $this->password ) {
                $_SESSION["logged_in"] = TRUE;
                return TRUE;
            }
        }
        return FALSE;
	} 

    public function verificar_logado() { 
        if ( $_SESSION["logged_in"]) {
            return TRUE;
        }
        $this->logout();
	} 

    public function logout() { 
        session_destroy();
        header("Location: index.php");
        exit();
	} 
}


class Database {

    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function insert($nome, $curso){
        try {
            // Obtém o próximo valor de id
            $sql_next_id = "SELECT MAX(id) + 1 AS next_id FROM candidatos";
            $stmt_next_id = $this->conn->prepare($sql_next_id);
            $stmt_next_id->execute();
            $next_id_result = $stmt_next_id->fetch(PDO::FETCH_ASSOC);
            $next_id = $next_id_result['next_id'];

            // Insere o novo candidato usando o próximo valor de id
            $sql_insert = "INSERT INTO candidatos (id, nome, curso) VALUES ('$next_id', '$nome', '$curso')";
            $stmt_insert = $this->conn->prepare($sql_insert);
            $stmt_insert->execute();
            echo "Candidato cadastrado com sucesso!";
        } catch(PDOException $e) {
            echo "Erro ao
             tentar cadastrar: " . $e->getMessage();
        }
    }

    public function select(){
        try {
            $sql = "SELECT * FROM candidatos";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e) {
            echo "Erro ao selecionar candidatos: " . $e->getMessage();
            return false;
        }
    }

    public function __destruct() {
        $this->conn = null;
    }
}

?>