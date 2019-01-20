<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 06/12/18
 * Time: 18:53
 */

namespace App\Command;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUserCommand extends Command
{
    /**
     * @var UserRepository
     */
    private $repository;

    protected static $defaultName = 'app:create-user';

    /**
     * CreateUserCommand constructor.
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
        parent::__construct();
    }

    protected function configure()
    {
        $this

            // command name (after "bin/console")
                ->setName('app:create-user')

            // shown while running "php bin/console list"
                ->setDescription('Creates a new registered user.')

            // full description when running the command with "--help" option
                ->setHelp('Cette commande vous permet de créer un nouveau compte utilisateur.')

            ->addArgument('pseudo', InputArgument::REQUIRED, 'Chose your username')
            ->addArgument('email', InputArgument::REQUIRED, 'Email')
            ->addArgument('password', InputArgument::REQUIRED, 'Connection password')
            ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'User Creator',
            '=============',
            ''
        ]);

        $output->writeln('Vous allez créer un compte utilisateur.');

        $output->writeln('Nom utilisateur: ' .$input->getArgument('pseudo'));

        $output->writeln('Adresse mail: ' .$input->getArgument('email'));

        $output->writeln('Mot de passe: ' .$input->getArgument('password'));

        $output->writeln('Role: ROLE_USER');

        // persisting Entity
        $user = new User();

        $user->setPseudo($input->getArgument('pseudo'));
        $user->setEmail($input->getArgument('email'));
        $user->setPlainPassword($input->getArgument('password'));

        // persisting Entity
        $this->repository->save($user);

        $output->writeln('Compte utilisateur créé. Bravo.');

    }

}
