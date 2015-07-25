<?php
namespace App\Exceptions\User;
use Illuminate\Http\Response;

/**
 * Created by PhpStorm.
 * User: zhuang
 * Date: 15-7-22
 * Time: 下午10:03
 */
   class Upload extends \Exception {
   public function __construct($error = "文件格式错误",$code = Response::HTTP_UNSUPPORTED_MEDIA_TYPE,Extension $previous = null){
       $this->$error = $error;
       $this->$code = $code;
   }
 }

