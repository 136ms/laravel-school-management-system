<!-- Subject Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('subject_name', 'Subject name:') !!}
    {!! Form::text('subject_name', null, ['class' => 'form-control', 'required', 'maxlength' => 255]) !!}
</div>
