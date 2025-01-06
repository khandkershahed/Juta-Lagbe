<x-guest-layout>
    <div id="#kt_app_body_content"
        style="background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;">
        <div
            style="background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 24px; margin:40px auto; max-width: 600px;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" height="auto"
                style="border-collapse:collapse">
                <tbody>
                    <tr>
                        <td align="center" valign="center" style="text-align:center; padding-bottom: 10px">
                            <div style="text-align:center; margin:0 15px 34px 15px">
                                <div style="margin-bottom: 10px">
                                    <a href="https://keenthemes.com" rel="noopener" target="_blank">
                                        <img alt="Logo"
                                            src="https://www.neezpackages.com/storage/webSetting/site_logo_black/uARo74PAYg1724833221.png"
                                            style="height: 35px">
                                    </a>
                                </div>
                                <div style="margin-bottom: 15px">
                                    <img alt="Logo"
                                        src="https://www.neezpackages.com/storage/webSetting/site_logo_black/uARo74PAYg1724833221.png">
                                </div>
                                <div
                                    style="font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;">
                                    <p style="margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700">Hey
                                        {{ __('Thanks for signing up! Before getting started.') }}</p>
                                    <p style="margin-bottom:2px; color:#7E8299">
                                        {{ __('Could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                                    </p>
                                </div>
                                <form method="POST" action="{{ route('verification.send') }}">
                                    <a href="javascript:void(0)" target="_blank"
                                        style="background-color:#50cd89; border-radius:6px;display:inline-block; padding:11px 19px; color: #FFFFFF; font-size: 14px; font-weight:500;">
                                        <x-primary-button>
                                            {{ __('Resend Verification Email') }}
                                        </x-primary-button>
                                    </a>
                                </form>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="javascript:void(0)" target="_blank"
                                        style="background-color:#50cd89; border-radius:6px;display:inline-block; padding:11px 19px; color: #FFFFFF; font-size: 14px; font-weight:500;">
                                        <button type="submit"
                                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            {{ __('Log Out') }}
                                        </button>
                                    </a>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <tr style="display: flex; justify-content: center; margin:0 60px 35px 60px">
                        <td align="start" valign="start" style="padding-bottom: 10px;">
                            @if (session('status') == 'verification-link-sent')
                                <p style="color:#181C32; font-size: 18px; font-weight: 600; margin-bottom:13px">
                                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                                </p>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-guest-layout>
