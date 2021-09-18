@extends('layouts.default')

@push('styles')

@endpush

@section('title','Workout Plan')
@section('sub_title','Workout Exercise')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card custom-card">

            <form action="{{route('createExercise')}}" method="POST" class="login-form" id="create_exercise_form">
                @csrf
                <div class="card-body">
                    <h6 class="card-title mb-3">Workout Exercise</h6>
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group @error('exercise_name') has-danger @enderror">
                                <label>Exercise Name</label>
                                <input class="form-control" placeholder="Enter a Name" type="text"
                                    name="exercise_name"  @if(!empty(old('exercise_name'))) value="{{old('exercise_name')}}" @else value="" @endif>
                                @error('exercise_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group @error('exercise_equipment_id') has-danger @enderror">
                                <label>Equipment</label>
                                <select class="form-control select2" name="exercise_equipment_id" id="exercise_equipment_id">
                                    <option value="" label="Choose one">
                                        Choose one
                                    </option>
                                    @foreach($equipments as $equipment)
                                    <option value="{{$equipment->equipment_id}}" label="{{$equipment->equipment_name}}" @if(!empty(old('exercise_equipment_id') && old('exercise_equipment_id') == $equipment->equipment_id)) selected @endif>
                                        {{$equipment->equipment_name}}
                                    </option>
                                    @endforeach
                                </select>
                                @error('exercise_equipment_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group @error('exercise_description') has-danger @enderror">
                                <label>Description</label>
                                <textarea class="form-control" placeholder="Enter a brief Description" rows="5" name="exercise_description">@if(!empty(old('exercise_description'))) {{old('exercise_description')}} @elseif(isset($data['result'])) {{$data['result']->exercise_description}}@else @endif</textarea>
                                @error('exercise_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer" >
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <div class="form-group col-md-12">
                                <button  type="submit" id="submit" class="btn btn-success">Add Exercise</button>
                                <button type="reset" id="clear" class="btn btn-secondary text-white" >Clear</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>


@endsection



@push('scripts')
<script>
$(document).ready(function () {


    $('#clear').click(function (e) {
    e.preventDefault();
    clear();
});
});

function clear(){
    $('.select2').val('');
    $('.select2').trigger('change');
    $('input[type=text]').val('');
    $('input[type=checkbox]').prop('checked',false);
    $('textarea').val('');
}
</script>
@endpush
