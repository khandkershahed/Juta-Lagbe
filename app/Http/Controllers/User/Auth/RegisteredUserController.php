<?php

namespace App\Http\Controllers\User\Auth;


use App\Models\User;
use App\Models\Setting;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Mail\UserRegistrationMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('user.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $userVerification = $setting->user_verification ?? '0'; // Default to '0' if null
        $status = $userVerification === '1' ? 'inactive' : 'active';
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'title'                 => 'nullable|in:Mr,Mrs,Ms',
            'name'                  => 'nullable|string|max:100',
            'email'                 => ['required', 'string', 'email', 'max:255'],
            'password'              => ['required', 'string'],
            // 'password'              => ['required', 'string', 'confirmed'],
            'phone'                 => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11|unique:users,phone',
            'address'               => 'nullable|string|max:255',
            'thana'                 => 'nullable|string|max:200',
            'district'              => 'nullable|string|max:200',
            'newsletter_preference' => 'nullable',
            'terms_condition'       => 'nullable',
        ]);

        // Validate request
        if ($validator->fails()) {
            foreach ($validator->messages()->all() as $message) {
                Session::flash('error', $message);
            }
            return redirect()->back()->withInput();
        }


        try {
            // Create a new customer record
            $user = User::create([
                'title'                 => $request->title,
                'name'                  => $request->name,
                'email'                 => $request->email,
                'password'              => Hash::make($request->password),
                'phone'                 => $request->phone,
                'address'               => $request->address,
                'thana'                 => $request->thana,
                'district'              => $request->district,
                'newsletter_preference' => $request->newsletter_preference,
                'terms_condition'       => $request->terms_condition,
                'status'                => $status,
            ]);

            $setting = Setting::first();
            event(new Registered($user));
            // Mail::to($user->email)->send(new UserRegistrationMail($user->name, $setting));
            Auth::login($user);
            Session::flash('success', "You have registered Successfully");
            return redirect(RouteServiceProvider::HOME);
        } catch (\Illuminate\Database\QueryException $e) {
            Session::flash('error', $e->getMessage());
            return redirect()->back()->withInput();
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
