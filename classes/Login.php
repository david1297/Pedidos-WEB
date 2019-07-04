<?php
 
class Login
{
    private $db_connection = null;
    public $errors = array();
    public $messages = array();
    public function __construct(){
        session_start();
        if (isset($_GET["logout"])) {
            $this->doLogout();
        }
        elseif (isset($_POST["login"])) {
            $this->dologinWithPostData();
        }
    }
    private function dologinWithPostData(){
        if (empty($_POST['Usuario'])) {
            $this->errors[] = "Hace Falta Ingresar el Usuario";
        } elseif (empty($_POST['Clave'])) {
            $this->errors[] = "Hace Falta Ingresar la Clave";
        } elseif (!empty($_POST['Usuario']) && !empty($_POST['Clave'])) {
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }
            if (!$this->db_connection->connect_errno) {
                $Usuario = $this->db_connection->real_escape_string($_POST['Usuario']);
                $sql = "select USERNAME,CLAVE,USUARIOFACTURA,nombres.IDVEND,vendedor.NOMBRE,
                fatipdoc.MODIFICAVEND,fatipdoc.BODEGA,fatipdoc.LISTA_PRECIOS,fatipdoc.TIPO_PE
                from nombres
                inner join vendedor on nombres.IDVEND = vendedor.IDVEND
                inner join fatipdoc on fatipdoc.ID_USUARIO = nombres.USUARIOFACTURA
                                        WHERE nombres.USERNAME=  '" . $Usuario . "';";
                $result_of_login_check = $this->db_connection->query($sql);
                if ($result_of_login_check->num_rows == 1) {
                    $result_row = $result_of_login_check->fetch_object();
                    if ($_POST['Clave']==$result_row->CLAVE) {
                        $_SESSION['NOMBRE'] = $result_row->NOMBRE;
                        $_SESSION['USERNAME'] = $result_row->USERNAME;
                        $_SESSION['USUARIOFACTURA'] = $result_row->USUARIOFACTURA;
                        $_SESSION['IDVEND'] = $result_row->IDVEND;
                        $_SESSION['TIPO_PE'] = $result_row->TIPO_PE;
                        $_SESSION['BODEGA'] = $result_row->BODEGA;
                        $_SESSION['LISTA_PRECIOS'] = $result_row->LISTA_PRECIOS;
                        $_SESSION['MODIFICAVEND'] = $result_row->MODIFICAVEND;
                        $_SESSION['user_login_status'] = 1;
                        $_SESSION['Auditoria']='False';
                    } else {
                        $this->errors[] = "Usuario y/o contraseña no coinciden.";
                    }
                } else {
                    $this->errors[] = "El Usuario No Existe o No se encuentra Activo";
                }
            } else {
                $this->errors[] = "Problema de conexión de base de datos.";
            }
        }
    }
    public function doLogout()
    {
        $_SESSION = array();
        session_destroy();
        $this->messages[] = "Se Ha Cerrado La Sesion";

    }
    public function isUserLoggedIn()
    {
        if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1) {
            return true;
        }
        return false;
    }
}
?>