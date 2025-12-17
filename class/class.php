<?php
if ($_SESSION['Database_V'] == "") {

    define("DB_HOST", "");
    define("DB_NAME", "");
    define("DB_USER", "");
    define("DB_PASS", "");

    class Database
    {
        public $Table;
        public $Where = "";
        public $Set;
        public $Field;
        public $Value;

        private $charset = 'utf8';
        private $Connect;

        public function __construct()
        {
            // ✅ ใช้ mysqli แทน mysql
            $this->Connect = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if ($this->Connect->connect_error) {
                die("Connection failed: " . $this->Connect->connect_error);
            }
            $this->Connect->set_charset($this->charset);
        }

        // ✅ INSERT
        public function Insert()
        {
            $sql = "INSERT INTO {$this->Table} ({$this->Field}) VALUES ({$this->Value})";
            return $this->Connect->query($sql);
        }

        // ✅ SELECT
        public function Select()
        {
            $sql = "SELECT * FROM {$this->Table} {$this->Where}";
            $result = $this->Connect->query($sql);
            $rows = [];
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                }
            }
            return $rows;
        }

        // ✅ UPDATE
        public function Update()
        {
            $sql = "UPDATE {$this->Table} SET {$this->Set} {$this->Where}";
            return $this->Connect->query($sql);
        }

        // ✅ DELETE
        public function Delete()
        {
            $sql = "DELETE FROM {$this->Table} {$this->Where}";
            return $this->Connect->query($sql);
        }

        public function __destruct()
        {
            if ($this->Connect) {
                $this->Connect->close();
            }
        }
    }
} else {
    echo "Database connection Error.";
    exit();
}
