<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use Illuminate\Support\Facades\Response;


class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        $result = array();

        foreach ($tags as $tag) {



            $actionBtn = '<div class="btn-group">
                                <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
                                    Actions <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu" id="actionDrop">
                                    <li><a class="edit"
                                    data-toggle="modal"
                                    data-target="#editTagsModal"
                                    data-name="' . $tag->tag_name . '" data-id="'.$tag->id.'" href="javascript:void(0);">Edit</a></li>
                                    <li><a class="delete" data-id="'.$tag->id.'"  href="javascript:void(0);" >Delete</a></li>
                                </ul>
                            </div>';

            $createdDate = 'NA';

                if(isset($tag->created_at)){
                  $createdDate =  date('d M, Y',strtotime($tag->created_at) );
                }

            array_push($result, [
                    $tag->tag_name,
                    $createdDate,
                    $actionBtn
                ]);
        }

        return response()->json(['tags'=>$result]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return response()->json(['errorMsg'=>'','allowed'=>'true']);

        //return view('tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'tag_name'=>'required|max:191|unique:tags,tag_name',
        ]);
        $tag = new Tag;
        $tag->tag_name = $request->get('tag_name');
        $tag->save();

        return response()->json(['success'=>'true','tag'=>$tag]);

        //return redirect()->route('tag.index')->with('success','Tag added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::find($id);
        if(!isset($tag)){
        return response()->json(['found'=>'false','tag'=>$tag]);

        }else{
        return response()->json(['found'=>'true','tag'=>$tag]);

        }
        //return view('tag.show', compact('tag'));
    }

    public function tagList()
    {
        # code...
        $tags = Tag::orderBy('tag_name', 'asc')->get();
       return response()->json(['tags'=>$tags]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
       return response()->json(['errorMsg'=>'','allowed'=>'true']);

        //return view('tag.edit', compact('tag'));
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
           $this->validate($request, [
            'tag_name'=>'required|max:191|unique:tags,tag_name,' . $id,
        ]);

        $tag = Tag::find($id);
         if(!isset($tag)){
        return response()->json(['saved'=>'false','tag'=>$tag]);

        }else{
            $tag->tag_name = $request->tag_name;
        $tag->update();
        return response()->json(['saved'=>'true','tag'=>$tag]);

        }
        
       /* return redirect()->route('tag.index')
            ->with('success',
             'tag'. $tag->name.' updated!');*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        if(!isset($tag)){
         return response()->json(['deleted'=>'false']);

        }else{
            $tag->delete();
            return response()->json(['deleted'=>'true']);
        }
    }
}
