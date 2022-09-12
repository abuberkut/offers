<?php

namespace App\Providers;

use App\Repositories\IOfferRepository;
use App\Repositories\IProductRepository;
use App\Repositories\ISellerRepository;
use App\Repositories\OfferRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SellerRepository;
use App\Services\DBTableFiller\AttributesFaker\AttributesFaker;
use App\Services\DBTableFiller\AttributesFaker\IAttributesFaker;
use App\Services\DBTableFiller\DBTableFillerFactory\DBTableFillerFactory;
use App\Services\DBTableFiller\DBTableFillerFactory\IDBTableFillerFactory;
use App\Services\FileReader\CSVFileReader;
use App\Services\FileReader\IFileReader;
use App\Services\FileWriter\CSVFileWriter;
use App\Services\FileWriter\IFileWriter;
use App\Services\FromFileToDBCopier\FromFileToDBCopier;
use App\Services\FromFileToDBCopier\IFromFileToDBCopier;
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
        $this->app->bind(ISellerRepository::class, SellerRepository::class);
        $this->app->bind(IProductRepository::class, ProductRepository::class);
        $this->app->bind(IOfferRepository::class, OfferRepository::class);
        $this->app->bind(IFromFileToDBCopier::class, FromFileToDBCopier::class);
        $this->app->bind(IFileReader::class, CSVFileReader::class);
        $this->app->bind(IFileWriter::class, CSVFileWriter::class);
        $this->app->bind(IDBTableFillerFactory::class, DBTableFillerFactory::class);
        $this->app->bind(IAttributesFaker::class, AttributesFaker::class);
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
