<?php

// api/src/Dto/UserForgotPasswordDto.php
namespace App\Dto;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class UserForgotPasswordDto
{
    #[Assert\Email]
    #[Groups(['user:create'])]
    public string $email;
}