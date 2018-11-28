<?php

namespace App\Form\Model\Security;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Login
 * @package App\Form\Model\Security
 */
class Login
{
    /**
     * @var string
     * @Assert\NotBlank(message="Veuillez saisir une adresse email.")
     */
    private $_username;

    /**
     * @var string
     * @Assert\NotBlank(message="Veuillez saisir un mot de passe.")
     */
    private $_password;

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->_username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->_username = $username;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->_password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->_password = $password;
    }
}