<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'pays_id',
        'nom',
        'email',
        'telephone',
        'sexe',
        'date_n',
        'lieu_n',
        'ville',
        'adresse',
        'image',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function transferts()
    { 
        return $this->hasMany(Transfert::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    
    public function pays()
    {
        return $this->belongsTo(Pays::class);
    }

    public function Client()
    { 
        return $this->hasMany(Client::class);
    }

    public function Credit()
    {
        return $this->hasMany(Credit::class);
    }

    public function Recouvrement()
    {
        return $this->hasMany(Recouvrement::class);
    }

    public function caisses()
    {
        return $this->belongsToMany(Caisse::class, 'user_caisses');
    }

    public function User_caisse()
    {
        return $this->belongsTo(User_caisse::class);
    }

    public function Depots()
    {
        return $this->hasMany(Depot::class);
    }
}
