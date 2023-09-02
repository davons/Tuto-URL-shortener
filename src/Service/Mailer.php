<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;

class Mailer
{
    /**
     * @param MailerInterface $mailer
     */
    public function __construct(private readonly MailerInterface $mailer)
    {}

    /**
     * @param User $user
     * @return void
     */
    public function sendWelcomeMessage(User $user): void
    {
        $email = (new TemplatedEmail())
            ->from(new NamedAddress('urlhortify@example.com', 'URLShortify'))
            ->to(new NamedAddress($user->getEmail(), $user->getName()))
            ->subject('Bienvenu sur URLShortify!')
            ->htmlTemplate('email/welcome.html.twig')
            ->context([
                'user' => $user,
            ]);
        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $e) {
        }
    }


    /**
     * @param User $user
     * @return void
     */
    public function sendResetPasswordMessage(User $user): void
    {
        $email = (new TemplatedEmail())
            ->from(new NamedAddress('urlhortify@example.com', 'URLShortify'))
            ->to(new NamedAddress($user->getEmail(), $user->getName()))
            ->subject('Réinitialiser mon mot de passe!')
            ->htmlTemplate('email/reset-password.html.twig')
            ->context([
                'user' => $user,
            ]);
        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $e) {
        }
    }
}