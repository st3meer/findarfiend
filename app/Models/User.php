<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar', 
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

public function friendRequests()
{
    // Friend requests received by the user merged with ones sent by the user
    $a = $this->hasMany(FriendRequest::class, 'receiver_id') ->get();
    $b = $this->hasMany(FriendRequest::class, 'sender_id') ->get();
    return $a->merge($b);
}

public function distanceTo(User $otherUser)
{
    if (!$this->latitude || !$this->longitude || !$otherUser->latitude || !$otherUser->longitude) {
        return null;
    }

    $earthRadius = 6371; // Radius of the Earth in kilometers

    $latFrom = deg2rad($this->latitude);
    $lonFrom = deg2rad($this->longitude);
    $latTo = deg2rad($otherUser->latitude);
    $lonTo = deg2rad($otherUser->longitude);

    $latDelta = $latTo - $latFrom;
    $lonDelta = $lonTo - $lonFrom;

    $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
        cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));

    return round($earthRadius * $angle, 1); // 1 decimal place
}
}
