@csrf

<div class="form-grid">
    <div class="form-group">
        <label for="name">Name</label>
        <input id="name" name="name" type="text" value="{{ old('name', $customer->name) }}" minlength="2" maxlength="255" required>
        @error('name')<div class="error">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
        <label for="type">Type</label>
        <select id="type" name="type" required>
            <option value="I" @selected(old('type', $customer->type) === 'I')>Individual (I)</option>
            <option value="B" @selected(old('type', $customer->type) === 'B')>Business (B)</option>
        </select>
        @error('type')<div class="error">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email', $customer->email) }}" maxlength="255" required>
        @error('email')<div class="error">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
        <label for="address">Address</label>
        <input id="address" name="address" type="text" value="{{ old('address', $customer->address) }}" minlength="5" maxlength="255" required>
        @error('address')<div class="error">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
        <label for="city">City</label>
        <input id="city" name="city" type="text" value="{{ old('city', $customer->city) }}" minlength="2" maxlength="120" required>
        @error('city')<div class="error">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
        <label for="state">State</label>
        <input id="state" name="state" type="text" value="{{ old('state', $customer->state) }}" minlength="2" maxlength="100" required>
        @error('state')<div class="error">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
        <label for="postal_code">Postal Code</label>
        <input id="postal_code" name="postal_code" type="text" value="{{ old('postal_code', $customer->postal_code) }}" minlength="3" maxlength="20" pattern="[A-Za-z0-9\- ]+" title="Use letters, numbers, spaces, or hyphens only" required>
        @error('postal_code')<div class="error">{{ $message }}</div>@enderror
    </div>
</div>

<div style="margin-top: 14px; display: flex; gap: 10px;">
    <button class="btn btn-primary" type="submit">{{ $buttonLabel }}</button>
    <a href="{{ route('customers.index') }}">Cancel</a>
</div>
