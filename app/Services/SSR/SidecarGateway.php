<?php

namespace App\Services\SSR;

use App\Sidecar\SSR;
use Exception;
use Hammerstone\Sidecar\LambdaFunction;
use Inertia\Ssr\Gateway;
use Inertia\Ssr\Response;
use Throwable;

class SidecarGateway implements Gateway
{
    public function dispatch(array $page): ?Response
    {
        $enabled = config('inertia.ssr.enabled', false);
        $debug = config('app.debug', false);

        if (! $enabled) {
            return null;
        }

        try {
            return $this->execute(SSR::class, $page);
        } catch (Throwable $e) {
            if ($debug) {
                throw $e;
            }

            return null;
        }
    }

    protected function execute($handler, array $page): ?Response
    {
        $handler = app($handler);

        if (! $handler instanceof LambdaFunction) {
            throw new Exception('The configured Sidecar SSR Handler is not a Sidecar function.');
        }

        $response = $handler::execute($page)->throw()->body();

        return new Response(
            implode("\n", $response['head']),
            $response['body']
        );
    }
}
