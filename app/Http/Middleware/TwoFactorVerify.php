<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class TwoFactorVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        $logg = Auth::guard('admin')->user();
        $user = Admin::where('email',$logg->email)->first();
        
        if($user->enable_2fa == "enabled" && $user->token_2fa_expiry < \Carbon\Carbon::now() &&             ($user->pass_2fa == "false" || $user->pass_2fa == NULL)){
            return redirect('/admin/2fa');  
        }
        else{
            return $next($request);
        }
    }
}