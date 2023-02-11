<?php 

namespace App\Command;

use App\Service\Encrypter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DecryptCommand extends Command
{
    protected static $defaultName = 'app:decrypt';

    protected function configure(): void
    {
        $this->setDescription('decrypt string')
            ->addArgument('encrypt_string', InputArgument::REQUIRED, 'the encrypt string.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $encryptString = $input->getArgument('encrypt_string');
        $encrypter = new Encrypter();
        try {
            $data = $encrypter->decrypt($encryptString);
        } catch(\Illuminate\Contracts\Encryption\DecryptException $e) {
            $output->writeln('encrypt_string is invalid, decrypt failed');
            return Command::INVALID;
        }
        $output->writeln($data);
        return Command::SUCCESS;
    }
}