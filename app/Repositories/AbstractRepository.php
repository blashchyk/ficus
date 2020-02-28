<?php


namespace App\Repositories;


use App\Repositories\Contract\RepositoryInerface;
use Illuminate\Database\Eloquent\Model;
use wizz\MongoConfig\Contracts\MongoConfigCacheDecoratorInterface;

abstract class AbstractRepository implements RepositoryInerface
{
    public function __construct(Model $instance = null)
    {
        if (!$instance) {
            return $this->make();
        }
        $this->model = $instance;
    }

    /**
     *
     */
    protected function make(){
        if ($this->class) {
            $this->model = new $this->class;

            return;
        }

        $class = get_class();
        $class = str_replace('Repository', '', $class);
        $this->model = new $class;

        return;
    }

    /**
     * @var
     */
    protected $model;

    /**
     * @var
     */
    protected $class;

    /**
     * @var array
     */
    protected $response = [
        'status' => 200,
        'errors' => [],
        'alerts' => [],
        'data' => [],
    ];

    /**
     * @param array $input
     * @param null $id
     * @return bool
     */
    public function validate(array $input, $id = null)
    {
        return true;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->model->get();
    }

    /**
     * @return mixed
     */
    public function first()
    {
        return $this->model->first();
    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = ['*'])
    {
        return $this->model->get($columns);
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 1, $columns = ['*'])
    {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        if (!$this->validate($data)) {
            return $this->response();
        }

        return $this->model->create($data);
    }

    /**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return mixed
     */
    public function update(array $data, $id, $attribute = null)
    {
        if ($attribute === null) {
            $attribute = $this->model->getKeyName();
        }

        if (!$this->validate($data, $id)) {
            return $this->response();
        }

        $q = $this->model->where($attribute, $id);
        $q->update($data);

        return $q->first();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function findOrFail($id, array $columns = ['*'])
    {
        return $this->model->findOrFail($id, $columns);
    }

    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($attribute, $value, $columns = ['*'])
    {
        return $this->model->where($attribute, $value)->first($columns);
    }

    /**
     * @param $relations
     * @return \App\Repositories\Eloquent\AbstractRepository
     */
    public function with($relations)
    {
        if (is_string($relations)) {
            $relations = func_get_args();
        }

        $this->with = $relations;

        return $this;
    }

    /**
     * @return mixed
     */
    public function model()
    {
        return $this->model;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function firstOrCreate(array $data)
    {
        return $this->model->firstOrCreate($data);
    }

    /**
     * @param array $conditions
     * @param array $with
     * @param array $columns
     *
     * @return mixed
     */
    public function findOneBy(array $conditions, array $with = [], array $columns = ['*'])
    {
        $builder = $this->model->where($conditions);
        if (count($with)) {
            $builder->with($with);
        }

        return $builder->first($columns);
    }

    public function withTrashed()
    {
        return $this->model()->withTrashed();
    }

}

