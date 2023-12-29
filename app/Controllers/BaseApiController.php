<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

/**
 * Class BaseApiController
 *
 * BaseApiController provides a convenient place for loading components
 * and performing functions that are needed by all your Api controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseApiController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseApiController extends ResourceController
{
    protected $modelName ;
    protected $format ;

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($segment = null)
    {
        if ($segment === null) {
            return $this->index();
        }

        return $this->respond($this->model->find($segment));
    }

    public function new() {
        if (! $insertId = $this->model->getInsertId()) {
            return null;
        }
        return $this->respond($this->show($insertId));
    }

    public function create() {
    }
    
    public function edit($id = null)
    {
        
    }      
    
    public function update($id = null)
    {
        
    }

    public function delete($id = null)
    {
        
    }    
}
