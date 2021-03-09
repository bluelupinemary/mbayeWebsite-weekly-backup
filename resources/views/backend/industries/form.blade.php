<div class="box-body">
    <div class="form-group">
        {{ Form::label('Industry_name', 'Industry Name', ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('industry_name', null, ['class' => 'form-control box-size', 'placeholder' => 'Industry Name', 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->
</div>