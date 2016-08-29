<?php namespace App\Repository;
interface IBaseInterface {
	public function lists($column, $key = null);
	
    public function all($columns = array('*'));
    
    public function first($columns = array('*'))
    
    public function paginate($limit = null, $columns = array('*'), $method = "paginate");
     
    public function simplePaginate($limit = null, $columns = array('*'));
    
    public function find($id, $columns = array('*'));
    
    public function findByField($field, $value = null, $columns = array('*'));
    
    public function findWhere( array $where , $columns = array('*'));
    
    public function findWhereIn( $field, array $values, $columns = array('*'));
    
    public function findWhereNotIn( $field, array $values, $columns = array('*'));
    
    public function create(array $attributes);
    
    public function update(array $attributes, $id);
    
    public function delete($id);
    
    public function has($relation);
    
    public function with($relations);
    
    public function hidden(array $fields);
    
    public function visible(array $fields);
      

    /* public function paginate($perPage = 15, $columns = array('*'));

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id); */

    public function find($id, $columns = array('*'));

    //public function findBy($field, $value, $columns = array('*'));
}