<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 06/12/18
 * Time: 20:36
 */

namespace App\Form\Type\Security;

use App\Entity\User;
use App\Form\Model\Security\Register;
use App\Validator\Constraints\Password;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

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

            ->add('avatar', FileType::class, [
                'multiple' => false,
                'required' => false,
                'data_class' => null
            ])



            ->add('plainPassword', PasswordType::class, [
                'required'    => true,
                'constraints' => [
                    new NotBlank(),
                    new Password()
                ]
            ])


            /**
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                /** @var User $user */
          /**    $user = $event->getData();

                if (!$user) {

                    $event->getForm()->add('plainPassword', PasswordType::class, [
                        'constraints' => [
                            new NotBlank(),
                            new Password()
                        ]
                    ]);
                }
            }) **/


            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                /** @var User $user */
                $user = $event->getData();

                $event->getForm()->add('submit', SubmitType::class, [
                    'label' => $user->getId() ? 'Modifier' : 'Ajouter'
                ]);
            })
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