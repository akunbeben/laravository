<?php

namespace Akunbeben\Laravository\Repositories\Interfaces;

interface BaseRepositoryInterface
{
  /**
   * Retrieve all data of the Collection
   * 
   * @return Illuminate\Database\Eloquent\Collection
   */
  public function getAll();

  /**
   * Retrieve specific data by $id
   * 
   * @param integer $id
   * @param array $relations
   * 
   * @return Illuminate\Database\Eloquent\Collection
   */
  public function getById($id, $relations = null);

  /**
   * Create new record through mass assignment
   * 
   * @param Illuminate\Http\Request $attributes
   * 
   * @return Illuminate\Database\Eloquent\Collection
   */
  public function create($attributes);

  /**
   * Get specific record and update through mass assignment
   * 
   * @param integer $id
   * @param Illuminate\Http\Request $attributes
   * 
   * @return Illuminate\Database\Eloquent\Collection
   */
  public function update($id, $attributes);

  /**
   * Delete specific record by $id
   * 
   * @param integer $id
   * 
   * @return void
   */
  public function delete($id);

}