<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
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

        // обрабатываем ошибки валидации
        if ($exception instanceof UnprocessableEntityHttpException) {

            $previous = $exception->getPrevious();

            if ($previous instanceof ValidationFailedException) {

                $errors = [];
                foreach ($previous->getViolations() as $violation) {
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
        }

        if ($exception instanceof HttpExceptionInterface) {

            $event->setResponse(
                new JsonResponse(
                    [
                        'errors' => [
                            $exception->getMessage(),
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
                        'Internal server error',
                    ],
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR,
            )
        );

    }
}