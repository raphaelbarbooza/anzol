<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Uuids;

    protected $table = 'services';
    protected $fillable = ['name','description','image_url'];

    /**
     * Relationships
     */
    public function origins():HasMany
    {
        return $this->hasMany('App\Models\Origin','service_id','id');
    }

}
