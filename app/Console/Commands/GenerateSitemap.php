<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use File;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scheduling Generate sitemap';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $sitemap = \App::make('sitemap');
        // add home pages mặc định
        $sitemap->add(url('/'), Carbon::now(), '1.0', 'daily');

        // add danh muc san pham
        $categories = DB::table('product_categories')
                ->orderBy('created_at', 'desc')
                ->get();
        foreach ($categories as $category) {
            $sitemap->add(url($category->product_category_slug), $category->created_at, '0.8', 'daily');
        }

        // add tag san pham
        /*$tags = DB::table('product_tags')
                ->orderBy('created_at', 'desc')
                ->get();
        foreach ($tags as $tag) {
            $sitemap->add(url('tag/' . $tag->tag_slug), $tag->created_at, '0.7', 'daily');
        }*/
        
        // add san pham
        $products = DB::table('products')
                ->orderBy('created_at', 'desc')
                ->get();
        foreach ($products as $product) {
            $sitemap->add(url($product->product_slug . '-rsp'), $product->created_at, '0.9', 'daily');
        }

        // add chuyen muc bài viết
        $categories = DB::table('post_categories')
                ->orderBy('created_at', 'desc')
                ->get();
        foreach ($categories as $category) {
            $sitemap->add(url($category->category_slug . '.html'), $category->created_at, '0.5', 'daily');
        }

        // add tag bài viết
        /*$tags = DB::table('post_tags')
                ->orderBy('created_at', 'desc')
                ->get();
        foreach ($tags as $tag) {
            $sitemap->add(url('tag/' .$tag->tag_slug . '.html'), $category->created_at, '0.5', 'daily');
        }*/

        // add bài viết
        $posts = DB::table('posts')
                ->orderBy('created_at', 'desc')
                ->get();
        foreach ($posts as $post) {
            $sitemap->add(url($post->post_slug.'-bv.html'), $post->created_at, '0.6', 'daily');
        }

        //add trang tinh
        $staticPage = DB::table('static_pages')->get();
        $sitemap->add(url('san-pham'), $staticPage[4]->updated_at, '0.6', 'daily');
        $sitemap->add(url('gioi-thieu'), $staticPage[1]->updated_at, '0.6', 'weekly');
        $sitemap->add(url('lien-he'), $staticPage[2]->updated_at, '0.6', 'monthly');
        $sitemap->add(url('tuyen-dung'), $staticPage[5]->updated_at, '0.6', 'monthly');

        // lưu file và phân quyền
        $sitemap->store('xml', 'sitemap');
        if (File::exists(public_path() . '/sitemap.xml')) {
                chmod(public_path() . '/sitemap.xml', 0777);
        }
    }
}
