<?php
class DBConnector{
  //objeto para establecer comunicación con la base de datos	
  private $servername = ""; //SIN CREDENCIAL CARPETA PUBLICA
  private $username = ""; //SIN CREDENCIAL CARPETA PUBLICA
  private $password = ""; //SIN CREDENCIAL CARPETA PUBLICA
  private $dbName = ""; //SIN CREDENCIAL CARPETA PUBLICA
  public $conn;

  function __construct(){
    // Crea la conexión
    $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbName);    

    // No funciono
    if ($this->conn->connect_error) {
      die("No se pudo conectar a la base de datos. Detalles: <br>" . $this->conn->connect_error) . "<br>";
    }else{ // o si je
      //echo "Conecto la base de datos";    
    }  
  }

  public function Close(){
    //cierra la coenxión
    $this->conn->close();
  }
}
