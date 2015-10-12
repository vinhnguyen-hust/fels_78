<?php

namespace FELS\Core\Repository;

use FELS\Entities\Category;
use FELS\Core\Repository\Traits\ShouldBeFoundTrait;
use FELS\Core\Repository\Contracts\CategoryRepository;
use FELS\Core\Repository\Contracts\Activity\CanBeCreated;
use FELS\Core\Repository\Contracts\Activity\CanBeUpdated;
use FELS\Core\Repository\Contracts\Activity\ShouldBeFound;
use FELS\Core\Repository\Contracts\Activity\ShouldBePaginated;

class EloquentCategoryRepository implements
    CanBeCreated,
    CanBeUpdated,
    ShouldBeFound,
    ShouldBePaginated,
    CategoryRepository
{
    use ShouldBeFoundTrait;

    protected $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    /**
     * Create a new model instance.
     *
     * @param array $data
     * @return static
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update a model instance.
     *
     * @param array $data
     * @param $identifier
     * @param null $optionalIdentifier
     * @return bool|int
     */
    public function update(array $data, $identifier, $optionalIdentifier = null)
    {
        $category = $this->findBySlug($identifier);

        return $category->update($data);
    }

    /**
     * Delete a category.
     *
     * @param $slug
     * @return bool|null
     */
    public function delete($slug)
    {
        $category = $this->findBySlug($slug);
        $category->delete();
    }

    /**
     * Paginate a collection of models.
     *
     * @param $limit
     * @param array|null $params
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($limit, array $params = null)
    {
        return $this->model->latest()->paginate($limit);
    }
}