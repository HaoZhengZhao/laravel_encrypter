<?php 

namespace App\Command;

use Illuminate\Encryption\Encrypter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateKeyCommand extends Command
{
    protected static $defaultName = 'app:key';

    protected function configure(): void
    {
        $this->setDescription('generate APP_KEY');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $appKey = Encrypter::generateKey('AES-256-CBC');
        $appKey = 'base64:'.base64_encode($appKey);
        $output->writeln($appKey);
        return Command::SUCCESS;
    }
}