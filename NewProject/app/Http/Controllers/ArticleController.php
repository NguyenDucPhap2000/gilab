<?php

namespace App\Http\Controllers;

use App\Models\article;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $value = $request->session()->get('id');
        if ($value) {
            $data = DB::table('articles')->where('displayed', 1)->orderBy('created_at', 'desc')->get();
            return view('Home', ['data' => $data]);
        } else {
            return view('Login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'create';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:200',
            'content' => 'required|max:10000'
        ]);
        try {
            $article = new article();
            if ($request->image != null) {
                $imgURL = $request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('public/img/', $imgURL);
                $article->image = $imgURL;
            }
            $article->UserName = $request->session()->get('username');
            $article->title = $request->title;
            $article->userID = $request->session()->get('id');
            $article->content = $request->content;

            $check = $article->save();
            if ($check) {
                return back()->with('article-success', 'Add new successful');
            } else {
                return back()->with('article-fail', 'Add new failed');
            }
        } catch (Exception $e) {
            return back()->with('article-fail', $e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $value = $request->session()->get('id');
        if ($value) {
            $data = DB::table('articles')
                ->where('userID', $value)
                ->orderBy('created_at', 'desc')
                ->paginate(6);
            return view('ManageBlog', ['data' => $data]);
        } else {
            return view('Login');
        }
        return view('ManageBlog');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $status)
    {
        return $status;
    }

    public function changeStatus($id, $status)
    {
        if ($id != null && $status != null) {
            $data = article::find($id);
            $data->displayed = $status;
            $data->update();
            return redirect()->back()->with('home-success', "Change post status successfully !");
        } else {
            return back()->with('home-fail', "Change post status failed !");
        }
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
        $data = article::find($id);
        $data->title = $request->editTitle;
        $data->content = $request->eidtContent;
        if ($request->editImage != null) {
            $imageURL = $request->file('editImage')->getClientOriginalName();
            $request->file('editImage')->storeAs('public/img/', $imageURL);
            $data->image = $imageURL;
        }
        $data->displayed = $request->selectStatus;
        $data->update();
        return redirect()->back()->with('article-success', 'Update successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id) {
            $delete = article::find($id);
            $delete->delete();
            return redirect()->back()->with('article-success', "Delete successfully !");
        } else {
            return back()->with('article-fail', "Delete failed !");
        }
    }
}
