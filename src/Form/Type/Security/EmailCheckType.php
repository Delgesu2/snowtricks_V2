<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 05/12/18
 * Time: 22:24
 */

namespace App\Form\Type\Security;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class EmailCheckType
 *
 * @package App\Form\Type\Security
 */
class EmailCheckType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class)
            ->add('submit', SubmitType::class)
        ;
    }
}