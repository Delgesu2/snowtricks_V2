<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 31/12/18
 * Time: 18:26
 */

namespace App\Form\Type\Security;

use App\Entity\User;
use App\Form\Model\Security\Register;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


final class UpdateUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /**
         * {@inheritdoc}
         */
        $builder
            ->add('pseudo', TextType::class, [
                'required' => true
            ])

            ->add('_email', EmailType::class, [
                'required' =>true
            ])

            ->add('uploadFile', FileType::class, [
                'multiple'   => false,
                'required'   => false,
                'data_class' => null
            ])

            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer'
            ])

        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }

}