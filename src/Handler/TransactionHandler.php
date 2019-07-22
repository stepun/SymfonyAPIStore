<?php


namespace App\Handler;


use App\Entity\Instock;
use App\Entity\Operation;
use App\Entity\Transaction;
use App\Repository\InstockRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class TransactionHandler
{
    /** @var LoggerInterface */
    private $logger;

    /** @var EntityManagerInterface */
    private $entityManager;

    /**
     * @var InstockRepository
     */
    private $instockRepository;

     public function __construct(LoggerInterface $logger, InstockRepository $instockRepository, EntityManagerInterface $em)
     {
         $this->logger = $logger;
         $this->instockRepository = $instockRepository;
         $this->entityManager = $em;
     }

    /**
     * @param Transaction $transaction
     * @return array
     */
    public function handle(Transaction $transaction): array
    {
        $instockEntity = false;

        /**
         * Update/insert InStock balance
         */
        $instockCollection = $this->instockRepository->findBy([
            'storage' => $transaction->getStorage(),
            'product' => $transaction->getProduct(),
        ]);

        if (is_array($instockCollection) && !empty($instockCollection[0])) {
            $instockEntity = $instockCollection[0];
        }

        if ($instockEntity) {

        } else {
            $instockEntity = new Instock();
            $instockEntity->setProduct($transaction->getProduct());
            $instockEntity->setStorage($transaction->getStorage());
        }

        /** @var Operation $operationEntity */
        $operationEntity = $transaction->getOperation();
        $operationType = $operationEntity->getType();

        if ($operationType == Operation::TYPE_WRITE_OFF) {
            $instockEntity->setBalance($instockEntity->getBalance() - $transaction->getQuantityItem());
        }

        if ($operationType == Operation::TYPE_INCOMING) {
            $instockEntity->setBalance($instockEntity->getBalance() + $transaction->getQuantityItem());
        }

        $this->entityManager->persist($instockEntity);
        $this->entityManager->flush();

        return [];
    }
}