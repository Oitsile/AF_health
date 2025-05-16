<?php

class App
{
    /* Static variables, functions & constructor
    ================================================== */
    // Static variables
    protected static $env;
    protected static $connection_abn;
    protected static $connection_health;

    function __construct() {
        $this->start_session();
        $this->parse_env();         
        $this->set_globals();
        $this->set_session_defaults();
        $this->set_ino_session();  
    }

    /*
    | start_session()
    | ----------------------------------------
    | Checks whether the session is running.
    | If not, start the session now.
    */
    public function start_session() {
        if (session_id() == '' || !isset($_SESSION)) {
            session_start();            
        }
    }

    /**
     * set_session_defaults()
     * --------------------
     */
    public function set_session_defaults() {
        // which default session values do we always want to have set
        $session_defaults = array(
            'page'
        );
        // loop through the defaults, and get their respective values if not set
        foreach ($session_defaults as $session_default) {
            if (!isset($_SESSION[$session_default]) || $_SESSION[$session_default] == "") {
                // if the default is not set in the session
                // set it now
                $_SESSION[$session_default] = self::$env['def_'.$session_default];
            }
        }
    }

    /**
     * set_ino_session()
     * --------------------
     */
    public function set_ino_session() {
        // first check if this is an ABN lead
        if (isset($_GET['i']) || $_GET['i'] != '') {
            // if this is an ABN lead
            $inoCode = "ABN".$_GET['i'];
            $sql = "SELECT * FROM inoAccount WHERE inoCode = '".$inoCode."' AND isActive > 0";
            $result = $this->exec($sql, 'db_abn');
            $data['inoCode'] = $inoCode;
            $data['inoName'] = $result[0]['firstName']." ".$result[0]['surname'];
            $this->set_session_val($data);
        } else {
            // if this is NOT an ABN lead
            $data['inoCode'] = "";
            $data['inoName'] = "";
            $this->set_session_val($data);
        }
        
    }

    /**
     * set_session_val()
     * --------------------
     */
    public function set_session_val($data) {
        foreach ($data as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }

    /**
     * parse_env()
     * --------------------
     * Checks if static $env variable is set.
     * If not, parse .env file into stativ $env variable.
     */
    public function parse_env() {
        if (!isset(self::$env)) { self::$env = parse_ini_file($_SERVER['DOCUMENT_ROOT']."/apply/.env"); }
    }

    /**
     * set_globals()
     * --------------------
     * loops through the .env file and identifies keys with "const_"
     * prefix - sets them as uppercase CONSTANTS accessible globally
     */
    public function set_globals() {
        // get the entire .env set as an array
        $env_array = self::$env;
        // loop through the array
        foreach ($env_array as $env_key => $env_value) {
            // identify "const_" prefixes
            if (substr($env_key, 0, 6) == "const_") {
                // we need to treat "_url" postfixes differently
                if (substr($env_key, -4) == "_url") {
                    // concatenate document root path before the value
                    $key = strtoupper(substr($env_key, 6));
                    if (!defined($key)) { 
                        // check if this is the BASE_URL
                        if ($key === 'BASE_URL') {
                            // if this is the BASE_URL, use as is
                            define($key, $_SERVER['DOCUMENT_ROOT'].'/'.$env_value);
                        } else {
                            // if this is not the BASE_URL, concatenate the BASE_URL before the path
                            define($key, $_SERVER['DOCUMENT_ROOT'].'/'.self::$env['const_base_url'].$env_value);
                        }
                    }
                } else {
                    $key = strtoupper(substr($env_key, 6));
                    if (!defined($key)) { define($key, $env_value); }
                }
            }
        }
    }

    public function load_page($page = "") {
        if (!isset($page) || $page === "") {
            // if page is not defined, load step_1 as a default
            return VIEW_URL.$_SESSION['page'].'.php';
        } else {
            // if page is defined, load that page
            return VIEW_URL.$page.".php";
        }
    }

    public function conn( $db = 'affinity', $env = ENVIRONMENT ) {
        // get the env parameters for the db / environment
        $host = self::$env['host_'.$db.'_'.$env];
        $user = self::$env['user_'.$db.'_'.$env];
        $pass = self::$env['pass_'.$db.'_'.$env];
        $name = self::$env['name_'.$db.'_'.$env];
        $port = self::$env['port_'.$db.'_'.$env];

        // ABN Connection
        // ----------------------------------------
        if ( $db == "db_abn" ) {
            // Try and connect to the database only if a connection isn't open already
            if( !isset(self::$connection_abn) ) {
                self::$connection_abn = mysqli_connect( $host, $user, $pass, $name, $port );
            }

            // If connection cannot be established, handle the error
            if( self::$connection_abn === false ) {
                // Handle error - notify administrator, log to a file, show an error screen, etc.
                return false;
            }

            // Return the connection
            return self::$connection_abn;
        }
        // Health Connection
        // ----------------------------------------
        if ( $db == "affinity" ) {
            // Try and connect to the database only if a connection isn't open already
            if( !isset(self::$connection_health) ) {
                self::$connection_health = mysqli_connect( $host, $user, $pass, $name, $port );
            }

            // If connection cannot be established, handle the error
            if( self::$connection_health === false ) {
                // Handle error - notify administrator, log to a file, show an error screen, etc.
                return false;
            }

            // Return the connection
            return self::$connection_health;
        }
    }

    /**
     * exec
     * -----
     * executes sql query and returns result(s)
     * expects $sql: query as a string
     * accepts $conn: only required if switching between different db's (defaults to affinity)
     */
    public function exec($sql, $db = 'affinity'){

        $conn = $this->conn($db);
        
        $result = mysqli_query($conn, $sql);

        if (substr(strtoupper($sql),0,6) == "SELECT"){
            $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
            if (sizeof($result) == 0) {
                return false;
            } else {
                return $result;
            }
        }
        return $result;
    }
}


?>