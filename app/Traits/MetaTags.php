<?php

namespace App\Traits;

use App\Models\MetaTag;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

trait MetaTags
{
    /**
     * Default Morphing Relationship for MetaTags
     */
    public function metasTags()
    {
        // Return all metadatas
        return $this->morphMany(MetaTag::class, 'metable');
    }
    /**
     * Function to "Set" a metatag
     */
    public function updateMeta($key, $value, $notes = '')
    {
        try {
            if ($this->metasTags()->withTrashed()->updateOrCreate(
                [
                    'meta_key' => $key
                ],
                [
                    'meta_value' => $value,
                    'notes' => $notes
                ])->restore()) {
                return true;
            }
            return false;
        } catch (\Exception $exception) {
            return false;
        }
        return false;
    }
    /**
     * Function to "Get" a metatag
     */
    public function getMeta($key)
    {
        try {
            return $this->metasTags()->where('meta_key', $key)->withoutTrashed()->first()->meta_value;
        } catch (\Exception $exception) {
            return false;
        }
    }
    /**
     * Function to Get a Meta Note
     */
    public function getMetaNotes($key){
        try {
            return $this->metasTags()->where('meta_key', $key)->withoutTrashed()->first()->notes;
        } catch (\Exception $exception) {
            return false;
        }
    }
    /**
     * Function to Get All Meta
     */
    public function getAllMetas()
    {
        return $this->metasTags()->withoutTrashed()->pluck('meta_value', 'meta_key')->toArray();
    }
    /**
     * Function to "disable" meta... we will note remove
     */
    public function disableMeta($key){
        return $this->metasTags()->where('meta_key', $key)->withoutTrashed()->delete();
    }
    /**
     * Function to force delete a meta (Can delete only a disabled meta)
     */
    public function deleteMeta($key){
        return $this->metasTags()->where('meta_key',$key)->onlyTrashed()->forceDelete();
    }
}
