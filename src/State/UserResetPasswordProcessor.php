<?php
namespace App\State;

use App\Entity\User;
use App\Dto\UserResetPasswordDto;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Repository\UserRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserResetPasswordProcessor implements ProcessorInterface
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly UserRepository $userRepository
    ){}

    /**
     * @param UserResetPasswordDto $data
     */
    public function process($data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        if ($data->password) {
            $user = $this->userRepository->findOneBy(['auth_token' => $data->authToken]);
            if ($user instanceof User) {
                $hashedPassword = $this->passwordHasher->hashPassword(
                    $user,
                    $data->password
                );
                $user->setPassword($hashedPassword);
            }
            throw new NotFoundHttpException('User not found');
        }
        throw new NotFoundHttpException('User not found');
    }
}