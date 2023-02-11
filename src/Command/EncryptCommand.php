<?php 

namespace App\Command;

use App\Service\Encrypter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class EncryptCommand extends Command
{
    protected static $defaultName = 'app:encrypt';

    protected function configure(): void
    {
        $this->setDescription('encrypt string')
            ->addArgument('decrypt_string', InputArgument::REQUIRED, 'the decrypt string.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $decryptString = $input->getArgument('decrypt_string');
        $encrypter = new Encrypter();
        try {

            $data = $encrypter->encrypt($decryptString);
        } catch(\Illuminate\Contracts\Encryption\DecryptException $e) {
            $output->writeln('decrypt_string is invalid, encrypt failed');
            return Command::INVALID;
        }
        $output->writeln($data);
        return Command::SUCCESS;
    }
}