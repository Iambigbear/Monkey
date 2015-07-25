<?php namespace App\Http\Controllers;

//use App\Http\Requests;
use App\Http\Controllers\Controller;

///use Illuminate\Http\Request;
use Storage;
use App\Photo;
use Redirect, Input, Auth,App;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class PhotoController extends Controller {

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
		//
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

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
    public function upload(){
        //echo  date('Y-m-d H:i:s');
         //exit();
        if(Request::input('photo_description')){
            echo Request::input('photo_description')."<br/>";

        }else{
            echo "输入描述信息出错";
            exit();
        }

        if (Request::hasFile('photo'))
        {
            $photoname=time().rand(1,1000).substr($_FILES['photo']['name'],strrpos($_FILES['photo']['name'],"."));
            $photosize=$_FILES['photo']['size'];
            $photodir="/var/www/html/gg/resources/images";
            $uptime=date('Y-m-d H:i:s');

            if(Request::file('photo')->move($photodir,$photoname)){
                $photo=new Photo();
                $photo->photo_name=$photoname;
                $photo->up_time=$uptime;
                $photo->photo_size=$photosize;
                $photo->photo_description=Input::get('photo_description');
                $photo->photo_dir=$photodir;
                if($photo->save()){
                    return Redirect::to('admin');
                    echo "上传成功,已经插入数据库";
                    //header("refresh:3;url='<?php echo '");
                    print('正在加载，请稍等...<br>三秒后自动跳转');
                }

            }else{
                echo "上传失败";
            }


        }else{
            echo "文件不存在";
            exit();
        }

    }

}