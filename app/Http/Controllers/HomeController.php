<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Requests\SearchRequest;
use App\Repositories\BlogRepository;

class HomeController extends Controller
{   

	 /**
     * The BlogRepository instance.
     *
     * @var \App\Repositories\BlogRepository
     */
    protected $blogRepository;

    /**
     * Create a new BlogController instance.
     *
     * @param  \App\Repositories\BlogRepository $blogRepository
     * @return void
    */
    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
 
    }

    /**
     * Display the home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {      
    	  $posts = $this->blogRepository->getActiveWithUserOrderByDate(20);
 
          $links = $posts->appends([
            'name' => 'posts.created_at',
            'sens' => 'asc'
          ]);

           
          $links->links();

          $order = new \stdClass;
          $order->name = 'posts.created_at';
          $order->sens = 'sort-' . 'asc';

    	  return view('front.index', compact('posts', 'links', 'order'));
    }


}
