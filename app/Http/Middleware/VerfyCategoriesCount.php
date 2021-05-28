<?php

namespace App\Http\Middleware;

use App\Models\Category;
use Closure;
use Illuminate\Http\Request;

class VerfyCategoriesCount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Category::all()->count() === 0){
            session()->flash('warning','you have to create a category first');
            return redirect(route('categories.create'));
        }
        return $next($request);
    }
}
