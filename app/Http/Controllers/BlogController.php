<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Http\Requests\BlogRequest;

class BlogController extends Controller
{
    /**
     * ブログ一覧を表示する
     * 
     * @return view
     */
    public function showList(){
        $blogs = Blog::all();

        //dd($blogs);

        return view('blog.list', ['blogs' => $blogs]);
    }
    
    /**
     * ブログ詳細を表示する
     * @param int $id
     * @return view
     */
    public function showDetail($id){
        $blog = Blog::find($id);

        if(is_null($blog)){
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('blogs'));
        }

        return view('blog.detail', ['blog' => $blog]);
    }
    
    /**
     * ブログ登録画面を表示する
     * 
     * @return view
     */
    public function showCreate(){
        return view('blog.form');
    }
    
    /**
     * ブログ登録する
     * 
     * @return view
     */
    public function exeStore(BlogRequest $request){
        //ブログのデータを受け取る
        $inputs = $request->all();

        //これがあることで「コミット」をするまでDBに登録しないようにできる。
        \DB::beginTransaction();
        try{
            //ブログを登録
            Blog::create($inputs);
            \DB::commit();
        }catch(\Throwable $e){
            \DB::rollback();
            //laraverlで用意されている「500」というページを表示する。
            abort(500);
        }

        \Session::flash('err_msg', 'ブログを登録しました。');
        return redirect(route('blogs'));
    }
    
    /**
     * ブログ編集フォーム画面を表示する
     * 
     * @return view
     */
    public function showEdit($id){
        $blog = Blog::find($id);

        if(is_null($blog)){
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('blogs'));
        }

        return view('blog.edit', ['blog' => $blog]);
    }
    
    /**
     * ブログ更新する
     * 
     * @return view
     */
    public function exeUpdate(BlogRequest $request){
        //ブログのデータを受け取る
        $inputs = $request->all();

        //これがあることで「コミット」をするまでDBに登録しないようにできる。
        \DB::beginTransaction();
        try{
            //ブログを更新
            $blog = Blog::find($inputs['id']);

            $blog->fill([
                'title' => $inputs['title'],
                'content' => $inputs['content']
            ]);
            $blog->save();
            \DB::commit();
        }catch(\Throwable $e){
            \DB::rollback();
            //laraverlで用意されている「500」というページを表示する。
            abort(500);
        }

        \Session::flash('err_msg', 'ブログを更新しました。');
        return redirect(route('blogs'));
    }
    
    /**
     * ブログを削除する
     * 
     * @return view
     */
    public function exeDelete($id){

        if(empty($id)){
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('blogs'));
        }

        try{
            //ブログを削除
            Blog::destroy($id);
        }catch(\Throwable $e){
            //laraverlで用意されている「500」というページを表示する。
            abort(500);
        }

        \Session::flash('err_msg', '削除しました。');
        return redirect(route('blogs'));
    }

}
