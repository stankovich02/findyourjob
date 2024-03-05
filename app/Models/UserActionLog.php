<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActionLog extends Model
{
    protected $fillable = [
        'ip_address',
        'path',
        'method',
        'user_id',
        'action'
    ];
    protected $table = 'user_action_logs';

    public function insert(string $ip, string $path, string $method, int|null $user_id, string $action) : void
    {
        $this->ip_address = $ip;
        $this->path = $path;
        $this->method = $method;
        $this->user_id = $user_id;
        $this->action = $action;
        $this->save();
    }
}
