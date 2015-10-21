<?php

namespace FELS\Entities\Observers;

use FELS\Entities\Category;

class CategoryObserver
{
    /**
     * Hook into category deleting event.
     *
     * @param Category $category
     */
    public function deleting(Category $category)
    {
        $category->words->each(function ($word) {
            $word->answers()->delete();
            $word->delete();
        });
    }
}