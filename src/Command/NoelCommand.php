<?php

namespace App\Command;

use DateTime;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class NoelCommand extends Command
{
    protected static $defaultName = 'app:noel';

    protected function configure()
    {
        $this
            ->setDescription('return number of days before noel')
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $today = new dateTime();
        $noel=new dateTime('2019-12-25');
        $ecart = $today->diff($noel);

        $output->write($ecart->days." jours restant avant Noël ! \n");
        return 0;
    }
}
