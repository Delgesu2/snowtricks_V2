<?php

namespace App\Entity\Traits;

/**
 * Trait ValidationTrait
 * Validation token and date
 * @package App\Entity\Traits
 */
trait ValidationTrait
{
    /**
     * @var string|null
     * @ORM\Column(type="string", nullable=true)
     */
    private $validationToken;

    /**
     * @var \DateTimeInterface|null
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $validatedAt;

    /**
     * @return null|string
     */
    public function getValidationToken(): ?string
    {
        return $this->validationToken;
    }

    /**
     * @param null|string $validationToken
     */
    public function setValidationToken(?string $validationToken): void
    {
        $this->validationToken = $validationToken;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getValidatedAt(): ?\DateTimeInterface
    {
        return $this->validatedAt;
    }

    /**
     * @param \DateTimeInterface|null $validatedAt
     */
    public function setValidatedAt(?\DateTimeInterface $validatedAt): void
    {
        $this->validatedAt = $validatedAt;
    }
}