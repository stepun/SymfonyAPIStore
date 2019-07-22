<?php


namespace App\Controller;


use App\Entity\Transaction;
use App\Handler\TransactionHandler;
use DateTime;

class CreateTransaction
{
    private $transactionHandler;

    public function __construct(TransactionHandler $transactionHandler)
    {
        $this->transactionHandler = $transactionHandler;
    }

    /**
     * @param Transaction $data
     * @return Transaction
     * @throws \Exception
     */
    public function __invoke(Transaction $data): Transaction
    {
        $dt = new DateTime($data->getDocumentDate());
        $dt->format('Y-m-d');
        $data->setDocumentDate($dt);
        $this->transactionHandler->handle($data);

        return $data;
    }
}