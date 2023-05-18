@php $editing = isset($check) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="program_id" label="Program" required>
            @php $selected = old('program_id', ($editing ? $check->program_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Program</option>
            @foreach($programs as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="counter_id" label="Counter" required>
            @php $selected = old('counter_id', ($editing ? $check->counter_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Counter</option>
            @foreach($counters as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="staff_id" label="Staff" required>
            @php $selected = old('staff_id', ($editing ? $check->staff_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Staff</option>
            @foreach($allStaff as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="participant_id" label="Participant" required>
            @php $selected = old('participant_id', ($editing ? $check->participant_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Participant</option>
            @foreach($participants as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="isCheckIn"
            label="Is Check In"
            :checked="old('isCheckIn', ($editing ? $check->isCheckIn : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>
</div>
