<?php

namespace App\Form\Handler;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class AbstractHandler
 * @package App\Form\Handler
 */
abstract class AbstractHandler implements HandlerInterface
{
    /**
     * @var FormFactoryInterface
     */
    protected $formFactory;

    /**
     * @var RequestStack
     */
    protected $requestStack;

    /**
     * @var FormInterface
     */
    protected $form;

    /**
     * @var mixed
     */
    protected $data;

    /**
     * @Required
     * @param FormFactoryInterface $formFactory
     */
    public function setFormFactory(FormFactoryInterface $formFactory): void
    {
        $this->formFactory = $formFactory;
    }

    /**
     * @Required
     * @param RequestStack $requestStack
     */
    public function setRequestStack(RequestStack $requestStack): void
    {
        $this->requestStack = $requestStack;
    }

    /**
     * Create form
     */
    protected function createForm()
    {
        $this->form = $this->formFactory->create(
            $this->getFormType(),
            $this->data
        );
    }

    /**
     * Handle form
     * @param $data
     * @return bool
     */
    public function handle($data): bool
    {
        $this->data = $data;

        $this->createForm();

        $this->form->handleRequest($this->requestStack->getCurrentRequest());

        if($this->form->isSubmitted() and $this->form->isValid()) {
            $this->onSuccess();

            return true;
        }

        return false;
    }

    /**
     * @return FormView
     */
    public function getView(): FormView
    {
        return $this->form->createView();
    }


}