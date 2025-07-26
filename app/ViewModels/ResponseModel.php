<?php
namespace App\ViewModels;

class ResponseModel{
    public string $message;
    public int $status;
    public $data;

    private function __construct(int $status,string $message, $data){
        $this->status = $status;
        $this->message=$message;
        $this->data= $data;
    }

    public static function Ok(string $message,$data){
        return new ResponseModel(200,$message,$data);
    }

    public static function Accepted(string $message,$data){
        return new ResponseModel(201,$message,$data);
    }

    public static function BadRequest(string $message,$data){
        return new ResponseModel(400,$message,$data);
    }

    public static function NotFound(string $message,$data){
        return new ResponseModel(404,$message,$data);
    }

    public static function Unauthorized(string $message,$data){
        return new ResponseModel(401,$message,$data);
    }

    public static function InternalServerError(string $message,$data){
        return new ResponseModel(500,$message,$data);
    }
}

?>