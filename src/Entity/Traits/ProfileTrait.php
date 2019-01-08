<?php

namespace App\Entity\Traits;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Trait ProfileTrait
 * Registered user full entity trait
 * @package App\Entity\Traits
 */
trait ProfileTrait
{
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $pseudo;

    /**
     * @var string
     * @ORM\Column(type="string", unique=true)
     */
    private $slug;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $avatar;

    /**
     * @var UploadedFile|null
     * @Assert\Image
     */
    private $uploadFile;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="author", orphanRemoval=true)
     */
    private $comments;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Trick", mappedBy="createdBy")
     */
    private $tricks;

    /**
     * ProfileTrait constructor.
     */
    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->tricks = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    /**
     * @param string $pseudo
     */
    public function setPseudo(string $pseudo): void
    {
        $this->pseudo = $pseudo;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    /**
     * @param string $avatar
     */
    public function setAvatar(string $avatar): void
    {
        $this->avatar = $avatar;
    }

    /**
     * @return Collection
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    /**
     * @return Collection
     */
    public function getTricks(): Collection
    {
        return $this->tricks;
    }

    /**
     * @return null|UploadedFile
     */
    public function getUploadFile(): ?UploadedFile
    {
        return $this->uploadFile;
    }

    /**
     * @param null|UploadedFile $uploadFile
     */
    public function setUploadFile(?UploadedFile $uploadFile): void
    {
        $this->uploadFile = $uploadFile;
    }

}