<?php
# api/src/State/UserPasswordHasherProcessor.php
namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Service\Mailer;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserProcessor implements ProcessorInterface
{
    public function __construct(
        private readonly ProcessorInterface $processor, 
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly Mailer $mailer
    )
    {}

    public function process($data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        if (!$data->getPlainPassword()) {
            return $this->processor->process($data, $operation, $uriVariables, $context);
        }
        $hashedPassword = $this->passwordHasher->hashPassword(
            $data,
            $data->getPlainPassword()
        );
        $data->setPassword($hashedPassword);
        $data->eraseCredentials();
        $data->setRoles(['ROLE_USER']);
        $data->setActive(true);
        $result = $this->processor->process($data, $operation, $uriVariables, $context);
        $this->mailer->sendWelcomeMessage($data);
        return $result;
    }
}