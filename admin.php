<?php
declare(strict_types=1);
ini_set("display_errors", 1);

trait Database
{
    private $dbhost = "localhost";
    private $dbname = "dinamic_gallery_db";
    private $dbuser = "root";
    private $dbpass = "";

    public function creat_conection(): PDO
    {

        try {
            $pdo = new PDO("mysql:host=$this->dbhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (ErrorException $e) {
            die("Failed Conextion: " . $e->getMessage());
        }
    }
}

class Admin
{
    use Database;

    public function get_all_slide_data()
    {
        $pdo = $this->creat_conection();
        $query = "SELECT * FROM img_tbl";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        $count = 1;

        foreach ($results as $result) {
            echo '<tr>
                    <td>' . $count++ . '</td>
                    <td>' . $result->visibility . '</td>
                    <td><img width="75px" src="' . $result->img_url . '"></td>
                    <td><a href="http://localhost/public_html/dinamic-slide-gallery/update.php?id=' . $result->id . '">edit</a>, <a href="http://localhost/public_html/dinamic-slide-gallery/delete.php?id=' . $result->id . '">delete</a></td>
                  </tr>';
        }
    }

    public function get_all_img()
    {
        $pdo = $this->creat_conection();
        $query = "SELECT * FROM img_tbl WHERE visibility = 1";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);

        foreach ($results as $result) {
            echo '<img src="' . $result->img_url . '">';
        }
    }

    public function get_slide_where($id)
    {
        $pdo = $this->creat_conection();
        $query = "SELECT * FROM img_tbl WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function update_slide($id, $img_url, $visibility)
    {
        $pdo = $this->creat_conection();
        $query = "UPDATE `img_tbl` SET `img_url` = :img_url, `visibility` = :visibility  WHERE `img_tbl`.`id` = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":img_url", $img_url);
        $stmt->bindParam(":visibility", $visibility);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }

    public function add_new_slide($img_url, $visibility)
    {
        $pdo = $this->creat_conection();
        $query = "INSERT INTO `img_tbl` (`img_url`, `visibility`) VALUE (:img_url, :visibility)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":img_url", $img_url);
        $stmt->bindParam(":visibility", $visibility);
        $stmt->execute();
    }

    public function delete_where($id)
    {
        $pdo = $this->creat_conection();
        $query = "DELETE FROM `img_tbl`WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }
}
