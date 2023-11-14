<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Type;


class Project extends Model
{
    use HasFactory;
    /**
     * Get the correct url for the img.
     */
    protected function thumb(): Attribute
    {
        return Attribute::make(
            get: function ($value) {

                if (strstr($value, 'http') !== false) {
                    return $value;
                } else {
                    return asset('storage/' . $value);
                }
            }
        );
    }





    protected $fillable = ['title', 'type_id', 'slug', 'thumb', 'description', 'link_github', 'link_project', 'type_id'];



    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }


    public function technologies(): BelongsToMany
    {
        return $this->belongsToMany(Technology::class);
    }
}
