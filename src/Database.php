<?php
namespace Markup;

class Database {
    private $conn;

    public function __construct() {
        $host = "localhost";
        $user = "root";
        $pass = "root";
        $db = "markup";

        $this->conn = new \mysqli($host, $user, $pass, $db);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function get_rules() {
        //query to retrieve rules
        $sql = "SELECT * FROM rules";
        $result = $this->conn->query($sql);
        $final = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $final[] = $row;
            }
        }
        return $final;
    }

    public function get_scores_by_id($filename) {
        $sql = "SELECT * FROM scores WHERE `filename_id`='$filename'";
        $result = $this->conn->query($sql);
        $final = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $final[] = $row;
            }
        }
        return $final;
    }

    public function insert_score($score, $filename) {
        $person_name = explode("_", $filename)[0];
        $sql = "INSERT INTO scores (`filename_id`, `person_name`, `score`) VALUES ('$filename','$person_name','$score')";
        $this->conn->query($sql);
    }

    public function update_score($filename, $score) {
        $sql = "UPDATE scores SET `score`='$score', `last_run_date`=CURRENT_TIMESTAMP WHERE `filename_id`='$filename'";
        $this->conn->query($sql);
    }

    public function get_scores_by_person($person_name) {
        $sql = "SELECT score FROM scores WHERE `person_name`='$person_name'";
        $result = $this->conn->query($sql);
        $final = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $final[] = $row->score;
            }
        }
        return $final;
    }

    public function get_scores_by_date_range($from, $to) {
        $sql = "SELECT score FROM scores WHERE `last_run_date` BETWEEN '$from' AND '$to'";
        $result = $this->conn->query($sql);
        $final = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $final[] = $row->score;
            }
        }
        return $final;
    }

    public function get_max_score_by_person($person_name) {
        $sql = "SELECT MAX(score) as score FROM scores WHERE `person_name`='$person_name'";
        $result = $this->conn->query($sql);
        $final = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $final[] = $row->score;
            }
        }
        return $final;
    }

    public function get_min_score_by_person($person_name) {
        $sql = "SELECT MIN(score) as score FROM scores WHERE `person_name`='$person_name'";
        $result = $this->conn->query($sql);
        $final = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $final[] = $row->score;
            }
        }
        return $final;
    }

    public function get_average_score(){
        $sql = "SELECT person_name, AVG(score) as score FROM scores GROUP BY person_name";
        $result = $this->conn->query($sql);
        $final = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $final[] = $row;
            }
        }
        return $final;
    }

    public function __destruct() {
        $this->conn->close();
    }
}
