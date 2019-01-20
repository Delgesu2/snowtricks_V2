<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 30/12/18
 * Time: 19:46
 */

namespace App\Command;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateAdminCommand extends Command
{
    /**
     * @var UserRepository
     */
    private $repository;

    protected static $defaultName = 'app:create-admin';

    /**
     * CreateAdminCommand constructor.
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
            ->setName('app:create-admin')

            // shown while running "php bin/console list"
            ->setDescription('Creates a new administrator.')

            // full description when running the command with "--help" option
            ->setHelp('Cette commande vous permet de créer un nouveau compte administrateur.')

            ->addArgument('userName', InputArgument::REQUIRED, 'Username')
            ->addArgument('email', InputArgument::REQUIRED, 'Email')
            ->addArgument('password', InputArgument::REQUIRED, 'Password')
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
            'Admin Creator',
            '=============',
            ''
        ]);

        $output->writeln('Vous allez créer un compte administrateur.');

        $output->writeln('Nom utilisateur: ' .$input->getArgument('userName'));

        $output->writeln('Adresse mail: ' .$input->getArgument('email'));

        $output->writeln('Mot de passe: ' .$input->getArgument('password'));

        $output->writeln('Role: ROLE_ADMIN');

        // persisting Entity
        $user = new User();

        $user->setPseudo($input->getArgument('pseudo'));
        $user->setEmail($input->getArgument('email'));
        $user->setPlainPassword($input->getArgument('password'));

        // persisting Entity
        $this->repository->save($user);

        $output->writeln('Compte administrateur créé. Bravo.');

    }

}
