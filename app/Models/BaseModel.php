<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /***********  新增数据  *************/

    /**
     * 新增数据
     * 前置条件，model定义 $fillable 属性
     * @param array $data
     * @return bool
     */
    public function addData(Array $data)
    {
        $this->fill($data);
        if ($res = $this->save()) {
            return $res;
        }
        return false;
    }

    /***********  删除数据  *************/

    public function deleteData()
    {

    }

    /***********  修改数据  *************/

    /**
     * 根据id修改数据
     * @param $data //修改后数据
     * @param $id //被修改数据id
     * @return bool
     */
    public function updateData($data, $id)
    {
        $info = $this->findByConditionOne([['id', $id]]);
        $info->fill($data);
        if ($rest = $info->save()) {
            return $rest;
        }
        return false;
    }

    /**********    查询数据     **********/

    public function findCondition($condition = null, $with = null)
    {
        $query = $this->query();
        if ($with) {
            $query->with($with);
        }
        if ($condition) {
            $query->where($condition);
        }
        return $query->get();
    }

    /**
     * 根据条件获取一条数据
     * @param array|null $conditions //格式如[['id'=>'c8dbce6a-c47a-31d0-a952-a63fb7422d68']]
     * @param  $with //根据Model定义的ORM关系
     * @param array $sortArray //排序规则  [['id','desc']]
     * @param array|null $selectColumn 查询字段，默认所有
     * @return \Illuminate\Database\Eloquent\Builder|Model|null|object
     */
    public function findByConditionOne(Array $conditions = null, $with = '', $sortArray = [], $selectColumn = null)
    {
        $query = $this->query();
        if ($selectColumn) {
            $query->select($selectColumn);
        }
        if ($with) {
            $query->with($with);
        }
        if ($conditions) {
            $query->where($conditions);
        }
        if (!empty($sortArray)) {
            foreach ($sortArray as $sort) {
                $query = $query->orderBy($sort[0], $sort[1]);
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }
        return $query->first();
    }

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
            $query->orderBy('created_at', 'desc');
        }
        return $query->get();
    }

    /**
     * 根据条件获取分页数据
     * @param array|null $condition //格式如[['id'=>'c8dbce6a-c47a-31d0-a952-a63fb7422d68']]
     * @param String $with //根据Model定义的ORM关系 多个关联用','分割
     * @param array $sortArray //排序规则  [['id','desc']]
     * @param int $start 分页
     * @param int $limit 分页
     * @param null $keyword 模糊搜索
     * @param null $selectColumn
     * @return array
     */
    public function findByConditionPage(
        $condition = null,
        $with = null,
        $sortArray = [],
        $start = null,
        $limit = null,
        $keyword = null,
        $selectColumn = null
    )
    {
        $limit = $limit ?? 10;
        $start = getOffset($start ?? 1, $limit);
        $query = $this->query();
        if ($selectColumn) {
            $query->select($selectColumn);
        }
        if ($with) {
            $withs = explode(',', $with);
            foreach ($withs as $one) {
                $query->with($one);
            }
        }
        if (!is_null($keyword)) {
            $query->where(function ($query) use ($keyword) {
                $query->where('id', '=', $keyword)->orWhere('name', 'like', '%' . $keyword . '%');
            });
        }
        if ($condition) {
            $query->where($condition);
        }
        $query->limit($limit)->skip($start);
        if (!empty($sortArray)) {
            foreach ($sortArray as $sort) {
                $query->orderBy($sort[0], $sort[1]);
            }
        }

        return [
            'total'=>$this->query()->count(),
            'lists'=>$query->get()
        ];
    }

}
