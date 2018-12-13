<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 13/12/18
 * Time: 20:28
 */

namespace App\Form\Type\Security;

use App\Validator\Constraints\Password;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

final class ResetPasswordType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('password', PasswordType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Password()
                ]
            ])

            ->add('password2', PasswordType::class, [
                new NotBlank(),
                new Password()
            ])

            ->add('submit', SubmitType::class);
    }
}