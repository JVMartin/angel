<?php

namespace App\Models;

use Mail;
use App\Mail\App\ResetPasswordLinkEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use CrudModel;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Is this user an administrator?
     *
     * @return bool
     */
    public function isAdmin()
	{
		return $this->role === 'admin' || $this->role === 'superadmin';
	}

    /**
     * Is this user a super administrator?
     *
     * @return bool
     */
	public function isSuperAdmin()
	{
		return $this->role === 'superadmin';
	}

    /**
     * Can this user see broker-dealer details on offers?
     *
     * @return bool
     */
	public function canSeeBDDetails()
    {
        if ($this->isAdmin()) return true;

        return (strlen($this->crd) > 0);
    }

    /**
     * The full name of the user.
     *
     * @return string
     */
	public function fullName()
	{
		return $this->first_name . ' ' . $this->last_name;
	}

    /**
     * The url where the user can be edited in the admin panel.
     *
     * @return string
     */
	public function editUrl()
	{
		return route('admin.users.edit', $this->hash);
	}

    /**
     * Logs of the user's sign ins.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
	public function signIns()
    {
        return $this->hasMany(SignIn::class);
    }

    /**
     * Logged views of offerings.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
	public function views()
	{
		return $this->hasMany(OfferingView::class);
	}

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        Mail::to($this->email)->send(new ResetPasswordLinkEmail($token));
    }
}
