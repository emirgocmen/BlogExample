<div class="form-check mb-3">
    <input class="form-check-input" type="checkbox" {{ $value  == "on" ? "checked" : null; }} id="{{ $name }}" name="{{ $name }}">
    <label class="form-check-label" for="{{ $name }}">
        {{ $label }}
    </label>
</div>