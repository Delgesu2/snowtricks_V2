<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 05/12/18
 * Time: 22:24
 */

namespace App\Form\Type\Security;

use App\Validator\Constraints\MailAddressCheck;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class EmailCheckType
 *
 * @package App\Form\Type\Security
 */
final class EmailCheckType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank(),
                    new MailAddressCheck()
                ]
            ])
            ->add('submit', SubmitType::class)
        ;
    }
}