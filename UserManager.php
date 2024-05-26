<?php
class UserManager
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

    public function create(User $newUser)
    {
        $request = $this->db->prepare("INSERT INTO `user` (username, password) VALUES (:username,:password)");

        $request->bindValue(":username", $newUser->getUsername(), PDO::PARAM_STR);
        $request->bindValue(":password", password_hash($newUser->getPassword(), PASSWORD_DEFAULT), PDO::PARAM_STR);

        $request->execute();
    }

    public function getById(int $id)
    {
        $request = $this->db->prepare("SELECT * FROM `user` WHERE id=:id");
        $request->bindValue(":id", $id, PDO::PARAM_INT);
        $request->execute();
        $data = $request->fetch();
        $user = new User($data);
        return $user;
    }

    public function getByUsername(string $username)
    {
        $request = $this->db->prepare("SELECT * FROM `user` WHERE username=:username");
        $request->bindValue(":username", $username, PDO::PARAM_INT);
        $request->execute();
        $data = $request->fetch();
        $user = new User($data);
        return $user;
    }

    public function getAll()
    {
        $users = [];
        $request = $this->db->prepare("SELECT * FROM `user` ORDER BY id");
        $request->execute();
        $dataList = $request->fetchAll();
        foreach ($dataList as $data) {
            $user = new User($data);
            $users[] = $user;
        }
        return $users;
    }

    public function update(User $UpdatedUser)
    {
        $request = $this->db->prepare("UPDATE `user` SET username=:username, profilePicture=:profilePicture, password=:password WHERE id=:id");

        $request->bindValue(":id", $UpdatedUser->getId(), PDO::PARAM_INT);
        $request->bindValue(":username", $UpdatedUser->getUsername(), PDO::PARAM_STR);
        $request->bindValue(":profilePicture", $UpdatedUser->getProfilePicture(), PDO::PARAM_STR);
        $request->bindValue(":password", password_hash($UpdatedUser->getPassword(), PASSWORD_DEFAULT), PDO::PARAM_STR);

        $request->execute();
    }

    public function updateByUsername(User $UpdatedUser)
    {
        $request = $this->db->prepare("UPDATE `user` SET username=:username, profilePicture=:profilePicture, password=:password WHERE username=:username");

        $request->bindValue(":username", $UpdatedUser->getUsername(), PDO::PARAM_STR);
        $request->bindValue(":profilePicture", $UpdatedUser->getProfilePicture(), PDO::PARAM_STR);
        $request->bindValue(":password", password_hash($UpdatedUser->getPassword(), PASSWORD_DEFAULT), PDO::PARAM_STR);

        $request->execute();
    }


    public function delete(int $id)
    {
        $request = $this->db->prepare("DELETE FROM `user` WHERE id=:id");

        $request->bindValue(":id", $id, PDO::PARAM_INT);

        $request->execute();
    }

    public function deleteByUsername(string $username)
    {
        $request = $this->db->prepare("DELETE FROM `user` WHERE username=:username");

        $request->bindValue(":username", $username, PDO::PARAM_STR);

        $request->execute();
    }
}
