<?php



class Database{

    protected  $host = DB_HOST;
    protected $username = DB_USER;
    protected $password = DB_PASS;
    protected $db_name = DB_NAME;

    public $link;
    public $error;

    /*
     * Class constructor
     */
    public function __construct(){
        // Call Connect function
        $this->connect();
    }

    /*
     * Connector
     */
    private function connect(){
        $this->link = new mysqli($this->host, $this->username, $this->password, $this->db_name);

        if(!$this->link){
            $this->error = "Connect failed: " . $this->link->connect_error;

            return false;
        }

        return true;
    }

    /***************************************************************************************
     * SIMPLE CRUD
    ***************************************************************************************/

    /*
     * Insert into database
     */
    /**
     * @param $query
     */
    public function insert($query){
        $insert_row = $this->link->query($query) or die($this->error . __LINE__);

        // Validate insert
        if($insert_row){
            header("Location: index.php?msg=".urlencode("Record Added"));
            exit();
        }else{
            die("Error: (" . $this->link->errno . ") " . $this->link->error);
        }
    }

    /*
     * Select from database
     */
    /**
     * @param $query
     * @return bool
     */
    public function select($query){
        $result = $this->link->query($query) or die($this->error->error . __LINE__);

        if($result->num_rows > 0){
            return $result;
        } else {
            return false;
        }
    }

    /*
     * Update record from database
     */
    /**
     * @param $query
     */
    public function update($query){
        $update_row = $this->link->query($query) or die($this->error . __LINE__);

        // Validate update
        if($update_row){
            header("Location: index.php?msg=".urlencode("Record Updated"));
            exit();
        }else{
            die("Error: (" . $this->link->errno . ") " . $this->link->error);
        }
    }

    /*
     * Delete record from database
     */
    /**
     * @param $query
     */
    public function delete($query){
        $delete_row = $this->link->query($query) or die($this->error . __LINE__);

        // Validate delete
        if($delete_row){
            header("Location: index.php?msg=".urlencode("Record Deleted"));
            exit();
        }else{
            die("Error: (" . $this->link->errno . ") " . $this->link->error);
        }
    }
}