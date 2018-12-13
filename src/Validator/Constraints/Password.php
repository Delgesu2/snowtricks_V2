<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 13/12/18
 * Time: 23:09
 */

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Password extends Constraint
{
    public $message = 'Mot de passe invalide. Un mot de passe doit contenir au moins 8 caractères,
     1 majuscule et 1 chiffre';
}