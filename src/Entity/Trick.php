<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Trick
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\TrickRepository")
 * @ORM\EntityListeners({
 *     "App\EntityListener\SlugTrickNameListener",
 *     "App\EntityListener\TimestampableTrickListener"
 * })
 */
class Trick
{
    /**
     * @var int|null
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Veuillez saisir un nom.")
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string", unique=true)
     */
    private $slug;

    /**
     * @var string
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Veuillez saisir une description.")
     */
    private $description;

    /**
     * @var UserInterface|null
     * @ORM\ManyToOne(targetEntity="User", inversedBy="tricks")
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     */
    private $createdBy;

    /**
     * @var UserInterface|null
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     */
    private $updatedBy;

    /**
     * @var \DateTimeImmutable
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @var \DateTimeImmutable|null
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updatedAt;


    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Image", mappedBy="trick", cascade={"persist"}, orphanRemoval=true, fetch="EXTRA_LAZY")
     * @Assert\Valid
     * @Assert\Count(min=1, minMessage="Veuillez ajouter au moins une image.")
     */
    private $images;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Video", mappedBy="trick", cascade={"persist"}, orphanRemoval=true)
     * @Assert\Valid
     */
    private $videos;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="trick", cascade={"persist"}, orphanRemoval=true)
     */
    private $comments;

    /**
     * @var Category|null
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="tricks")
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     * @Assert\NotNull(message="Veuillez sélectionner une catégorie.")
     */
    private $category;

    /**
     * Trick constructor.
     */
    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->videos = new ArrayCollection();
        $this->comments = new ArrayCollection();
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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSlug(): ?string
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
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return null|UserInterface
     */
    public function getCreatedBy(): ?UserInterface
    {
        return $this->createdBy;
    }

    /**
     * @param null|UserInterface $createdBy
     */
    public function setCreatedBy(?UserInterface $createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return null|UserInterface
     */
    public function getUpdatedBy(): ?UserInterface
    {
        return $this->updatedBy;
    }

    /**
     * @param null|UserInterface $updatedBy
     */
    public function setUpdatedBy(?UserInterface $updatedBy): void
    {
        $this->updatedBy = $updatedBy;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeImmutable $createdAt
     */
    public function setCreatedAt(\DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTimeImmutable|null $updatedAt
     */
    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Get random image in ArrayCollection directly in database thanks to Doctrine's Criteria
     * @return Image
     */
    public function getRandomImage(): Image
    {
        return $this->images->get(array_rand($this->images->toArray()));
    }

    /**
     * @return string
     */
    public function getMainImage(): string
    {
        return $this->getRandomImage()->getPath();
    }

    /**
     * @param string $mainImage
     */
    public function setMainImage(string $mainImage): void
    {
        $this->mainImage = $mainImage;
    }

    /**
     * @return Collection
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    /**
     * @param Image $image
     */
    public function addImage(Image $image)
    {
        $image->setTrick($this);
        $this->images->add($image);
    }

    /**
     * @param Image $image
     */
    public function removeImage(Image $image)
    {
        $image->setTrick(null);
        $this->images->removeElement($image);
    }

    /**
     * @return Collection
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    /**
     * @param Video $video
     */
    public function addVideo(Video $video)
    {
        $video->setTrick($this);
        $this->videos->add($video);
    }

    /**
     * @param Video $video
     */
    public function removeVideo(Video $video)
    {
        $video->setTrick(null);
        $this->videos->removeElement($video);
    }

    /**
     * @return Collection
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    /**
     * @return Category|null
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * @param Category|null $category
     */
    public function setCategory(?Category $category): void
    {
        $this->category = $category;
    }


}
