<?php
namespace App\Entity;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Table("user")
 * @ORM\Entity
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="userName", type="string", length=255)
     */
    private $userName;

    /**
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(name="rolesString", type="string", length=255)
     */
    private $rolesString;
    //methodes uit UserInterface

    public function getUserName()
    {
        return $this->userName;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function eraseCredentials()
    {
    }

    public function getRoles()
    {
        return preg_split("/[\s,]+/",$this->rolesString);
    }

    public function getSalt()
    {
        return null;
    }

//methodes uit Serializable

    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->userName,
            $this->password,
            $this->rolesString
        ));
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->userName,
            $this->password,
            $this->rolesString
            ) = unserialize($serialized);
    }
    //overblijvende getters /setters
    public function getId()
    {
        return $this->id;
    }
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
    public function setRolesString($rolesString)
    {
        $this->rolesString = $rolesString;

        return $this;
    }
    public function getRolesString()
    {
        return $this->rolesString;
    }
    //toString
    public function __toString()
    {
        return "Entity User, username= " . $this->userName;
    }
}




