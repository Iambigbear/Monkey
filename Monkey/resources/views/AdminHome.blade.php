@extends('app')
<script type="text/javascript">
    <!--

    function confdel(val){
        return  window.confirm("是否要删除id="+val+"的用户");

    }

    -->
</script>
<table border='1px'  cellspacing='0px' cellpadding='0px' width='100%'>
       <tr><th>id</th><th>图片名称</th><th>上传时间</th><th>图片大小</th><th>图片描述</th><th>存储路径</th><th>删除图片</th><th>下载图片</th></tr>
        @section('content')
              @foreach ($photos as $photo)
               <tr><td>{{$photo->id}}</td>
                   <td>{{$photo->photo_name}}</td>
                   <td>{{$photo->up_time}}</td>
                   <td>{{$photo->photo_size}}</td>
                   <td>{{$photo->photo_description}}</td>
                   <td>{{$photo->photo_dir}}</td>
                   <td><form action="{{ URL('admin/remove/'.$photo->id) }}" method="POST" style="display: inline;">
                           <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <input name="_method" type="hidden" value = "DELETE" >
                           <input type="submit" value="删除" onclick='return confdel({{$photo->id}})'>

                       </form></td>
                   <td><form action="{{ URL('admin/download/'.$photo->id) }}" method="POST" style="display: inline;">
                           <input name="_method" type="hidden" value="GET">
                           <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <input type="submit" value="下载">
                       </form></td>
               @endforeach
                </tr>
        <h3><center>图片管理系统</center></h3>
        </table>
         <?php use Illuminate\Pagination;
         use App\Photo;
         echo $photos->render(); ?>

        @endsection