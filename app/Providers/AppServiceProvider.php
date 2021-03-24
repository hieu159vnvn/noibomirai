<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Collection;
use App\Models\Menu;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Config;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\NhanVien;
use App\Models\HoSoHocVien;
use App\Models\StaticPage;
use App\Models\DoiTac;
use Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        Schema::defaultStringLength(191);

    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
