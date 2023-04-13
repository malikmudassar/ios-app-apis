<?php

namespace App\Providers;
use Doctrine\DBAL\Types\Type;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Type::addType('enum', 'Doctrine\DBAL\Types\StringType');
        Type::addType('double', 'Doctrine\DBAL\Types\FloatType');
        
        // Replace 'table_name' and 'column_name' with your own table and column names
        $platform = $this->app->make('db')->getDoctrineConnection()->getDatabasePlatform();
        $platform->registerDoctrineTypeMapping('enum', 'enum');
    }
}
