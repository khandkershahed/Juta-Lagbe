<x-admin-app-layout :title="'Staff Edit'">

    <div class="card card-flash">
        <div class="card-body scroll-y mx-5 mx-xl-15 my-7">
            <form class="form" method="POST" action="{{ route('admin.staff.update',$staff->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-lg-6 mb-7">
                        <x-metronic.label for="name"
                            class="required fw-bold fs-6 mb-2">{{ __('Full Name') }}</x-metronic.label>
                        <x-metronic.input id="name" type="text" class="form-control-solid mb-3 mb-lg-0"
                            name="name" :value="old('name',$staff->name)" placeholder="Enter Full name"></x-metronic.input>
                    </div>
                    <div class="col-lg-6 mb-7">
                        <x-metronic.label for="email"
                            class="required fw-bold fs-6 mb-2">{{ __('Email') }}</x-metronic.label>
                        <x-metronic.input id="email" type="email" class="form-control-solid mb-3 mb-lg-0"
                            name="email" :value="old('email',$staff->email)" placeholder="example@domain.com"></x-metronic.input>
                    </div>
                    <div class="col-lg-4 mb-7">
                        <x-metronic.label for="username"
                            class="fw-bold fs-6 mb-2">{{ __('User Name') }}</x-metronic.label>
                        <x-metronic.input id="username" type="text" class="form-control-solid mb-3 mb-lg-0"
                            name="username" :value="old('username',$staff->username)" placeholder="Enter User name"></x-metronic.input>
                    </div>

                    <div class="col-lg-4 mb-7">
                        <x-metronic.label for="designation"
                            class="fw-bold fs-6 mb-2">{{ __('Designation') }}</x-metronic.label>
                        <x-metronic.input id="designation" type="text" class="form-control-solid mb-3 mb-lg-0"
                            name="designation" :value="old('designation',$staff->designation)" placeholder="Designation"></x-metronic.input>
                    </div>
                    <div class="col-lg-4 mb-7">
                        <x-metronic.label for="photo"
                            class="fw-bold fs-6 mb-2">{{ __('Photo') }}</x-metronic.label>
                        <x-metronic.file-input id="photo" type="file" class="form-control-solid mb-3 mb-lg-0" :source="asset('storage/'.$staff->photo)"
                            name="photo" :value="old('photo')" placeholder="example@domain.com"></x-metronic.file-input>
                    </div>
                    <div class="col-lg-6 mb-7">
                        <x-metronic.label for="password"
                            class="required fw-bold fs-6 mb-2">{{ __('Password') }}</x-metronic.label>
                        <x-metronic.input id="password" type="password" class="form-control-solid mb-3 mb-lg-0"
                            name="password" placeholder="Enter Password"></x-metronic.input>
                    </div>
                    <div class="col-lg-6 mb-7">
                        <x-metronic.label for="password_confirmation"
                            class="required fw-bold fs-6 mb-2">{{ __('Confirm Password') }}</x-metronic.label>
                        <x-metronic.input id="password_confirmation" type="password"
                            class="form-control-solid mb-3 mb-lg-0" name="password_confirmation"
                            placeholder="Confirm the password"></x-metronic.input>
                    </div>

                    <div class="mb-7">

                        <label class="required fw-bold fs-6 mb-5">Role</label>
                        @foreach ($roles as $role)
                            <div class="d-flex fv-row">
                                <div class="form-check form-check-custom form-check-solid">
                                    <x-metronic.checkbox id="role-name-{{ $role->id }}" type="checkbox"
                                        name="roles[]" :value="$role->name"></x-metronic.checkbox>
                                    <x-metronic.label for="role-name-{{ $role->id }}"
                                        class="form-check-label">{{ $role->name }}</x-metronic.label>
                                </div>
                            </div>
                            <div class='separator separator-dashed my-5'></div>
                        @endforeach
                    </div>
                </div>
                <div class="text-center pt-15">
                    <x-metronic.button type="submit" class="primary">
                        {{ __('Save Changes') }}
                    </x-metronic.button>
                </div>
            </form>
        </div>
    </div>

</x-admin-app-layout>
