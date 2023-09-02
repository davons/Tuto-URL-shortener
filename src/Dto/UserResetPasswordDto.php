<?php

// api/src/Dto/UserResetPasswordDto.php
namespace App\Dto;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class UserResetPasswordDto
{
    #[Assert\Email]
    #[Groups(['user:create'])]
    public $email;
}