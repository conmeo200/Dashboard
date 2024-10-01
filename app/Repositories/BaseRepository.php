<?php
namespace App\Repositories;

use App\Exceptions\GeneralException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements RepositoryInterface {

    /**
     * The repository model.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * The query builder.
     *
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $query;

    /**
     * Alias for the query limit.
     *
     * @var int
     */
    protected $take;

    /**
     * Array of related models to eager load.
     *
     * @var array
     */
    protected $with = [];

    /**
     * Array of one or more where clause parameters.
     *
     * @var array
     */
    protected $wheres = [];

    /**
     * Array of one or more where clause parameters.
     *
     * @var array
     */
    protected $orWheres = [];

    /**
     * Array of one or more where in clause parameters.
     *
     * @var array
     */
    protected $whereIns = [];

    /**
     * Array of one or more ORDER BY column/value pairs.
     *
     * @var array
     */
    protected $orderBys = [];

    /**
     * Array of one or more GROUP BY column/value pairs.
     *
     * @var array
     */
    protected $groupBys = [];

    /**
     * Array of scope methods to call on the model.
     *
     * @var array
     */
    protected $scopes = [];

    /**
     * EloquentRepository constructor.
     */
    public function __construct() {
        $this->setModel();
    }

    /**
     * get model
     * @return string
     */
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel() {

        $model = resolve($this->getModel());

        return $this->model = $model;
    }

    /**
     * Get All
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all() {

        return $this->model->all();
    }

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id) {

        $result = $this->model->find($id);

        return $result;
    }

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes) {

        return $this->model->create($attributes);
    }

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return bool|mixed
     */
    public function update($id, array $attributes) {

        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    /**
     * Delete
     *
     * @param $id
     * @return bool
     */
    public function delete($id) {

        $result = $this->find($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }

    /**
     * Specify Model class name.
     *
     * @return mixed
     */

    /**
     * @throws \Exception
     * @return Model|mixed
     */
    public function makeModel() {
        $model = resolve($this->model());

        if (!$model instanceof Model) {
            throw new \Exception("Class {$this->model()} must be an instance of " . Model::class);
        }

        return $this->model = $model;
    }

    /**
     * Count the number of specified model records in the database.
     *
     * @return int
     */
    public function count(): int {
        return $this->model->count();
    }

    /**
     * Create one or more new model records in the database.
     *
     * @param array $data
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function createMultiple(array $data) {
        $models = new Collection();

        foreach ($data as $d) {
            $models->push($this->create($d));
        }

        return $models;
    }

    /**
     * Delete the specified model record from the database.
     *
     * @param $id
     *
     * @throws \Exception
     * @return bool|null
     */
    public function deleteById($id): bool {
        $this->unsetClauses();

        return $this->getById($id)->delete();
    }

    /**
     * Delete multiple records.
     *
     * @param array $ids
     *
     * @return int
     */
    public function deleteMultipleById(array $ids): int {
        return $this->model->destroy($ids);
    }

    /**
     * Get the first specified model record from the database.
     *
     * @param array $columns
     *
     * @return Model|static
     */
    public function first(array $columns = ['*']) {
        $this->newQuery()->eagerLoad()->setClauses()->setScopes();
dd($columns);
        $model = $this->query->firstOrFail($columns);

        $this->unsetClauses();

        return $model;
    }

    /**
     * Get all the specified model records in the database.
     *
     * @param array $columns
     *
     * @return Collection|static[]
     */
    public function get(array $columns = ['*']) {
        $this->newQuery()->eagerLoad()->setClauses()->setScopes();

        $models = $this->query->get($columns);

        $this->unsetClauses();

        return $models;
    }

    /**
     * Get the specified model record from the database.
     *
     * @param       $id
     * @param array $columns
     *
     * @return Collection|Model
     */
    public function getById($id, array $columns = ['*']) {
        $this->unsetClauses();

        $this->newQuery()->eagerLoad();

        return $this->query->findOrFail($id, $columns);
    }

    /**
     * @param       $item
     * @param       $column
     * @param array $columns
     *
     * @return Model|null|static
     */
    public function getByColumn($item, $column, array $columns = ['*']) {
        $this->unsetClauses();

        $this->newQuery()->eagerLoad();

        return $this->query->where($column, $item)->first($columns);
    }

    /**
     * @param int    $limit
     * @param array  $columns
     * @param string $pageName
     * @param null   $page
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($limit = 25, array $columns = ['*'], $pageName = 'page', $page = null) {
        $this->newQuery()->eagerLoad()->setClauses()->setScopes();

        $models = $this->query->paginate($limit, $columns, $pageName, $page);

        $this->unsetClauses();

        return $models;
    }

    /**
     * Update the specified model record in the database.
     *
     * @param       $id
     * @param array $data
     * @param array $options
     *
     * @return Collection|Model
     */
    public function updateById($id, array $data, array $options = []) {
        $this->unsetClauses();

        $model = $this->getById($id);

        $model->update($data, $options);

        return $model;
    }

    /**
     * Set the query limit.
     *
     * @param int $limit
     *
     * @return $this
     */
    public function limit($limit) {
        $this->take = $limit;

        return $this;
    }

    /**
     * Set an ORDER BY clause.
     *
     * @param string $column
     * @param string $direction
     * @return $this
     */
    public function orderBy($column, $direction = 'asc') {
        $this->orderBys[] = compact('column', 'direction');

        return $this;
    }

    /**
     * Add a simple where clause to the query.
     *
     * @param string $column
     * @param string $value
     * @param string $operator
     *
     * @return $this
     */
    public function where($column, $value, $operator = '=') {
        $this->wheres[] = compact('column', 'value', 'operator');
        return $this;
    }

    public function orWhere($column, $value, $operator = '=') {
        $this->orWheres[] = compact('column', 'value', 'operator');
        return $this;
    }

    /**
     * Add a simple where in clause to the query.
     *
     * @param string $column
     * @param mixed  $values
     *
     * @return $this
     */
    public function whereIn($column, $values) {
        $values = is_array($values) ? $values : [$values];

        $this->whereIns[] = compact('column', 'values');

        return $this;
    }

    /**
     * Set Eloquent relationships to eager load.
     *
     * @param $relations
     *
     * @return $this
     */
    public function with($relations) {
        if (is_string($relations)) {
            $relations = func_get_args();
        }

        $this->with = $relations;

        return $this;
    }

    /**
     * Create a new instance of the model's query builder.
     *
     * @return $this
     */
    protected function newQuery() {
        $this->query = $this->model->newQuery();

        return $this;
    }

    /**
     * Add relationships to the query builder to eager load.
     *
     * @return $this
     */
    protected function eagerLoad() {
        foreach ($this->with as $relation) {
            $this->query->with($relation);
        }

        return $this;
    }

    /**
     * Set clauses on the query builder.
     *
     * @return $this
     */
    protected function setClauses() {
        foreach ($this->wheres as $where) {
            $this->query->where($where['column'], $where['operator'], $where['value']);
        }

        foreach ($this->orWheres as $where) {
            $this->query->orWhere($where['column'], $where['operator'], $where['value']);
        }

        foreach ($this->whereIns as $whereIn) {
            $this->query->whereIn($whereIn['column'], $whereIn['values']);
        }

        foreach ($this->orderBys as $orders) {
            $this->query->orderBy($orders['column'], $orders['direction']);
        }

        foreach ($this->groupBys as $group) {
            $this->query->groupBy($group);
        }

        if (isset($this->take) and !is_null($this->take)) {
            $this->query->take($this->take);
        }

        return $this;
    }

    /**
     * Set query scopes.
     *
     * @return $this
     */
    protected function setScopes() {
        foreach ($this->scopes as $method => $args) {
            $this->query->$method(...$args);
        }

        return $this;
    }

    /**
     * Reset the query clause parameter arrays.
     *
     * @return $this
     */
    protected function unsetClauses() {
        $this->wheres = [];
        $this->whereIns = [];
        $this->scopes = [];
        $this->take = null;

        return $this;
    }

    /**
     * Add the given query scope.
     *
     * @param string $scope
     * @param array $args
     *
     * @return $this
     */
    public function __call($scope, $args) {
        $this->scopes[$scope] = $args;

        return $this;
    }

    /**
     * Set an GROUP BY clause.
     *
     * @param array $columns
     * @return $this
     */
    public function groupBy(array $columns = ['*']) {
        $this->groupBys[] = $columns;

        return $this;
    }

}

