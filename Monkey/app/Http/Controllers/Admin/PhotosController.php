<?php namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Exceptions;
use App\Photo;
use Illuminate\Http\Response;
use Redirect, Input, Auth,App;
use Illuminate\Support\Facades\Validator;
use League\Flysystem;
use Storage;
use File;
use DB;
use Illuminate\Database\Query;
use App\Exceptions\User\Upload as UploadError;
use App\Exceptions\User\Unknown as Unknownerror;

class PhotosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        return view('upphoto');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}
    public function destroy($id)
    {
        //
        $photo =Photo::find($id);
        $photo->delete();
    }


    public function upload(Request $req){
        $file = array('image' => $req->file('photo'));
        $rules = array(
            'image' => 'required|image|max:80'
        );
        $validator = Validator::make($file,$rules);
        if($validator->fails()){
            throw new UploadError();
        }
        $file = $file['image'];
        $extension = $file->getClientOriginalExtension();
        Storage::disk('local')->put($file->getFilename().".".$extension,File::get($file));
        $filesize = Storage::size($file->getFilename().".".$extension);
        $photo = new Photo();
        $photo->photo_name = $file->getFilename();
        $photo->photo_dir = $file->getFilename().".".$extension;
        $photo->photo_description = htmlspecialchars($req ->input('photo_description'));
        $photo->photo_size = $filesize ;
        $photo->up_time =date('Y-m-d H:i:s',time());
        //echo $req->input('photo_description');
        //exit();
         if($photo->save()){
             return response()->json(array(
                 'photo_id'=>$photo->id,
                 'state'=>'UPLOAD_SUCCESS',
             ),Response::HTTP_CREATED);
         }else{
             throw new UploadError();
         }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function remove(Request $req,$id)
    {
        $file_dir = Photo::find($id)->photo_dir;
        if(Storage::delete($file_dir)){
        if(Photo::destroy($id)){
                return response()->json(array(
                    'id'=>'$id',
                    'state'=>'DELETE_SUCCESS',
                ),Response::HTTP_CREATED);
            }
        throw new Unknownerror;
        }
        throw new Unknownerror;
    }
    public function download(Request $req,$id){
        $file = Photo::find($id);
        if(is_null($file)){
            return Response()->json(array(),Response::HTTP_NOT_FOUND);
        }
        $file_dir = $file->photo_dir;
        if(is_null($file_dir)){
            return Response()->json(array(),Response::HTTP_NOT_FOUND);
        }
        $file = Storage::disk('local')->get($file_dir);
        return response($file,Response::HTTP_OK)->header('Content-Type','image/png');
    }



}
