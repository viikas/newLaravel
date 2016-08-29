<?php namespace Modules\Blog\Repository;
use App\Repository\BaseRepository;

class BlogRepository extends BaseRepository {

    protected $modelName='Blog';

    public function __construct(Actor $actor) {

        $this->actor = $actor;
    }

    public function index() {
        return \Response::json($this->actor->all());
    }
}