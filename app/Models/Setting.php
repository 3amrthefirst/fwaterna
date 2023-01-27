<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Setting extends Model
{
    use HasTranslations,LogTrait;
    public $translatable = [
        'site_name',
        'about_us',
        'goal',
        'our_services_sub_title',
        'commercial_issues_sub_title',
        'our_team_sub_title',
        'our_clients_sub_title',
        'faq_sub_title',
        'blog_sub_title'
    ];

    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = [
        'site_name',
        'about_us',
        'goal',
        'our_services_sub_title',
        'commercial_issues_sub_title',
        'our_team_sub_title',
        'our_clients_sub_title',
        'faq_sub_title',
        'blog_sub_title',
        'expert_laywers',
        'closed_cases',
        'successful_casses',
        'trusted_client',
        'phone',
        'email',
        'twitter',
        'linkedin',
    ];

    public function photo()
    {
        return $this->morphOne(Attachment::class, 'attachmentable');
    }

}
