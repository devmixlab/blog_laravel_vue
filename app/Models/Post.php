<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

//    protected $guarded = [];

    protected $fillable = [
        'file_alt','file_name','file_original_name',
        'title','seo_title','seo_description',
        'seo_keywords','description','text','text_striped','top'
    ];

    public function getPathAttribute()
    {
        if(is_null($this->file_name))
            return null;

        return Storage::url(implode(DIRECTORY_SEPARATOR, [
            'public', 'post', $this->file_name
        ]));
    }

    public function getCategoriesAttribute()
    {
        return $this->tags()->get();
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'tag_post');
    }

    public function toArray(bool $with_custom_attrs = false) : array
    {
        $result = parent::toArray();
        if(!$with_custom_attrs)
            return $result;

        $result['path'] = $this->path;
        $result['categories'] = $this->categories;

        return $result;
    }

    public function deleteFile(bool $save = false) {
        Storage::delete(implode(DIRECTORY_SEPARATOR, [
            'public', 'post', $this->file_name
        ]));

        $this->file_name = null;
        $this->file_original_name = null;
        $this->file_alt = null;

        if($save)
            $this->save();
    }

    public function addFile($file, bool $save = false) {
        $this->file_original_name = $file->getClientOriginalName();
        $this->file_name = uniqid(). '.' . File::extension($this->file_original_name);

        $file->storeAs(
            'public' . DIRECTORY_SEPARATOR . 'post',
            $this->file_name
        );

        if($save)
            $this->save();
    }
}
