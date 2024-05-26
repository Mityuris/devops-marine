<?php
class Card
{
    private $id;
    private $name;
    private $image;
    private $description;
    private $category;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    $etest=  ["one"=>"value","one"=>"value","one"=>"value"]
    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
    public function setName($newName)
    {
        $this->name = $newName;
    }

    public function setImage($newProfilePicture)
    {
        $this->image = $newProfilePicture;
    }

    public function setDescription($newDescription)
    {
        $this->description = $newDescription;
    }

    public function setCategory($newCategory)
    {
        $this->category = $newCategory;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCategory()
    {
        return $this->category;
    }
}
