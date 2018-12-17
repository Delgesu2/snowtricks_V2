<?php

namespace App\Form\Handler;

/**
 * Interface HandlerInterface
 * @package App\Form\Handler
 */
interface HandlerInterface
{
    /**
     * Logic when then form is submitted and valid
     */
    public function onSuccess(): void;

    /**
     * Get form type class
     * @return string
     */
    public function getFormType(): string;
}
