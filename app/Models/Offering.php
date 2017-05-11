<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offering extends Model
{
    use CrudModel;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'fa_created_at',
        'fa_escrow_closes_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The url where this object can be edited in the admin panel.
     *
     * @return string
     */
    public function editUrl()
    {
        return route('admin.offerings.edit', $this->hash);
    }

    /**
     * The url where this object can be viewed.
     *
     * @return string
     */
    public function url()
    {
        return route('offerings.show', $this->hash);
    }

    /**
     * Logged views.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function views()
    {
        return $this->hasMany(OfferingView::class);
    }
}
