<form action="{{URL('admin/upload')}}" method="POST" enctype="multipart/form-data">
    请选择文件：         <input type="file" name="photo"><br>
    请输入文件的描述信息：<input type="text" name="photo_description"><br>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="submit" value="上传" >
</form>