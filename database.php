<?php

class Database
{

    private $host_name = "localhost";
    private $username = "root";
    private $pass = "";
    private $database = "ecom";

    public $conn = false;
    public $mysqli = "";
    public $result = array();
    public $count = 0;

    public function __construct()
    {
        if (!$this->conn) {
            $this->mysqli =  mysqli_connect($this->host_name, $this->username, $this->pass, $this->database);
            if ($this->mysqli->connect_error) {
                array_push($this->result, $this->mysqli->connect_error);
                return false;
            }
            $this->conn  = true;
        } else {
            return true;
        }
    }

    public function insert($table_name, $params = array())
    {
        if ($this->tableExists($table_name)) {
            $columns = implode(",", array_keys($params));
            $values = implode("','", $params);
            $sql = "INSERT INTO $table_name ($columns) VALUES ('$values')";
            $result = $this->mysqli->query($sql);
            if ($result) {
                array_push($this->result, $this->mysqli->insert_id);
                return true;
            } else {
                array_push($this->result, $this->mysqli->error);
                return false;
            }
        } else {
            return false;
        }
    }

    public function tableExists($table_name)
    {
        $sql = "SHOW TABLES FROM $this->database LIKE '$table_name'";
        $table = $this->mysqli->query($sql);
        if ($table && $table->num_rows == 1) {
            return true;
        } else {
            array_push($this->result, $table_name . " does not exist.");
            return false;
        }
    }

    public function getResult()
    {
        $val = $this->result;
        $this->result = array();
        return $val;
    }

    public function getCount()
    {
        $val = $this->count;
        $this->count = 0;
        return $val;
    }

    public function select(
        $table_name,
        $column_param = "*",
        $where = null,
        $join = null,
        $order = null,
        $start_limit_index = null,
        $limit = null
    ) {
        if ($this->tableExists($table_name)) {
            $sql = "SELECT $column_param FROM $table_name";
            if ($join != null) {
                $sql .= " JOIN $join ";
            }
            if ($where != null) {
                $sql .= " WHERE $where ";
            }
            if ($order != null) {
                $sql .= " ORDER BY $order ";
            }
            if ($limit != null) {
                if ($start_limit_index !== null) {
                    $sql .= " LIMIT $start_limit_index, $limit";
                } else {
                    $sql .= " LIMIT 0,$limit ";
                }
            }
            // echo $sql; die();
            $this->get($sql);
        } else {
            return false;
        }
    }

    public function pagination($table_name, $join = null, $where = null, $limit = null)
    {
        if ($limit == null) {
            return false;
        }
        if (isset($_GET['page'])) {
            $page_no = $_GET['page'];
            $start_limit_index = ($page_no - 1) * $limit;
            $flag = 1;
            $query = "SELECT COUNT(*) FROM $table_name";
            if ($where != null) {
                $query .= " WHERE $where";
            }
            $query = $this->mysqli->query($query);
            $count = 0;
            if ($query) {
                $count = $query->fetch_array()[0];
            }
            if (!$count) {
                return false;
            }
            $total_page_btn = ceil($count / $limit);                
            $current_page_url = $_SERVER['PHP_SELF'];

            if($page_no == 1){
                $prevBtnDisable = "disabled";
            }else{
                $prevBtnDisable = ""; 
            }

            if($total_page_btn == $page_no){
                $nextBtnDisable = "disabled";
            }else{
                $nextBtnDisable = "";
            }

            echo '<nav aria-label="...">
                <ul class="pagination">
                <li class="page-item '.$prevBtnDisable.'">
                <a class="page-link" href='.$current_page_url.'?page=' . ($page_no-1) .' tabindex="-1" aria-disabled="true">Previous</a>
                </li>';
            while ($flag <= $total_page_btn) {
                if ($flag == $page_no) {
                    echo  '<li class="page-item active"><a class="page-link" href=' . $current_page_url . '?page=' . $flag . '>' . $flag . '</a></li>';
                } else {
                    echo  '<li class="page-item"><a class="page-link" href=' . $current_page_url . '?page=' . $flag . '>' . $flag . '</a></li>';
                }
                ++$flag;
            }
            echo '<li class="page-item '. $nextBtnDisable .'">
                <a class="page-link" href='.$current_page_url.'?page=' . ($page_no+1) .'>Next</a>
                </li>
                </ul>
                </nav>';
            $this->select($table_name, "*", $join, $where, null, $start_limit_index, $limit);
        } else {
            return false;
        }
    }

    public function get($sql)
    {
        if ($query = $this->mysqli->query($sql)) {
            $data = $query-> fetch_all(MYSQLI_ASSOC);
            $this->result =  $data;
            $this -> count = count($data);
            return true;
        } else {
            array_push($this->result, $this->mysqli->error);
            return false;
        }
    }

    public function update($table_name, $params = array(), $where = null)
    {
        if ($this->tableExists($table_name)) {
            $args = array();
            foreach ($params as $column_param => $value) {
                $args[] = "$column_param = '$value' ";
            }
            $columns = implode(',', $args);
            $sql =  "UPDATE $table_name SET $columns";
            if ($where != null) {
                $sql .= " WHERE $where";
            }
            // echo $sql; die();
            if ($this->mysqli->query($sql)) {
                array_push($this->result, $this->mysqli->affected_rows);
                return true;
            } else {
                array_push($this->result, $this->mysqli->error);
                return false;
            }
        } else {
            array_push($this->result, $this->mysqli->error);
            return false;
        }
    }

    public function delete($table_name, $where = null)
    {
        if ($this->tableExists($table_name)) {
            $sql = "DELETE FROM $table_name";
            if ($where != null) {
                $sql .= " WHERE $where";
            }
            if ($this->mysqli->query($sql)) {
                array_push($this->result, $this->mysqli->affected_rows);
                return true;
            } else {
                array_push($this->result, $this->mysqli->error);
                return false;
            }
        } else {
            array_push($this->result, $this->mysqli->error);
            return false;
        }
    }

    public function __distruct()
    {
        if ($this->conn) {
            if ($this->mysqli->close()) {
                $this->conn = false;
                echo  "2";
                return true;
            }
        } else {
            return false;
        }
    }
}

?>
