<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Request extends Model
{
    use HasFactory;
    use Uuids;

    protected $table = 'requests';
    protected $fillable = ['origin_id','request_url','request_ip','request_data','request_detail','request_query_string','request_headers','request_body','request_raw_data','status','request_method'];

    protected $casts = [
      'request_data' => 'json',
      'request_detail' => 'json',
      'request_query_string' => 'json',
      'request_headers' => 'json',
      'request_body' => 'json'
    ];

    /**
     * Relationships
     */
    public function origin():HasOne
    {
        return $this->hasOne('App\Models\Origin','id','origin_id');
    }

    public function forceOrigin():HasOne
    {
        return $this->hasOne('App\Models\Origin','id','origin_id')->withTrashed();
    }

}
