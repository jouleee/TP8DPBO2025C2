<?php

class DB
{
    var $db_host;
    var $db_user;
    var $db_pass;
    var $db_name;
    var $db_link;
    var $result;

    // Constructor dengan default value
    function __construct($db_host = "localhost", $db_user = "root", $db_pass = "", $db_name = "db_kampus")
    {
        $this->db_host = $db_host;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_name = $db_name;
    }

    function open()
    {
        $this->db_link = mysqli_connect($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
        if (!$this->db_link) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    function execute($query)
    {
        $this->open();
        $this->result = mysqli_query($this->db_link, $query);
        return $this->result;
    }

    function getResult()
    {
        return mysqli_fetch_array($this->result);
    }

    function close()
    {
        if ($this->db_link) {
            mysqli_close($this->db_link);
        }
    }
}
