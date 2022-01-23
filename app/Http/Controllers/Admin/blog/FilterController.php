<?php

namespace App\Http\Controllers\Admin\blog;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if ($request->load == 'tags') {
                $tags = Tag::orderBy('created_at', 'DESC');
                if ($request->has('search')) {
                    $tags->where('title', 'like', "%{$request->search}%");
                }
                return view(
                    'admin.blog.filter.__tagList',
                    ['tags' => $tags->paginate(7)]
                )->render();
            }
            if ($request->load == 'category') {
                $categories = Category::with('node')->orderBy('sort');
                if ($request->has('search') && trim($request->search)) {
                    $categories->search($request->search);
                } else if ($request->has('key')) {
                    $child = Category::where('id', $request->key)->first();
                    $categories->where('parent_id', $child->parent_id);
                } else if ($request->has('parent')) {
                    $categories->where('parent_id', $request->parent);
                } else {
                    $categories->onlyParent();
                }
                $data['categories'] = $categories->paginate(7);
                return view('admin.blog.filter.__categoryList', $data);
            }
            return false;
        }

        return view('admin.blog.filter.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function nyoba(Request $request)
    {
        $isi = $request->all();
        return response()->json($isi);
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $isi = $request->all();
        return response()->json($isi);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
