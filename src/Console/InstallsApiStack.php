<?php

namespace Laravel\Breeze\Console;

use Illuminate\Filesystem\Filesystem;

trait InstallsApiStack
{
    /**
     * Install the API Breeze stack.
     *
     * @return void
     */
    protected function installApiStack()
    {
        //

        // Prepend \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class to 'api' middleware group...
        // Point 'verified' middleware at App namespaced middleware...

        $this->info('Breeze scaffolding installed successfully.');
    }
}