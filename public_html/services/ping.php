<?php
include_once ("../static/config.php");

header('Access-Control-Allow-Origin: *');


if (isset($_GET['type'])) {
    if ($_GET['type'] == "server") {
        header('Content-type: text/plain');
        echo "Server Pong!";
        return;
    }else if ($_GET['type'] == "db") {
        try {
            // create connection
            $conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME, DB_PORT);

            if ($conn -> connect_errno) {
                http_response_code(503);
                return;
            }

            $sql = "SELECT id FROM PRODUCT WHERE id=1";
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                http_response_code(503);
                return;
            }

            $er = $stmt->execute();

            if (!$er) {
                http_response_code(503);
                return;
            }

            $result = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            $conn->close();

            header('Content-type: text/plain');
            echo "DB Pong!";
            return;

        } catch (Exception $e) {
            http_response_code(400);
            return;
        }
    }
}
http_response_code(400);
