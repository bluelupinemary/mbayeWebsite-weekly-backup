<?php

namespace App\Models\CareStories\Traits\Attribute;


trait CareStoryAttribute
{
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn">'.
                // $this->getEditButtonAttribute('edit-blog', 'admin.carestory.edit').
                $this->getDeleteButtonAttribute('delete-blog', 'admin.carestory.destroy').
                $this->getShowButtonAttribute('delete-blog', 'admin.carestory.show').
                '</div>';
    }
}
