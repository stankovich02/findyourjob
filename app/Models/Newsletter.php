<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class Newsletter extends Model
{

    protected $fillable = [
        'email',
    ];

    protected $table = 'newsletters';

    public function insert($email) : JsonResponse
    {
        $exists = self::where('email', $email)->first();
        if($exists){
            return response()->json(["message" => "You are already subscribed to our newsletter."], ResponseAlias::HTTP_BAD_REQUEST);
        }
        $this->email = $email;
        $this->save();
        return response()->json(["message" => "You have been subscribed to our newsletter!"], ResponseAlias::HTTP_CREATED);
    }

    public function getAll() : \Illuminate\Database\Eloquent\Collection
    {
        return self::all();
    }
}
