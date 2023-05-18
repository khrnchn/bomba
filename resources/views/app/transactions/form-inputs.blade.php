@php $editing = isset($transaction) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $transaction->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="amount"
            label="Amount"
            :value="old('amount', ($editing ? $transaction->amount : ''))"
            max="255"
            step="0.01"
            placeholder="Amount"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="transactionable_id"
            label="Transactionable Id"
            :value="old('transactionable_id', ($editing ? $transaction->transactionable_id : ''))"
            maxlength="255"
            placeholder="Transactionable Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="transactionable_type"
            label="Transactionable Type"
            :value="old('transactionable_type', ($editing ? $transaction->transactionable_type : ''))"
            maxlength="255"
            placeholder="Transactionable Type"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
