<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 12/01/19
 * Time: 16:52
 */

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Youtube extends Constraint
{
    public $message = "Le lien doit commencer par \"https://www.youtube.com/embed/\" ";
}