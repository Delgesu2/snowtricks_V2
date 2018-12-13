<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 13/12/18
 * Time: 17:39
 */

namespace App\Tests;

use App\Command\CreateUserCommand;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class CreateUserCommandTest extends KernelTestCase
{
    public function testExecute()
    {
        $kernel = static ::createKernel();
        $application = new Application($kernel);

        $command = $application->find('app::create-admin');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command' => $command->getName(),

            'userName' => 'Xavier',
            'email'    => 'xavierus70@hotmail.com',
            'password' => 'Password2'

        ));

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertContains('Username: Xavier', $output);
    }
}
