<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 06/12/18
 * Time: 20:36
 */

namespace App\Form\Type\Security;

use App\Form\Model\Security\Register;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /**
         * {@inheritdoc}
         */
        $builder
            ->add('_username', TextType::class, [
                'required' => true
            ])

            ->add('_email', EmailType::class, [
                'required' =>true
            ])

            ->add('_avatar', FileType::class, [
                'multiple' => false,
                'required' => false
            ])

            ->add('_password', PasswordType::class, [
                'required' => true
            ])

            ->add('submit', SubmitType::class)
            ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => Register::class
        ]);
    }

}