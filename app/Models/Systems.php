<?php

namespace App\Models;

class Systems extends BaseModel
{
    protected $table = 'systems';
    protected $fillable = [];
    public $timestamps = false;

    /**
     * 根据条件获取所有数据
     * @param array|null $conditions
     * @param null $selectColumn
     * @param String $with
     * @param array $sortArray
     * @param array $in // 0=key  1=value
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function findByConditionAll(Array $conditions = null, $selectColumn = null, String $with = '', $sortArray = [], Array $in = null)
    {
        $query = $this->query();
        if($selectColumn){
            $query->select($selectColumn);
        }
        if ($with) {
            $query->with($with);
        }
        if ($conditions) {
            $query->where($conditions);
        }
        if ($in) {
            $query->whereIn($in[0], $in[1]);
        }
        if (!empty($sortArray)) {
            foreach ($sortArray as $sort) {
                $query = $query->orderBy($sort[0], $sort[1]);
            }
        } else {
            $query->orderBy('id', 'desc');
        }
        return $query->get();
    }
}
