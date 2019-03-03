<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
// Fields
use Thtg88\MmCms\Events\ContentFieldDestroyed;
use Thtg88\MmCms\Events\ContentFieldStored;
use Thtg88\MmCms\Events\ContentModelStored;
// Listeners
use Thtg88\MmCms\Listeners\MakeContentFieldDropColumnMigration;
use Thtg88\MmCms\Listeners\MakeContentFieldMigration;
use Thtg88\MmCms\Listeners\MakeContentModelMigration;
use Thtg88\MmCms\Listeners\MakeContentModelModel;
use Thtg88\MmCms\Listeners\MakeContentModelRepository;
use Thtg88\MmCms\Listeners\MakeContentModelDestroyRequest;
use Thtg88\MmCms\Listeners\MakeContentModelStoreRequest;
use Thtg88\MmCms\Listeners\MakeContentModelUpdateRequest;
use Thtg88\MmCms\Listeners\MakeContentModelController;
use Thtg88\MmCms\Listeners\DatabaseMigrate;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ContentModelStored::class => [
            MakeContentModelMigration::class,
            MakeContentModelModel::class,
            MakeContentModelRepository::class,
            MakeContentModelDestroyRequest::class,
            MakeContentModelStoreRequest::class,
            MakeContentModelUpdateRequest::class,
            MakeContentModelController::class,
            DatabaseMigrate::class,
        ],
        ContentFieldDestroyed::class => [
            MakeContentFieldDropColumnMigration::class,
            DatabaseMigrate::class,
        ],
        ContentFieldStored::class => [
            MakeContentFieldMigration::class,
            DatabaseMigrate::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
