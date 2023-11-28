<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Origin extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Uuids;

    protected $table = 'origins';
    protected $fillable = ['name','base_url','auth_type','auth_config','service_id'];

    protected $casts = [
        'auth_config' => 'json'
    ];

    /**
     * Relationships
     */
    public function service():HasOne
    {
        return $this->hasOne('App\Models\Service','id','service_id');
    }

    public function forceService():HasOne
    {
        return $this->hasOne('App\Models\Service','id','service_id')->withTrashed();
    }

    public function requests():HasMany
    {
        return $this->hasMany('App\Models\Request','origin_id','id');
    }
}
