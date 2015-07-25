<?php
/**
 * Created by PhpStorm.
 * User: zhuang
 * Date: 15-7-23
 * Time: 上午11:31
 */
namespace App\Exceptions\User;
use Illuminate\Http\Response;
class Unknown extends \Exception{
    public function __construct($message = Response::HTTP_INTERNAL_SERVER_ERROR,$code = Response::HTTP_INTERNAL_SERVER_ERROR){
        $this->message = $message;
        $this->code = $code;
    }
}