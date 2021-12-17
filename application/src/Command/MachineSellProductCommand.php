<?php

namespace App\Command;

use App\Domain\Coin;
use App\Domain\Exceptions\NotEnoughFundsException;
use App\Domain\Exceptions\ProductNotFoundException;
use App\Domain\MachineService;
use App\Domain\PaymentService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class MachineSellProductCommand extends Command
{
    protected static $defaultName = 'app:sell-product';

    private MachineService $machineService;
    private PaymentService $paymentService;


    public function __construct(MachineService $machineService, PaymentService $paymentService)
    {
        $this->machineService = $machineService;
        $this->paymentService = $paymentService;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('product', InputArgument::OPTIONAL, 'Product name')
            ->addArgument('coins', InputArgument::OPTIONAL, 'Coins')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper('question');

        $productName = $input->getArgument('product');
        if (!$productName) {
            $question = new Question('Please select the product. Allowed options are A, B, C: ', 'A');
            $productName = $helper->ask($input, $output, $question);

        }

        $coinsStr = $input->getArgument('coins');
        if (!$coinsStr) {
            $question = new Question('Please enter the coins, separated by space: ', 'A');
            $coinsStr = $helper->ask($input, $output, $question);
        }


        try {
            $payment = $this->paymentService->getPayment($coinsStr);

            $sellChange = $this->machineService->sell($productName, $payment);

            $resultStr = array_map(fn(Coin $coin) => $coin->getAmount()->getAmount(), $sellChange->getCoins()->get());
            $resultStr = implode(', ', $resultStr);
            $changeAmount = $sellChange->getCoins()->getAmount();
            $message = sprintf('Your change is %s cents, coins are %s', $changeAmount->getAmount(), $resultStr);

            $output->writeln($message);

            return Command::SUCCESS;
        } catch (NotEnoughFundsException|ProductNotFoundException $e) {
            $output->writeln('Error: ' . get_class($e));
        }

        return Command::FAILURE;
    }

}