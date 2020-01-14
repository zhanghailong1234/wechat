<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentModel;
class Test2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name=request()->input('name');
    
    $where=[];
    if(!empty($name)){
        $where[]=['name',"like","%$name%"];
    }
    $data=StudentModel::where($where)->paginate(2);

    return json_encode(['code'=>200,'msg'=>"查询成功",'data'=>$data]);
}
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $data=request()->all();
    // dd($data);
    $res=StudentModel::create($data);
    return json_encode([
        'code'=>200,
        'msg'=>"添加成功",

      ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       // $id=request()->input('id');

    if(empty($id)){
        return json_encode(['code'=>201,'msg'=>"id不能为空"]);
    }
    $data=StudentModel::where(['id'=>$id])->first();

    return json_encode(['code'=>200,'msg'=>"查询成功",'data'=>$data]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=request()->all();
    
    $res=StudentModel::where(['id'=>$id])->update($data);
    
    return json_encode([
        'code'=>200,
        'msg'=>"修改成功",

      ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$id=request()->input('id');
    StudentModel::where(['id'=>$id])->delete();
    return json_encode([
        'code'=>200,
        'msg'=>"删除成功",
        ]);
    return json_encode([
        'code'=>201,
        'msg'=>"删除失败",
        ]);
    }
}
