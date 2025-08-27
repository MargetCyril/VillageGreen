<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;

class SendMailService
{
    private $mailer;

    public function __construct(MailerInterface $mailer, string $fromEmail)
    {

    }

    public function sendEmail(
        string $to,
        string $subject,
        string $content,
        string $template,
        array $context
        ): void
    {
        $email = (new TemplatedEmail())
            ->from($this->fromEmail)
            ->to($to)
            ->subject($subject)
            ->htmlTemplate("email/$template.html.twig")
            ->text($context);

        $this->mailer->send($email);
    }
}