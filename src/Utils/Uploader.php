<?php

namespace App\Utils;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class Uploader
 * Create new file name and upload this file.
 * @package App\Utils
 */
class Uploader
{
    /**
     * @var string
     */
    private $uploadDir;

    /**
     * Uploader constructor.
     * @param string $uploadDir
     */
    public function __construct(string $uploadDir)
    {
        $this->uploadDir = $uploadDir;
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    public function upload(UploadedFile $file): string
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();
        $file->move($this->uploadDir, $fileName);

        return $fileName;
    }
}