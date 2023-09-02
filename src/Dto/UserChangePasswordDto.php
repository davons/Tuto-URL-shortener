<?php

// api/src/Dto/UserChangePasswordDto.php
namespace App\Dto;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;

final class UserChangePasswordDto
{
    #[SecurityAssert\UserPassword]
    #[Groups(['user:create'])]
    public string $currentPassword;

    #[Groups(['user:create'])]
    public string $password;

    #[Groups(['user:create'])]
    public string $passwordConfirm;
}