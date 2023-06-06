<?php

namespace App\Http\Livewire\Admin;

use App\Models\Settings;
use Livewire\Component;

class ThemeDisplay extends Component
{
    public function render()
    {
        return view('livewire.admin.theme-display');
    }

    public function setTheme($theme)
    {

        Settings::where('id', '1')
            ->update([
                'website_theme' => $theme,
            ]);
    }
}