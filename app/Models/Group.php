<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'group_name',
        'name',
        'phone_number',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Usersテーブルとのリレーション
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User')->withTimestamps();
    }

    /**
     * Adminsテーブルとのリレーション
     */
    public function admins()
    {
        return $this->belongsToMany('App\Models\Admin')->withTimestamps();
    }
}