<?php
/**
 * Created by PhpStorm.
 * User: muhammadtaqi
 * Date: 3/23/18
 * Time: 5:15 PM
 */

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Lock\Store\SemaphoreStore;
use Symfony\Component\Lock\Factory;
use DateInterval;
use DateTime;

class FinderCommand extends Command
{
    /**
     *
     */
    protected function configure()
    {
        $this
            ->setName('project:component:finder-command')
            ->setDescription('The finder Component!')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Symfony FileSystem!');

        ################################################################################################################


    }
}