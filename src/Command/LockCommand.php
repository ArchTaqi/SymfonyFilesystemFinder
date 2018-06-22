<?php
/**
 * Created by PhpStorm.
 * User: muhammadtaqi
 * Date: 3/23/18
 * Time: 4:51 PM
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

/**
 * Class LockCommand
 * @package App\Command
 */
class LockCommand extends Command
{
    /**
     *
     */
    protected function configure()
    {
        $this
            ->setName('project:component:lock-command')
            ->setDescription('The Lock Component!')
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
        $lockHandler = new LockHandler($this->getName());
        if (!$lockHandler->lock()) {
            echo "Jiná instance commandu ještě běží!";
            return false;
        }
        $filesystem = new Filesystem();
        $files = [
            "http://placekitten.com/408/287",
            "http://placekitten.com/300/128",
            "http://placekitten.com/123/456",
            "http://placekitten.com/54/68",
            "http://foo.bar/123"
        ];
        foreach ($files as $key => $file) {
            try {
                $targetDir = "tmp/".$key;
                $filesystem->mkdir($targetDir);
                $targetFile = $targetDir . "/" . $key . ".jpg";
                $outputInterface->write("kopíruji " . $file . " do " . $targetFile." - ");
                $filesystem->copy($file, $targetFile);
            } catch (IOException $e) {
                $outputInterface->writeln("Chyba ".$e->getMessage());
                continue;
            }
            $outputInterface->writeln("OK!");
            //Pro další příklad si ještě upravíme čas přístupu
            $accessDate = new DateTime();
            $accessDate->sub(new DateInterval("P".$key."D"));
            $filesystem->touch($targetFile, $accessDate->format("U"), $accessDate->format("U"));
        }

    }
}