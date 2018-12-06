<?php

namespace App\Entity\Traits;

/**
 * Trait PasswordTrait
 * Full password entity (getters and setters) trait
 * @package App\Entity\Traits
 */
trait PasswordTrait
{
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $salt;

    /**
     * @var string|null
     */
    private $plainPassword;

    /**
     * @var string|null
     * @ORM\Column(type="string", nullable=true)
     */
    private $passwordToken;

    /**
     * @var \DateTimeInterface|null
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $passwordRequestedAt;

    /**
     * @var \DateTimeInterface|null
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $passwordUpdatedAt;

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getSalt(): string
    {
        return $this->salt;
    }

    /**
     * @param string $salt
     */
    public function setSalt(string $salt): void
    {
        $this->salt = $salt;
    }

    /**
     * @return null|string
     */
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    /**
     * @param null|string $plainPassword
     */
    public function setPlainPassword(?string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @return null|string
     */
    public function getPasswordToken(): ?string
    {
        return $this->passwordToken;
    }

    /**
     * @param null|string $passwordToken
     */
    public function setPasswordToken(?string $passwordToken): void
    {
        $this->passwordToken = $passwordToken;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getPasswordRequestedAt(): ?\DateTimeInterface
    {
        return $this->passwordRequestedAt;
    }

    /**
     * @param \DateTimeInterface|null $passwordRequestedAt
     */
    public function setPasswordRequestedAt(?\DateTimeInterface $passwordRequestedAt): void
    {
        $this->passwordRequestedAt = $passwordRequestedAt;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getPasswordUpdatedAt(): ?\DateTimeInterface
    {
        return $this->passwordUpdatedAt;
    }

    /**
     * @param \DateTimeInterface|null $passwordUpdatedAt
     */
    public function setPasswordUpdatedAt(?\DateTimeInterface $passwordUpdatedAt): void
    {
        $this->passwordUpdatedAt = $passwordUpdatedAt;
    }
}