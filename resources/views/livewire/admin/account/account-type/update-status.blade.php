<div>
    <button wire:click='updateStatus({{ $account_type_id }})' class="btn position-relative">
        {{ $is_active ? __('msgs.active') : __('msgs.not_active') }}
        <span class="badge {{ $is_active ? 'bg-green' : 'bg-red' }} badge-notification badge-blink"></span>
    </button>
</div>
