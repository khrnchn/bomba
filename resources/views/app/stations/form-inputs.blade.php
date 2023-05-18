@php $editing = isset($station) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $station->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="world_city_id"
            label="World City Id"
            :value="old('world_city_id', ($editing ? $station->world_city_id : ''))"
            maxlength="255"
            placeholder="World City Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="world_division_id"
            label="World Division Id"
            :value="old('world_division_id', ($editing ? $station->world_division_id : ''))"
            maxlength="255"
            placeholder="World Division Id"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
