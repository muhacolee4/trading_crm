<?php

namespace App\Http\Livewire\Admin;

use App\Models\Settings;
use App\Traits\PingServer;
use Livewire\Component;

class SoftwareModule extends Component
{
    use PingServer;

    public function render()
    {
        return view('livewire.admin.software-module');
    }

    public function updateModule($module, $value)
    {
        $settings = Settings::find(1);

        if ($module == 'membership' or $module == 'signal') {

            $response = $this->fetctApi('/set-modules', [
                'value' => $value,
                'module' => $module
            ], 'POST');
            $info = json_decode($response);

            if ($response->failed() or $info->error) {
                return redirect()->route('appsettingshow')->with('message', $info->message);
            }
            if (!$info->error or $response->successful()) {
                $options = $settings->modules;
                $options[$module] = $value == 'true' ? true : false;
                $settings->modules = $options;
                $settings->save();
                return redirect()->route('appsettingshow')->with('success', $info->message);
            }
        } else {
            //save option
            $options = $settings->modules;
            $options[$module] = $value == 'true' ? true : false;
            $settings->modules = $options;
            $settings->save();
            return redirect()->route('appsettingshow')->with('success', 'Action Successful');
        }
    }
}