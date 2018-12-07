<?php

namespace App\Entity;

use App\Entity\Traits\PasswordTrait;
use App\Entity\Traits\ProfileTrait;
use App\Entity\Traits\ValidationTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\EntityListeners({
 *     "App\EntityListener\HashPasswordListener",
 *     "App\EntityListener\SlugUserNameListener",
 *     "App\EntityListener\RegisterListener"
 * })
 */
class User implements UserInterface
{
    use PasswordTrait;

    use ValidationTrait;

    use ProfileTrait {
        ProfileTrait::__construct as private __profileConstruct;
    }

    /**
     * @var int |null
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", unique=true, length=191)
     */
    private $email;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $role;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->__profileConstruct();
        $this->setRole('ROLE_USER');
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    /**
     * @inheritdoc
     */
    public function getRoles()
    {
        return [$this->role];
    }

    /**
     * @inheritdoc
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }


}
