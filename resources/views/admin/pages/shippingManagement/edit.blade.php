<x-admin-app-layout :title="'Product Add'">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <form action="{{ route('admin.shipping-management.update', $method->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body row">
                    <div class="mb-5 fv-row col-12">
                        <x-metronic.label class="form-label">Title</x-metronic.label>
                        <x-metronic.input type="text" name="title" class="form-control mb-2"
                            placeholder="Enter title" :value="old('title', $method->title)">
                        </x-metronic.input>
                        <div class="text-muted fs-7">
                            A unique title for the shipping method.
                        </div>
                    </div>


                    {{-- <div class="mb-5 fv-row col-6">
                            <x-metronic.label class="form-label">Location</x-metronic.label>
                            <x-metronic.input type="text" name="location" class="form-control mb-2"
                                placeholder="Enter location" :value="old('location', $method->location)">
                            </x-metronic.input>
                            <div class="text-muted">
                                Location shipping method.
                            </div>
                        </div> --}}
                    @php
                        $selected_thanas = isset($method->thana)
                            ? json_decode($method->thana, true)
                            : [];
                    @endphp
                    <div class="mb-5 fv-row col-6">
                        <x-metronic.label for="thana" class="form-label required">
                            {{ __('Thana') }}
                        </x-metronic.label>
                        <select name="thana[]" id="thana" class="form-select form-select-solid"
                            data-control="select2" data-close-on-select="false" required
                            data-placeholder="Select an option" data-allow-clear="true" multiple="multiple">
                            <option>Choose thana</option>
                            @foreach ($thanas as $thana)
                                <option value="{{ $thana->bn_name }}" @selected(is_array($selected_thanas) && in_array($thana->bn_name, $selected_thanas))>
                                    {{ $thana->bn_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-5 fv-row w-50 col-6">
                        <x-metronic.label class="form-label">Duration</x-metronic.label>
                        <x-metronic.input type="text" name="duration" class="form-control mb-2"
                            placeholder="Enter duration" :value="old('duration', $method->duration)">
                        </x-metronic.input>
                        <div class="text-muted fs-7">
                            Estimated delivery time.
                        </div>
                    </div>
                    {{-- <div class="mb-5 fv-row">
                            <x-metronic.label class="form-label">Description</x-metronic.label>
                            <textarea name="description" class="ckeditor form-control mb-2" placeholder="Add detailed description">{!! old('description', $method->description) !!}</textarea>
                            <div class="text-muted fs-7">
                                Detailed description of the shipping method.
                            </div>
                        </div> --}}
                    <div class="mb-5 fv-row col-4">
                        <x-metronic.label class="form-label">Carrier</x-metronic.label>
                        <x-metronic.input type="text" name="carrier" class="form-control mb-2"
                            placeholder="Enter carrier name" :value="old('carrier', $method->carrier)">
                        </x-metronic.input>
                        <div class="text-muted fs-7">
                            The carrier or service provider for the shipping method.
                        </div>
                    </div>
                    <div class="mb-5 fv-row col-4">
                        <x-metronic.label class="form-label">Min Weight</x-metronic.label>
                        <x-metronic.input type="number" name="min_weight" class="form-control mb-2"
                            placeholder="Enter minimum weight" :value="old('min_weight', $method->min_weight)">
                        </x-metronic.input>
                        <div class="text-muted fs-7">
                            Minimum weight for the shipping method.
                        </div>
                    </div>
                    <div class="mb-5 fv-row col-4">
                        <x-metronic.label class="form-label">Max Weight</x-metronic.label>
                        <x-metronic.input type="number" name="max_weight" class="form-control mb-2"
                            placeholder="Enter maximum weight" :value="old('max_weight', $method->max_weight)">
                        </x-metronic.input>
                        <div class="text-muted fs-7">
                            Maximum weight for the shipping method.
                        </div>
                    </div>
                    <div class="mb-5 fv-row col-6">
                        <x-metronic.label class="form-label">Price</x-metronic.label>
                        <x-metronic.input type="number" name="price" class="form-control mb-2"
                            placeholder="Enter price" :value="old('price', $method->price)">
                        </x-metronic.input>
                        <div class="text-muted fs-7">
                            Cost associated with the shipping method.
                        </div>
                    </div>
                    <div class="mb-5 fv-row col-6">
                        <x-metronic.label class="form-label">Status</x-metronic.label>
                        <select class="form-select" name="status" data-control="select2" data-hide-search="true"
                            data-allow-clear="true" data-placeholder="Select status">
                            <option value="active" {{ old('status', $method->status) === 'active' ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="inactive"
                                {{ old('status', $method->status) === 'inactive' ? 'selected' : '' }}>
                                Inactive</option>
                        </select>
                        <div class="text-muted fs-7">
                            Status of the shipping method (Active/Inactive).
                        </div>
                    </div>
                </div>

                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</x-admin-app-layout>
