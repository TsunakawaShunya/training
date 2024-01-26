<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PartController extends Controller
{
    public function user() {
        return $this->belongsTo(User::class);
    }
}
