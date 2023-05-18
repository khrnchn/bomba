@php $editing = isset($feedback) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="program_id" label="Program" required>
            @php $selected = old('program_id', ($editing ? $feedback->program_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Program</option>
            @foreach($programs as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="participant_id" label="Participant" required>
            @php $selected = old('participant_id', ($editing ? $feedback->participant_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Participant</option>
            @foreach($participants as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="comment"
            label="Comment"
            :value="old('comment', ($editing ? $feedback->comment : ''))"
            maxlength="255"
            placeholder="Comment"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="rating"
            label="Rating"
            :value="old('rating', ($editing ? $feedback->rating : ''))"
            maxlength="255"
            placeholder="Rating"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="feedback_photo_path"
            label="Feedback Photo Path"
            maxlength="255"
            required
            >{{ old('feedback_photo_path', ($editing ?
            $feedback->feedback_photo_path : '')) }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
