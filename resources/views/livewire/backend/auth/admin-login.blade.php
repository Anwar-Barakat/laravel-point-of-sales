<div>
    <form wire:submit.prevent="login">
        <div class="mb-3">
            <label class="form-label">Email address</label>
            <input type="email" class="form-control" placeholder="Your Email" required wire:model="email">
            @error('email')
                <small class="text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-2">
            <label class="form-label">
                Password
                <span class="form-label-description">
                    <a href="">I forgot password</a>
                </span>
            </label>
            <div class="input-group input-group-flat">
                <input type="password" class="form-control" placeholder="Your password" required  wire:model="password">
            </div>
            @error('password')
                <small class="text text-danger">{{ $message }}</small>
            @enderror
        </div>
        {{-- <div class="mb-2">
            <label class="form-check">
                <input type="checkbox" class="form-check-input" />
                <span class="form-check-label">Remember me on this device</span>
            </label>
        </div> --}}
        <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">Sign in</button>
        </div>
    </form>
</div>
