<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('user.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {

        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }


    public function profileUpdate(Request $request): RedirectResponse
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'title'                         => 'nullable|in:Mr,Mrs,Ms',
            'first_name'                    => 'nullable|string|max:100',
            'last_name'                     => 'nullable|string|max:100',
            'email'                         => ['email', 'max:255', Rule::unique(User::class)->ignore($request->user()->id)],
            'phone'                         => 'nullable|max:20',
            'address_one'                   => 'nullable|string|max:255',
            'address_two'                   => 'nullable|string|max:255',
            'zipcode'                       => 'nullable|string|max:10',
            'state'                         => 'nullable|string|max:100',
            'state'                         => 'country|string|max:100',
            'company_name'                  => 'nullable|string|max:255',
            'company_registration_number'   => 'nullable|string|max:255',
            'company_vat_number'            => 'nullable|string|max:255',
            'selling_platforms'             => 'nullable|string',
            'customer_type'                 => 'nullable|string',
            'referral_source'               => 'nullable|string|max:255',
            'buying_group_membership'       => 'nullable|string|max:255',
            'website_address'               => 'nullable|url',
            'buying_group_name'             => 'nullable|string|max:255',
            'current_suppliers'             => 'nullable|string',
            'annual_spend'                  => 'nullable|string',
            'newsletter_preference'         => 'nullable',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Fill user data with validated data
        $user = $request->user();
        $user->fill($validator->validated());

        // Handle email verification if email changed
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Save user changes
        $user->save();

        // Redirect back with success message
        return redirect()->back()->with('status', 'profile-updated');
    }
    /**
     * Delete the user's account.
     */



    public function imageUpdate(Request $request)
    {
        // Validate the uploaded image
        $validator = Validator::make($request->all(), [
            'profile_image'  => 'nullable|image|mimes:png,jpg,jpeg,webp|max:3072',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Get the authenticated user
        $user = $request->user();

        // Check if a new file is uploaded
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filePath = 'client/profile_images'; // Folder to save the file
            $oldFile = $user->profile_image; // Old profile image file path

            // Delete the old profile image if it exists
            if ($oldFile && Storage::exists("public/$oldFile")) {
                Storage::delete("public/$oldFile");
            }

            // Upload the new image
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs("public/$filePath", $imageName);

            // Update the user's profile image field
            $user->profile_image = "$filePath/$imageName";

            // Save the user model with the updated profile image
            $user->save(); // This should work if $user is a valid Eloquent model
        }

        // Flash success message and redirect back
        Session::flash('success', 'Profile image updated successfully');
        return redirect()->back();
    }



    public function destroy(Request $request)
    {
        // $request->validateWithBag('userDeletion', [
        //     'password' => ['required', 'current_password'],
        // ]);

        // $user = $request->user();

        // Auth::logout();

        // $user->delete();

        // $request->session()->invalidate();
        // $request->session()->regenerateToken();

        // return Redirect::to('/');
        $user = $request->user();
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
