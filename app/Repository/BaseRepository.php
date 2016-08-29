<?php namespace App\Repository;

class BaseRepository implements IBaseInterface
{
	protected $modelName;
	public function all($columns = array('*'))
	{
		$instance=$this->getNewInstance();
		return $instance->all($columns);
	}
	
	/* public function paginate($perPage = 15, $columns = array('*'))
	{
		
	}

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);
	
	public function find($id, $columns = array('*'))
	{
		$instance=$this->getNewInstance();
		return $instance->find($id);
	} */
	
	public function find($id, $columns = array('*'))
	{
		$instance=$this->getNewInstance();
		return $instance->find($id);
	}
	
	protected function getNewInstance()
	{
		$model=$this->modelName;
		return new $model;
	}
}