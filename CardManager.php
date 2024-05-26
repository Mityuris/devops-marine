<?php
class CardManager
{
    private $db;

    public function __construct()
    {
        $dbName = "four_souls";
        $port = 3306;
        $userName = "root";
        $userPassword = "";
        try {
            $this->setDb(new PDO("mysql:host=localhost;dbname=$dbName;port=$port;charset=utf8mb4", $userName, $userPassword));
        } catch (PDOException $error) {
            echo $error->getMessage();
        }
    }

    public function setDb($db)
    {
        $this->db = $db;
    }

    public function create(Card $newCard)
    {
        $request = $this->db->prepare("INSERT INTO `card` (name, image, description, category) VALUES (:name,:image,:description,:category)");
+
        $request->bindValue(":name", $newCard->getName(), PDO::PARAM_STR);
        $request->bindValue(":image", $newCard->getImage(), PDO::PARAM_STR);
        $request->bindValue(":description", $newCard->getDescription(), PDO::PARAM_STR);
        $request->bindValue(":category", $newCard->getCategory(), PDO::PARAM_STR);

        $request->execute();
    }

    public function get(int $id)
    {
        $request = $this->db->prepare("SELECT * FROM `card` WHERE id=:id");
        $request->bindValue(":id", $id, PDO::PARAM_INT);
        $request->execute();
        $data = $request->fetch();
        $card = new Card($data);
        return $card;
    }

    public function getAll()
    {
        $cards = [];
        $request = $this->db->prepare("SELECT * FROM `card` ORDER BY id");
        $request->execute();
        $dataList = $request->fetchAll();
        foreach ($dataList as $data) {
            $card = new Card($data);
            $cards[] = $card;
        }
        return $cards;
    }

    public function update(Card $UpdatedCard)
    {
        $request = $this->db->prepare("UPDATE `user` SET name=:name, image=:image, description=:description, category=:category WHERE id=:id");

        $request->bindValue(":id", $UpdatedCard->getId(), PDO::PARAM_INT);
        $request->bindValue(":name", $UpdatedCard->getName(), PDO::PARAM_STR);
        $request->bindValue(":image", $UpdatedCard->getImage(), PDO::PARAM_STR);
        $request->bindValue(":description", $UpdatedCard->getDescription(), PDO::PARAM_STR);
        $request->bindValue(":category", $UpdatedCard->getCategory(), PDO::PARAM_STR);

        $request->execute();
    }

    public function delete(int $id)
    {
        $request = $this->db->prepare("DELETE FROM `card` WHERE id=:id");

        $request->bindValue(":id", $id, PDO::PARAM_INT);

        $request->execute();
    }
}