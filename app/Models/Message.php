<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['name', 'subject', 'email', 'message'];

    protected $table = 'messages';

    public function contact($email, $name, $subject, $message)
    {
        try {
            $this->email = $email;
            $this->name = $name;
            $this->subject = $subject;
            $this->message = $message;
            $this->save();
            return true;
        } catch (\Exception $e) {
            return false;

        }
    }
}
