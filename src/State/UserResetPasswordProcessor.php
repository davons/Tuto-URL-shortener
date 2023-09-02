<?php
namespace App\State;
use App\Dto\UserResetPasswordDto;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class UserResetPasswordProcessor implements ProcessorInterface
{
    /**
     * @param UserResetPasswordDto $data
     */
    public function process($data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        if ('user@example.com' === $data->email) {
            return new User(email: $data->email, id: 1);
        }
        throw new NotFoundHttpException();
    }
}