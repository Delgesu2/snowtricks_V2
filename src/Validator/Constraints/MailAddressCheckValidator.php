<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 11/12/18
 * Time: 05:17
 */

namespace App\Validator\Constraints;

use App\Repository\UserRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\InvalidArgumentException;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Class MailAddressCheckValidator
 *
 * @package App\Validator\Constraints
 */
class MailAddressCheckValidator extends ConstraintValidator
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * MailAddressCheckValidator constructor.
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param mixed $value
     * @param Constraint $constraint
     *
     * @throws \Doctrine\ORM\ORMException
     */
    public function validate($value, Constraint $constraint)
    {
        if (($this->repository->countByEmail($value)) == 0) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
    }

}