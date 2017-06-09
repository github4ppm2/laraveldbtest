<?php
namespace App\Http\Controllers;

use App\MyEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
class EventsController extends Controller
{

    public function manageEvents()
    {
        return view('admin.manage-events');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = MyEvent::latest()->paginate(5);
        return response()->json($items);
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
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->photo->getClientOriginalExtension();
        $request->photo->move(public_path('images'), $imageName);
        $request->photo = $imageName;
        $create = MyEvent::create(array(
            'title'=> $request->title,
            'description'=> $request->description,
            'photo'=> $request->photo
            ));
        return response()->json($create);
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
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->photo->getClientOriginalExtension();
        $request->photo->move(public_path('images'), $imageName);
        $request->photo = $imageName;


        $edit = MyEvent::find($id)->update(array(
            'title'=> $request->title,
            'description'=> $request->description,
            'photo'=> $request->photo
        ));

        return response()->json($edit);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MyEvent::find($id)->delete();
        return response()->json(['done']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function latestevents()
    {
        $events = MyEvent::all()->toArray();
        return view('rm.index', compact('events'));


    }
}
