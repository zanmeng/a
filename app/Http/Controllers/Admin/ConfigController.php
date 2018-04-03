<?php

namespace App\Http\Controllers\Admin;

use App\Model\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ConfigController extends Controller
{
    /**
     * 取出网站配置表中的配置项，写入config /webconfig.php文件
     */
    public function putFile()
    {
//        1. 从config表中取出conf_name conf_content两列的值

        $config = Config::pluck('conf_content','conf_name')->all();



//        2.创建webconfig.php文件，并将从数据库中获取的网站配置项的值写入文件

        $str = "<?php return ".var_export($config,true).';';

        file_put_contents(config_path().'/webconfig.php',$str);

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        从数据库中查询网站标题
//        $web_title = DB::where('conf_name','web_title')->get();

        //
        $conf = Config::get();
//        dd($conf);

        foreach($conf as $v){

            switch ($v->field_type){
                //如果当前记录的类型是文本框
//      aaaa   =====>    <input type="text" name="title"  class="layui-input" value="aaaa">
                case 'input':
                    $v->conf_content = '<input type="text" name="conf_content[]"  class="layui-input" value="'.$v->conf_content.'">';
                    break;
                //如果当前记录的类型是文本域
//       bbbb   =====>     <textarea name=""  class="layui-textarea">bbbbb</textarea>
                case 'textarea':
                    $v->conf_content ='<textarea name="conf_content[]"  class="layui-textarea">'.$v->conf_content.'</textarea>';
                    break;

                //如果当前记录的类型是单选按钮
                case 'radio':
//      1|开启,0|关闭====>
//      <input type="radio" name="aaa" value="1" title="开启" checked="">
//      <input type="radio" name="aaa" value="0" title="关闭">
                    $str = '';

                    $arr = explode(',',$v->field_value);
//                  $arr = [
//                      0=>'1|开启',
//                      1=>'0|关闭',
//                  ];

                    foreach ($arr as $n){

                        $a = explode('|',$n);//[0=>1,1=>开启]

                        $checked =    ($a[0] == $v->conf_content)?'checked':'';
//                                dd($checked);
                        $str.= '<input type="radio" name="conf_content[]" value="'.$a[0].'" title="'.$a[1].'" '.$checked.'>'.$a[1];
                    }

                    $v->conf_content = $str;


                    break;


                case 'img':
                    $v->conf_content = "<input type='hidden' name='conf_content[]' value='".$v->conf_content."'><img src='". $v->conf_content."' />";

            }
        }

        return view('admin.config.list',compact('conf'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('admin.config.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except('_token');
//        dd($input);
        $res = Config::create($input);

        if($res){
            $arr = [
                'status'=>1,
                'msg'=>'添加成功'
            ];
        }else{
            $arr = [
                'status'=>0,
                'msg'=>'添加失败'
            ];
        }

        return $arr;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($conf_id)
    {
       $config =Config::find($conf_id);

       return view('admin.config.edit',compact('config'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $conf_id)
    {

//        return 111111;

        $input = $request->all();
//        return $input;

        $conf = Config::find($conf_id);



        $res = $conf->update([
            'conf_title'=>$input['conf_title'],
            'conf_name'=>$input['conf_name'],
            'conf_content'=> $input['conf_content'],
            'conf_order'=>$input['conf_order'],
            'field_type'=>$input['field_type'][0]
        ]);

        if($res){
            $data = [
                'status'=>1,
                'msg'=>'修改成功'
            ];
        }else{
            $data = [
                'status'=>0,
                'msg'=>'修改失败'
            ];
        }


        return $data;


    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($conf_id)
    {
//        dd($conf_id);

        $conf = Config::find($conf_id);

        $res = $conf->delete();

        if($res){
            $data = [
                'status'=>1,
                'msg'=>'删除成功'
            ];
        }else{
            $data = [
                'status'=>0,
                'msg'=>'删除失败'
            ];
        }

        return $data;
    }
    //批量修改
    public function changeContent(Request $request)
    {
        $input = $request->except('_token');
//        dd($input);
//        开启事务
        DB::beginTransaction();

        try{
            foreach($input['conf_id'] as $k=>$v){
                //$v就是要更新的网站配置项的id
//    dd($input['conf_content']);
                Config::find($v)->update(['conf_content'=>$input['conf_content'][$k]]);
            }
            DB::commit();
            return redirect('admin/config');

        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()
                ->withErrors(['error' => $e->getMessage()]);
        }



        return redirect('admin/config');
    }
}
