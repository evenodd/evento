<!-- 
Params:
    string $labelSize sets the size for the label column e.g '3'
    string $inputSize sets the size for the input column e.g '6'
 -->

<div class="form-group{{ $errors->has('guest-list-input') ? ' has-error' : '' }}">
    <label for="max-guests-input" class="col-md-{{$labelSize}} control-label">Invite Guests</label>
    <div class="col-md-{{$inputSize}}">
        <select id="guests-list-input" class="form-control guest-select2" name="guests-list-input" style="width: 100%" multiple="multiple">
        	
        </select>
    </div>
</div>