<?php

namespace JustBetter\StatamicFeedbackCompany;

use JustBetter\StatamicFeedbackCompany\Commands\HarvestReviewsCommand;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    public function bootAddon()
    {
        $this->bootCommands()
             ->bootConfig()
             ->bootPublishables()
             ->bootRoutes();
    }

    public function bootCommands(): static
    {
        $this->commands([
            HarvestReviewsCommand::class,
        ]);

        return $this;
    }

    public function bootConfig(): static
    {
        $this->mergeConfigFrom(__DIR__.'/../config/feedback-company.php', 'feedback-company');

        return $this;
    }

    public function bootPublishables(): static
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources' => resource_path('/'),
            ], 'blueprints');
            $this->publishes([
                __DIR__.'/../config/feedback-company.php' => config_path('feedback-company.php'),
            ], 'config');
        }

        return $this;
    }

    protected function bootRoutes(): static
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

        return $this;
    }
}
