<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\blog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Benchmark;
class BlogController extends Controller
{

    public function seedBlog()
    {
        $i=0;
        for($i ; $i <= 500000; $i++){

            DB::table('blogs')->insert([
                'title' => "$i blog",
                'sub_header' => "This is the $i sub header",
                'content' => 'BLOG_CONTENT'
            ]);
        }
        return 'Done';
    }
    public function index($id) {

        $cachedBlog = Redis::get('blog_' . $id);


        if(isset($cachedBlog)) {
            $blog = json_decode($cachedBlog, FALSE);

            return response()->json([
                'status_code' => 201,
                'message' => 'Fetched from redis',
                'data' => $blog,
            ]);
        }else {
            Benchmark::dd([
                'Get Blogs' => fn () => blog::all(),
            ]); // ms
            // $blog = blog::find($id);
            // Redis::set('blog_' . $id, $blog);

            // return response()->json([
            //     'status_code' => 201,
            //     'message' => 'Fetched from database',
            //     'data' => $blog,
            // ]);
        }
      }

      public function all()
      {


        //   $blog = DB::table('blogs')->get();
        //   $blog = blog::all();

        // Redis::set('blog', $blog);
         $redisBlog = Redis::get('blog');
         return response()->json([
         	'message' => $redisBlog]);
        // return 'done';
        // Benchmark::dd([
        //         'Get Blogs' => fn () => blog::all(),
        //     ]); // ms

            // Benchmark::dd([
            //     'Get Blogs' => fn () => DB::table('blogs')->take(20)->get(),
            // ]); // ms


            // die();

        // $cachedBlog = Redis::get('blog');
        // Benchmark::dd([
        //         'Get Blogs' => fn () => Redis::get('blog'),
        //     ]); // ms
            // die();

        // if(isset($cachedBlog)) {
        //     $blog = json_decode($cachedBlog, FALSE);

        //     return response()->json([
        //         'status_code' => 201,
        //         'message' => 'Fetched from redis',
        //         'data' => $blog,
        //     ]);
        // }else {
            // Benchmark::dd([
            //     'Get Blogs' => fn () => blog::all(),
            // ]); // ms
            // $blog = blog::all();
            // Redis::set('blog', $blog);

            // return response()->json([
            //     'status_code' => 201,
            //     'message' => 'Fetched from database',
            //     'data' => $blog,
            // ]);
        // }

      }
}
