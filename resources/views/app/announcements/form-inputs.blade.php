@php $editing = isset($announcement) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="title"
            label="Title"
            :value="old('title', ($editing ? $announcement->title : ''))"
            maxlength="255"
            placeholder="Title"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="description"
            label="Description"
            :value="old('description', ($editing ? $announcement->description : ''))"
            maxlength="255"
            placeholder="Description"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="image_path"
            label="Image Path"
            maxlength="255"
            required
            >{{ old('image_path', ($editing ? $announcement->image_path : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="file_path"
            label="File Path"
            maxlength="255"
            required
            >{{ old('file_path', ($editing ? $announcement->file_path : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
