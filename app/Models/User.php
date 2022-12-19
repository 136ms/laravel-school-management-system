<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticable;

class User extends Authenticable
{
    use HasFactory;

    public $table = 'users';

    public $fillable = [
        'fname',
        'lname',
        'birthdate',
        'address',
        'email',
        'gender',
        'phonenum',
        'password'
    ];

    protected $casts = [
        'fname' => 'string',
        'lname' => 'string',
        'birthdate' => 'date',
        'address' => 'string',
        'email' => 'string',
        'gender' => 'string',
        'phonenum' => 'string',
        'password' => 'string'
    ];

    public static $rules = [
        'fname' => 'required|string|max:255',
        'lname' => 'required|string|max:255',
        'birthdate' => 'required|date',
        'address' => 'required|string|max:255',
        'email' => 'required',
        'gender' => 'required|string|max:255',
        'phonenum' => 'required|string|max:255',
        'password' => 'required'
    ];

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class);
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class);
    }

    public function parents(): BelongsToMany
    {
        return $this->belongsToMany(static::class, "child_parent", "parent_id", 'child_id');
    }

    public function children(): BelongsToMany
    {
        return $this->belongsToMany(static::class, "child_parent", "child_id", 'parent_id');
    }
}
