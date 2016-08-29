<?php namespace Modules\Blog\Repository;
use App\Repository\BaseRepository;

class BlogRepository extends BaseRepository {
    protected $modelName='Modules\Blog\Entities\Blog';
    
    public function hello()
    {
    	return "hello";
    }
}