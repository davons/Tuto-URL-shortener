<?php
# api/src/State/UserPasswordHasherProcessor.php
namespace App\State;

use ApiPlatform\Metadata\DeleteOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\State\ProcessorInterface;
use App\Service\Mailer;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserProcessor implements ProcessorInterface
{
    public function __construct(
        private readonly ProcessorInterface $persistProcessor,
        private readonly ProcessorInterface $removeProcessor,
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly Mailer $mailer
    )
    {}

    public function process($data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        // Delete
        if ($operation instanceof DeleteOperationInterface) {
            return $this->removeProcessor->process($data, $operation, $uriVariables, $context);
        }
     
        // Create
        if ($operation instanceof Post) {
            $data->setRoles(['ROLE_USER']);
            $data->setActive(false);
            $hashedPassword = $this->passwordHasher->hashPassword(
                $data,
                $data->getPlainPassword()
            );
            $data->setPassword($hashedPassword);
            $data->eraseCredentials();
            $data->setCreatedAt(new \DateTimeImmutable('now'));
        }

        // Update
        if ($operation instanceof Put) {
            $data->setUpdatedAt(new \DateTimeImmutable('now'));
        }

        $result = $this->persistProcessor->process($data, $operation, $uriVariables, $context);

        //send welcome email
        if ($operation instanceof Post) {
            $this->mailer->sendWelcomeMessage($data);
        }

        return $result;
    }
}