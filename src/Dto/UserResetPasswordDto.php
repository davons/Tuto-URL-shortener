<?php

// api/src/Dto/UserResetPasswordDto.php
namespace App\Dto;

use Symfony\Component\Serializer\Annotation\Groups;

final class UserResetPasswordDto
{
    #[Groups(['user:create'])]
    public string $password;

    #[Groups(['user:create'])]
    public string $passwordConfirm;
}