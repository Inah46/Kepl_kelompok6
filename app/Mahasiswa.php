<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Mahasiswa extends Authenticatable
{
  use Notifiable;

  protected $table = 'tb_mahasiswa';

  protected $fillable = [
    'nim','nama','kelas', 'jurusan', 'password'
  ];

  protected $hidden = [
    'password','remember_token'
  ];

  protected $primaryKey = 'nim';

  public $incrementing = false;

  public function setPasswordAttribute($value)
  {
    $this->attributes['password'] = bcrypt($value);
  }
}
