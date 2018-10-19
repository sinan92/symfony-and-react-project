<?php
namespace App\Entity;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="userMessage")
     */
    private $message;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="userComment")
     */
    private $comment;


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

    /**
     * @return Collection|Comment[]
     */
    public function getComment(): Collection
    {
        return $this->comment;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comment->contains($comment)) {
            $this->comment[] = $comment;
            $comment->setMessage($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comment->contains($comment)) {
            $this->comment->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getMessage() === $this) {
                $comment->setMessage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessage(): Collection
    {
        return $this->message;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->message->contains($message)) {
            $this->message[] = $message;
            $message->addCategory($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->message->contains($message)) {
            $this->message->removeElement($message);
            $message->removeCategory($this);
        }
        return $this;
    }
}




