<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    const FILLABLE = ['site_name_ar', 'site_name_en', 'site_description_ar'
        , 'site_description_en', 'done_by_ar', 'done_by_en', 'face_book_link', 'twitter_link', 'instagram_link', 'site_icon','tags'];

    protected $fillable = self::FILLABLE;
    protected $appends = ['icon', 'site_description', 'site_name','site_tags'];

    public function getIconAttribute()
    {
        if ($this->site_icon == 'icon_site.png') {
            return asset('assets/media/icons/icon_site.png');
        }
        return asset('storage/site-icons/' . $this->site_icon);
    }

    public function getSiteDescriptionAttribute()
    {
        $points = strlen($this->site_description_ar) > 90 ? ' ...' : '';
        if (app()->getLocale() == 'ar') {
            return substr($this->site_description_ar, 0, 90) . $points;
        }
        return substr($this->site_description_en, 0, 90) . $points;

    }

    public function getSiteNameAttribute()
    {
        if (app()->getLocale() == 'ar') {
            return $this->site_name_ar;
        }
        return $this->site_name_en;

    }
    public function getSiteTagsAttribute()
    {
        return (json_encode(convertTagsStringToObject($this->tags)));


    }
}
