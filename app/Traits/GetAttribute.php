<?php

namespace App\Traits;

use App\Models\Attachment;

trait GetAttribute
{
    public $trans_cols = [];
    public $multiple_attachment = false;
    public $multiple_attachment_usage = ['default'];


    public function attachmentRelation()
    {
        $relation = $this->multiple_attachment ? 'morphMany' : 'morphOne';
        return $this->$relation(Attachment::class, 'attachmentable');
    }

    public function getAttachmentAttribute()
    {
        if ($this->multiple_attachment) {
            if ($this->attachmentRelation()->count()) {
                $return = [];

                foreach ($this->multiple_attachment_usage as $usage) {

                    $array = [];

                    foreach ($this->attachmentRelation()->where('usage', ($usage == 'default' ? null : $usage))->get() as $attachment) {
                        array_push($array, asset($attachment->path));

                    }

                    $return += [$usage => $array];
                }


            } else {
                $return = [];
            }

        } else {

            $return = $this->attachmentRelation()->count() ?
                asset($this->attachmentRelation()->first()->path) : asset('img/logo.png');
        }

        return $return;
    }

    public function getTransAttribute()
    {
        $trans = [];

        if (count($this->trans_cols)) {
            foreach ($this->trans_cols as $col) {
                $trans += [$col => $this[$col . '_' . app()->getLocale()]];
            }
        }
        return (object)$trans;
    }
}