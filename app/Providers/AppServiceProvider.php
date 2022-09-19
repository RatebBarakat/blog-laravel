<?php

namespace App\Providers;

use App\Models\AdminMessage;
use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Post;

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
        $categories = Category::where('visibility','=',1)->get();
        View::share('categories', $categories);

            View::composer('layouts.admin',function ($view)
            {
                $view->with('category_count',Category::count());
                $view->with('post_count',Post::count());
                $view->with('comment_report_count',AdminMessage::whereNotNull('comment_id')->count());
            });
    }
}
