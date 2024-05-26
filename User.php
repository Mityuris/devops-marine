<?php
class User
{
    private $id;
    private $username;
    private $profilePicture;
    private $password;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
    public function setUsername($newUsername)
    {
        $this->username = $newUsername;
    }

    public function setProfilePicture($newProfilePicture)
    {
        $this->profilePicture = $newProfilePicture;
    }

    public function setPassword($newPassword)
    {
        $this->password = $newPassword;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getProfilePicture()
    {
        return $this->profilePicture;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getId()
    {
        return $this->id;
    }
}
