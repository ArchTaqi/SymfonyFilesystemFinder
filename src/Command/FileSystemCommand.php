<?php
/**
 * Created by PhpStorm.
 * User: muhammadtaqi
 * Date: 3/23/18
 * Time: 3:04 PM
 */

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Filesystem\Filesystem;
use DateInterval;
use DateTime;

/**
 * Class FileSystemCommand
 * @package App\Command
 */
class FileSystemCommand extends Command
{
    /**
     *
     */
    protected function configure()
    {
        $this
            ->setName('project:component:file-system')
            ->setDescription('FileSystem1 Command!')
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

        $filesystem = new Filesystem();
        $filesystem->dumpFile('foo.txt', 'This is a sample content');
        //the folder to which we will move it
        $filesystem->mkdir("tmp/test");
        //and let's go!
        $filesystem->copy("foo.txt", "tmp/test/foo.txt", true);
        $output->writeln('File (tmp/test/foo.txt) exists ? ');
        $output->writeln($filesystem->exists("tmp/test/foo.txt") ? "Yes" : "No");


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