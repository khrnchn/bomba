@php $editing = isset($user) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $user->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.email
            name="email"
            label="Email"
            :value="old('email', ($editing ? $user->email : ''))"
            maxlength="255"
            placeholder="Email"
            required
        ></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.password
            name="password"
            label="Password"
            maxlength="255"
            placeholder="Password"
            :required="!$editing"
        ></x-inputs.password>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="ic_no"
            label="Ic No"
            :value="old('ic_no', ($editing ? $user->ic_no : ''))"
            maxlength="255"
            placeholder="Ic No"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="dob"
            label="Dob"
            :value="old('dob', ($editing ? $user->dob : ''))"
            maxlength="255"
            placeholder="Dob"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="gender_id" label="Gender" required>
            @php $selected = old('gender_id', ($editing ? $user->gender_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Reference</option>
            @foreach($references as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="age"
            label="Age"
            :value="old('age', ($editing ? $user->age : ''))"
            maxlength="255"
            placeholder="Age"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="phone_no"
            label="Phone No"
            :value="old('phone_no', ($editing ? $user->phone_no : ''))"
            maxlength="255"
            placeholder="Phone No"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="world_city_id"
            label="World City Id"
            :value="old('world_city_id', ($editing ? $user->world_city_id : ''))"
            maxlength="255"
            placeholder="World City Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="world_division_id"
            label="World Division Id"
            :value="old('world_division_id', ($editing ? $user->world_division_id : ''))"
            maxlength="255"
            placeholder="World Division Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <div class="px-4 my-4">
        <h4 class="font-bold text-lg text-gray-700">
            Assign @lang('crud.roles.name')
        </h4>

        <div class="py-2">
            @foreach ($roles as $role)
            <div>
                <x-inputs.checkbox
                    id="role{{ $role->id }}"
                    name="roles[]"
                    label="{{ ucfirst($role->name) }}"
                    value="{{ $role->id }}"
                    :checked="isset($user) ? $user->hasRole($role) : false"
                    :add-hidden-value="false"
                ></x-inputs.checkbox>
            </div>
            @endforeach
        </div>
    </div>
</div>
