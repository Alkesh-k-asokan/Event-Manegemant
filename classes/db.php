<?php

include_once 'constants.php';

class DB
{
  //put your code here
  public $connection;
  public $db;
  public $username;
  public $password;
  public $host;

  function __construct()
  {
    $this->host = constants::DB_HOST;
    $this->username = constants::DB_USER_NAME;
    $this->password = constants::DB_PASSWORD;
    $this->db = constants::DB_NAME;
  }

  function connect()
  {
    $con = mysqli_connect($this->host, $this->username, $this->password, $this->db);
    return $con;
  }

  function close()
  {
    if (isset ($this->connect)) {
      mysqli_close($this->connect);
    }
    $this->connect = NULL;
  }

  // ----- function to execute Query from a table------
  function executeQuery($query)
  {
    $con = $this->connect();
    $result = mysqli_query($con, $query) or mysqli_error($con);
    $this->close();
    return $result;
  }
}

?>