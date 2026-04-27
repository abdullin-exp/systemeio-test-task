<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Validator\Exception\ValidationFailedException;

final class ExceptionSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => 'onException',
        ];
    }

    public function onException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if ($exception instanceof HttpExceptionInterface) {

            $previousException = $exception->getPrevious();

            if ($previousException instanceof ValidationFailedException) {

                $errors = [];
                foreach ($previousException->getViolations() as $violation) {
                    $errors[] = [
                        'message' => $violation->getMessage(),
                    ];
                }

                $event->setResponse(
                    new JsonResponse(
                        ['errors' => $errors],
                        Response::HTTP_UNPROCESSABLE_ENTITY
                    )
                );

                return;
            }

            $event->setResponse(
                new JsonResponse(
                    [
                        'errors' => [
                            ['message' => $exception->getMessage()],
                        ],
                    ],
                    $exception->getStatusCode(),
                )
            );

            return;
        }

        $event->setResponse(
            new JsonResponse(
                [
                    'errors' => [
                        ['message' => 'Internal server error'],
                    ],
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR,
            )
        );
    }
}