<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Image
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 * @ORM\EntityListeners({
 *     "App\EntityListener\UploadImageListener"
 * })
 */
class Image
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
     */
    private $path;

    /**
     * @var UploadedFile|null
     * @Assert\Image
     *
     */
    private $uploadFile;

    /**
     * @var Trick
     * @ORM\ManyToOne(targetEntity="Trick", inversedBy="images")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $trick;

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
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
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

    /**
     * @return Trick
     */
    public function getTrick(): Trick
    {
        return $this->trick;
    }

    /**
     * @param Trick $trick
     */
    public function setTrick(?Trick $trick): void
    {
        $this->trick = $trick;
    }
}
