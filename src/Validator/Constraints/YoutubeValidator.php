<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 12/01/19
 * Time: 17:12
 */

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class YoutubeValidator
 *
 * @package App\Validator\Constraints
 */
final class YoutubeValidator extends ConstraintValidator
{
    /**
     * @param mixed $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        /* REGEX: Youtube link : "Share" and "Embed" */
        $regex = '#^https://www.youtube.com/embed/#';

        if (!preg_match($regex, $value)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}