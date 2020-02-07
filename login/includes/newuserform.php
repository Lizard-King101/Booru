<?php
class NewUserForm extends DbConn
{
    public function createUser($usr, $uid, $email, $pw)
    {
        try {

            $db = new DbConn;
            $tbl_members = $db->tbl_members;
            // prepare sql and bind parameters
            $stmt = $db->conn->prepare("INSERT INTO ".$tbl_members." (id, username, password, email, ip, country, loc_data)
            VALUES (:id, :username, :password, :email, :ip, :country, :loc_data)");
            $stmt->bindParam(':id', $uid);
            $stmt->bindParam(':username', $usr);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $pw);
            $loc = file_get_contents("http://ipinfo.io/{$_SERVER['REMOTE_ADDR']}/json");
            $loc_arr = json_decode($loc);
            $stmt->bindParam(':ip', $loc_arr->ip);
            $stmt->bindParam(':country', $loc_arr->country);
            $stmt->bindParam(':loc_data', $loc);
            $stmt->execute();

            $err = '';

        } catch (PDOException $e) {

            $err = "Error: " . $e->getMessage();

        }
        //Determines returned value ('true' or error code)
        if ($err == '') {

            $success = 'true';

        } else {

            $success = $err;

        };

        return $success;

    }
}
