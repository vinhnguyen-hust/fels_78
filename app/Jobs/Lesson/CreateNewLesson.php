<?php

namespace FELS\Jobs\Lesson;

use FELS\Jobs\Job;
use FELS\Entities\Lesson;
use Illuminate\Contracts\Bus\SelfHandling;
use FELS\Core\Repository\Contracts\CategoryRepository;

class CreateNewLesson extends Job implements SelfHandling
{
    protected $user;
    protected $category;

    public function __construct($user, $categoryId)
    {
        $this->user = $user;
        $this->category = app(CategoryRepository::class)->findById($categoryId);
    }

    /**
     * Create a new lesson.
     *
     * @return bool
     */
    public function handle()
    {
        return $this->hasEnoughWords() ? $this->buildLessonRelations() : false;
    }

    /**
     * Fill in possible attributes for the lesson.
     *
     * @return Lesson
     */
    protected function buildLesson()
    {
        return (new Lesson)->fill([
            'name' => uniqid("Lesson_{$this->category->name}_"),
            'finished' => false,
        ]);
    }

    /**
     * Build lesson relationships.
     *
     * @return array
     */
    protected function buildLessonRelations()
    {
        $lesson = $this->buildLesson();
        $this->associateMany($lesson, ['user', 'category']);
        $lesson->words()->attach($this->randomizeWords());
        $this->user->pushActivity('started', $lesson);

        return [$this->category, $lesson];
    }

    /**
     * Check the number of unlearned words in category.
     *
     * @return bool
     */
    protected function hasEnoughWords()
    {
        return $this->category->unlearnedWordsOf(auth()->user())
            ->count() >= config('lesson.min_words');
    }

    /**
     * Select random words from a category.
     *
     * @return array
     */
    protected function randomizeWords()
    {
        return $this->category->unlearnedWordsOf(auth()->user())
            ->lists('id')->shuffle()->take(config('lesson.max_words'))->toArray();
    }

    /**
     * A helper method to associate a lesson with its parents.
     *
     * @param $lesson
     * @param array $parents
     * @return bool
     */
    protected function associateMany($lesson, array $parents)
    {
        foreach ($parents as $parent) {
            $lesson->$parent()->associate($this->$parent);
        }

        return $lesson->save();
    }
}
