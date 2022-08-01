<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Entities\Contact;
use App\Repositiories\DoctrineContactRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DoctrineContactRepository::class, function($app) {
            // This is what Doctrine's EntityRepository needs in its constructor.
            return new DoctrineContactRepository(
                $app['em'],
                $app['em']->getClassMetaData(Contact::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
