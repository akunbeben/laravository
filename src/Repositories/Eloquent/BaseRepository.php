<?php

namespace Akunbeben\Laravository\Repositories\Eloquent;

use Akunbeben\Laravository\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
  protected $model;

  /**
   * Set Model to use the Eloquent
   * 
   * @param Model $model
   */
  public function __construct(Model $model)
  {
    $this->model = $model;
  }

  /**
   * Retrieve all data of the Collection
   * 
   * @return Illuminate\Database\Eloquent\Collection
   */
  public function getAll()
  {
    return $this->model->all();
  }

  /**
   * Retrieve specific data by $id
   * 
   * @param integer $id
   * @param array $relations
   * 
   * @return Illuminate\Database\Eloquent\Collection
   */
  public function getById($id, $relations = null)
  {
    if ($relations != null) $this->model = $this->model->with($relations);
    
    $this->model = $this->model->find($id);

    return $this->model;
  }

  /**
   * Create new record through mass assignment
   * 
   * @param Illuminate\Http\Request $attributes
   * 
   * @return Illuminate\Database\Eloquent\Collection
   */
  public function create($attributes)
  {
    return $this->model->create($attributes);
  }

  /**
   * Get specific record and update through mass assignment
   * 
   * @param integer $id
   * @param Illuminate\Http\Request $attributes
   * 
   * @return Illuminate\Database\Eloquent\Collection
   */
  public function update($id, $attributes)
  {
    return $this->getById($id)->update($attributes);
  }

  /**
   * Delete specific record by $id
   * 
   * @param integer $id
   * 
   * @return void
   */
  public function delete($id)
  {
    $this->getById($id)->delete();
  }
}