@extends('layouts.default')

@push('styles')

@endpush

@section('title','Workout Plan')
@section('sub_title','Workout Exercise')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-body">
                <div>
                    <h6 class="card-title mb-1">Workout Exercise</h6>
                    <div class="row">
                        <div class="col-md-6">

                            <form action="{{route('createExercise')}}" method="POST" class="login-form" id="create_exercise_form">
                                @csrf
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
                                    <textarea class="form-control" placeholder="Enter a brief Description"
                                        name="exercise_description" @if(!empty(old('exercise_description'))) value="{{old('exercise_description')}}" @else value="" @endif></textarea>
                                    @error('exercise_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>



                                <div class="form-group">
                                    <button type="submit" id="submit" class="btn btn-primary mt-3 mb-0">Add Exercise</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


@endsection



@push('scripts')
<script>
$(document).ready(function () {


$(document).ready(function () {

});

});
</script>
@endpush
