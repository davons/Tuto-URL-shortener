<?php
namespace App\State;

use App\Entity\User;
use App\Dto\UserResetPasswordDto;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Repository\UserRepository;
use App\Service\Mailer;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class UserForgotPasswordProcessor implements ProcessorInterface
{
    public function __construct(
        private readonly Mailer $mailer,
        private readonly UserRepository $userRepository
    ){}

    /**
     * @param UserResetPasswordDto $data
     */
    public function process($data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        if ($data->email) {
            $user = $this->userRepository->findOneBy(['email' => $data->email]);
            if ($user instanceof User) {
                $this->mailer->sendWelcomeMessage($user);
            }
            throw new NotFoundHttpException('User not found');
        }
        throw new NotFoundHttpException('User not found');
    }
}