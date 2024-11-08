<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Product;
use App\Models\TwoFactor;
use App\Traits\HasTwoFactor;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Password;
use App\Notifications\Auth\TwoFactorNotification;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Notifications\Auth\CreatePasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasTwoFactor;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'role_id',
        'image',
        'enabled_2fa'
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

    /**
     * Define HasMany to relationship with two factor .
     */
    public function twoFactors(): HasMany
    {
        return $this->hasMany(TwoFactor::class);
    }

    /**
     * Define function for checking the user's avatar.
     */
    protected function isImagePathExist(string $path): bool
    {
        return Storage::disk('public')->exists($path);
    }

    /**
     * Define accessor for avatar attribute.
     */
    protected function imagePath(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->image != null
                ? (
                    $this->isImagePathExist($this->image)
                    ? Storage::url($this->image)
                    : false
                )
                : false
        );
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function deleteImage()
    {
        if ($this->image && Storage::disk('public')->exists($this->image)) {
            Storage::disk('public')->delete($this->image);
        }
        $this->update(['image' => null]);
    }

    public function sendCreatePasswordNotification(): void
    {
        $url = route('password.reset', ['token' => Password::createToken($this), 'email' => $this->email]);

        $this->notify(new CreatePasswordNotification($url, $this));
    }

    /**
     * Send a two factor notification to the user.
     */
    public function sendTwoFactorNotification($request)
    {
        $this->notify(new TwoFactorNotification($this->generateTwoFactorCode($request->ip())));
    }

    /**
     * Define accessor for is password null.
     */
    protected function isPasswordNull(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->password == NULL
        );
    }
    
}
