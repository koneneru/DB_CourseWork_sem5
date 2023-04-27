<?php

namespace App\Http\ViewComposers;

use App\Models\Category;
use Illuminate\View\View;

class CategoriesComposer
{
    public function compose(View $view)
    {
        return $view->with('categories',
            Category::where('available', true)
                    ->orderBy('name')->get());
    }
}
