@php $editing = isset($manualPayment) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="file_path"
            label="File Path"
            maxlength="255"
            required
            >{{ old('file_path', ($editing ? $manualPayment->file_path : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="remarks"
            label="Remarks"
            :value="old('remarks', ($editing ? $manualPayment->remarks : ''))"
            maxlength="255"
            placeholder="Remarks"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="payment_method"
            label="Payment Method"
            :value="old('payment_method', ($editing ? $manualPayment->payment_method : ''))"
            maxlength="255"
            placeholder="Payment Method"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
