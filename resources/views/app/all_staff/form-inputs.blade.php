@php $editing = isset($staff) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $staff->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="station_id" label="Station" required>
            @php $selected = old('station_id', ($editing ? $staff->station_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Station</option>
            @foreach($stations as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="department_id" label="Department" required>
            @php $selected = old('department_id', ($editing ? $staff->department_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Department</option>
            @foreach($departments as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="referral_code"
            label="Referral Code"
            :value="old('referral_code', ($editing ? $staff->referral_code : ''))"
            maxlength="255"
            placeholder="Referral Code"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
