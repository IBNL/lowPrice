<?php
declare(strict_types = 1);

namespace App\Repositories\Eloquent;

class AbstractRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->getModel();
    }

    /**
     * get current model
     * @return $model
     */
    protected function getModel()
    {
        return app($this->model);
    }
    
    /**
     * get data by column
     * @param $columnName
     * @param $columnData
     * @return object
     */
    public function getByColumn(string $columnName, string $columnData): object
    {
        $data = $this->model->where($columnName, $columnData)->first();
        return $data;
    }

}