<?php 

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Collection;
use Modules\Quotes\Entities\Template;
use Modules\Quotes\Http\Controllers\TemplatesController;
use Modules\Quotes\Repository\TemplatesRepository;

class TemplatesControllerTest extends TestCase
{
    protected $mock;
    
    public function __call($method, $args)
    {
        if (in_array($method, ['get', 'post', 'put', 'patch', 'delete']))
        {
            return $this->call($method, $args[0]);
        }

        throw new BadMethodCallException;
    }

    public function setUp()
    {
      parent::setUp();
      //$this->mock('Modules\Quotes\Repositories\TemplatesInterface');
    }

    public function mock($class)
    {
      $mock = Mockery::mock($class);	  
      $this->app->instance($class, $mock);	  
      return $mock;
    }
    
    public function testAction_Get()
    {
        $this->get('/api/v1/quotes/templates/get')
             ->seeJsonStructure([
                 '*'=>([ 'id',
                 'code',
                 'description','image','type','created_at','updated_at'])
             ]);
        
        $this->get('/api/v1/quotes/templates/get')
             ->seeJson(
                        ['id'=>1,'code'=>'abc']);
    }
    
    public function testGet()
    {
        $this->get('/api/v1/quotes/templates/get');
        //$this->assertResponseOk();
     
        //$this->mock->shouldReceive('get')->once(); 
        //$this->get('/api/v1/quotes/templates/get');
        //$this->assertViewHas('posts');
        $this->assertResponseOk();
        
        
    }
}
