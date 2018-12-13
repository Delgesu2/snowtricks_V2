<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 11/12/18
 * Time: 05:06
 */

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class MailAddressCheck extends Constraint
{
    public $message = 'L\'adresse "{{ string }}" ne figure pas dans la liste des utilisateurs.';
}