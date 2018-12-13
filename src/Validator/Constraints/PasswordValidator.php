<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 13/12/18
 * Time: 23:10
 */

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class PasswordValidator
 *
 * @package App\Validator\Constraints
 */
class PasswordValidator extends ConstraintValidator
{
    /**
     * @param mixed $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        /* REGEX: at least 1 capital letter, 1 number, at least 8 characters, no space */
        $regex = '#(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])\S{8,}#';

        if (!preg_match($regex, $value)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}