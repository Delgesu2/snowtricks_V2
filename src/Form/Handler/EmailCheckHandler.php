<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 05/12/18
 * Time: 19:30
 */

namespace App\Form\Handler;

use App\Repository\UserRepository;
use Symfony\Component\Form\FormInterface;

class EmailCheckHandler extends AbstractHandler
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @var FormInterface
     */
    protected $form;

    /**
     * EmailCheckHandler constructor.
     *
     * @param UserRepository $repository
     * @param FormInterface $form
     */
    public function __construct(
        UserRepository $repository,
        FormInterface  $form
)
    {
        $this->repository = $repository;
        $this->form       = $form;
    }


    public function onSuccess(): void
    {
        $users = $this->repository->findAll();

        foreach ($users as $user) {
            if ($user->getEmail() === $this->form->getData()->email){
                return;
            }
        }

    }

    public function getFormType(): string
    {
        // TODO: Implement getFormType() method.
    }
}