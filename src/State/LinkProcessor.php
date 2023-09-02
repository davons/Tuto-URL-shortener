<?php

namespace App\State;

use ApiPlatform\Metadata\DeleteOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use Symfony\Bundle\SecurityBundle\Security;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;

final class LinkProcessor implements ProcessorInterface
{
    /**
     * @param ProcessorInterface $persistProcessor
     * @param ProcessorInterface $removeProcessor
     * @param Security $security
     */
    public function __construct(
        protected readonly ProcessorInterface $persistProcessor,
        protected readonly ProcessorInterface $removeProcessor,
        protected readonly Security $security,
    ){}

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        // Delete
        if ($operation instanceof DeleteOperationInterface) {
            return $this->removeProcessor->process($data, $operation, $uriVariables, $context);
        }

        $data->setOwner($this->security->getUser());
       
        if ($operation instanceof Post) {
            $data->setCreatedAt(new \DateTimeImmutable('now'));
        }

        if ($operation instanceof Put) {
            $data->setUpdatedAt(new \DateTimeImmutable('now'));
        }

        return $this->persistProcessor->process($data, $operation, $uriVariables, $context);
    }
}
