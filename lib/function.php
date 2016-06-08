<?php

Class MainFunction {

    public function ConnectDB() {
        $mysqli = new mysqli("localhost", "root", "", "training");

        /* check connection */
        if ($mysqli->connect_errno) {
            echo "Connect failed: %s\n", $mysqli->connect_error;
            exit();
        }

        return $mysqli;
    }

    public function getMainData() {
        $conn = $this->ConnectDB();
        $sql = "SELECT * FROM profile";
        if ($result = $conn->query($sql)) {
            /* fetch object array */
            while ($obj = $result->fetch_object()) {
                $data[] = $obj;
            }
            /* free result set */
            $result->close();
        }
        $conn->close();
        
        return $data;
    }

}
