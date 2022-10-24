<?php

namespace App\Sidecar;

use Hammerstone\Sidecar\LambdaFunction;
use Hammerstone\Sidecar\Package;
use Hammerstone\Sidecar\Sidecar;
use Symfony\Component\Process\Process;
use Tightenco\Ziggy\Ziggy;

class SSR extends LambdaFunction
{
    public function memory(): int
    {
        // The more memory you give your function, the faster it will
        // run, but the more expensive it will be. You will need to
        // find the settings that are right for your application.
        return 1024;
    }

    public function handler(): string
    {
        // The compiled SSR file is "ssr.mjs", built by Vite. It is
        // located in bootstrap/ssr by default. The function that
        // handles the incoming event is called "handler."
        return 'bootstrap/ssr/ssr.handler';
    }

    public function package(): Package
    {
        $package = Package::make();

        // Since Vite externalizes dependencies, we need to include node_modules.
        // https://vitejs.dev/guide/ssr.html#ssr-externals
        $package->include([
            base_path('bootstrap/ssr'),
            'node_modules'
        ]);

        $this->includeZiggy($package);

        return $package;
    }

    protected function includeZiggy(Package $package)
    {
        $ziggy = json_encode(new Ziggy);

        Sidecar::log('Adding Ziggy to the package.');

        // Include a file called "compiledZiggy" that simply exports
        // the entire Ziggy PHP object we just serialized.
        $package->includeStrings([
            'bootstrap/ssr/compiledZiggy.mjs' => "export default $ziggy;"
        ]);
    }

    public function beforeDeployment(): void
    {
        Sidecar::log('Executing beforeDeployment hooks');

        // Compile the SSR bundle before deploying.
        $this->compileJavascript();
    }

    protected function compileJavascript(): void
    {
        Sidecar::log('Compiling Inertia SSR bundle.');

        $command = ['vite', 'build', '--ssr'];

        Sidecar::log('Running ' . implode(' ', $command));

        $process = new Process($command, $cwd = base_path(), $env = []);

        // mustRun will throw an exception if it fails, which is what we want.
        $process->setTimeout(60)->disableOutput()->mustRun();

        Sidecar::log('JavaScript SSR bundle compiled!');
    }
}
