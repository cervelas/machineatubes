<?php
namespace Classes;

if($_SERVER['SERVER_NAME'] == 'localhost'){
    define('DB_HOST','localhost');
    define('DB_USER','root');
    define('DB_PASSWORD', 'root');
    define('DB_NAME','fuzzy');

}else{
    //online server
    define('DB_HOST' , 'localhost');
    define('DB_USER' , 'tammara');
    define('DB_PASSWORD' , 'LaMachine2022.');
    define('DB_NAME' , 'fuzzy');

}
class Database
{

    private $db_conn;

    public function connect(): bool
    {
        $this->db_conn = ($this->db_conn == NULL) ? mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME): $this->db_conn;
        return true;
    }

    public function query($sql)
    {
        $this->connect();
        if ($res = $this->db_conn->query($sql)) {
            $results = array();
            if(!is_bool($res)){
                if($res->num_rows > 0){
                    while ($arr = $res -> fetch_assoc()) {
                        $results[] = $arr;
                    }
                }
            }else{
                //if insert
                if($this->db_conn->insert_id != 0){
                    $results = $this->db_conn->insert_id;
                }else{
                    //if update or other statement
                    $results = true;
                }
            }
        }else{
            $results = false;
            echo mysqli_error($this->db_conn);
        }

        return $results;
    }

    public function querySimpleArray($sql, $value){
        $res = $this->query($sql);
        if(count($res)>0){
            foreach($res as $in_arr){
                $res_arr[] = $in_arr[$value];
            }
            return $res_arr;
        }else{
            return $res;
        }
    }

    public function queryAssocArray($sql, $key = '', $value = ''){
        $res = $this->query($sql);
        if(count($res)>0){
            foreach($res as $in_arr){
                if($key != '' && $value != ''){
                    //if we want to specify what to turn into an array
                    $res_arr[$in_arr[$key]] = $in_arr[$value];
                }else{
                    //if we just want the inner array to become an outer array
                    foreach($in_arr as $in_key=>$in_value){
                        $res_arr[$in_key] = $in_value;
                    }
                }
            }
            return $res_arr;
        }else{
            return $res;
        }
    }

    public function getFields($table){
        $sql = "DESCRIBE $table";
        $all = $this->query($sql);
        $fields = array();
        foreach($all as $all_res){
            $fields[] = $all_res['Field'];
        }
        return $fields;
    }

    public function getPrimaryField($table){
        $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '".DB_NAME."' AND TABLE_NAME = '$table' AND COLUMN_KEY = 'PRI'";
        $primary = $this->query($sql);
        return $primary[0]['COLUMN_NAME'];
    }

    public function getUnquotedFields($table){
        $unquoted_types = array('tinyint', 'smallint', 'mediumint', 'int', 'bigint', 'decimal', 'float', 'double', 'real');
        $fields = array();
        $sql = "DESCRIBE $table";
        $desc = $this->query($sql);
        foreach ($desc as $field_info){
            $type = substr($field_info['Type'],0,strpos($field_info['Type'],'('));
            if(in_array($type,$unquoted_types)){
                $fields []= $field_info['Field'];
            }
        }
        return $fields;
    }

    public function getNullFields($table){
        $sql = "DESCRIBE $table";
        $desc = $this->query($sql);
        $fields = array();
        foreach($desc as $field_info){
            if($field_info['Null'] == 'YES'){
                $fields []= $field_info['Field'];
            }
        }
        return $fields;
    }

    public function getFieldOptions($table, $field){
        $sql = "SELECT column_type FROM information_schema.columns WHERE table_name = '$table' AND column_name = '$field'";
        $cols_res = $this->query($sql)[0][0];
        $start = stripos($cols_res,"(") + 1;
        $end =  stripos($cols_res,")");
        $length = $end - $start;
        $col_options = substr($cols_res, $start, $length);
        $col_options = explode(",", $col_options);
        $options = array();
        foreach($col_options as $col_option){
            $options[] = substr($col_option,1,-1);
        }
        return $options;
    }

    public function getAll($table, $where = '', $order = '', $limit = ''){
        $where = strlen($where)>0 ? "WHERE ".$where : '';
        $order = strlen($order)>0 ? "ORDER BY ".$order : '';
        $limit = strlen($limit)>0 ? "LIMIT ".$limit : '';
        $sql = "SELECT * FROM $table $where $order $limit";
        return $this->query($sql);
    }

    public function getInfoFromId($table, $id){
        $primary = $this->getPrimaryField($table);
        $sql = "SELECT * FROM $table WHERE $primary=$id";
        return $this->query($sql);
    }

    public function getDistinct($table, $field, $where = ''){
        $sql = "SELECT DISTINCT $field FROM $table WHERE $where";
        return $this->querySimpleArray($sql, $field);
    }

    public function deleteItemFromId($table, $id){
        $id_field = $this->getPrimaryField($table);
        $sql = "DELETE FROM $table WHERE $id_field=$id";
        if($this->query($sql)){
            return true;
        }
    }

}

?>

