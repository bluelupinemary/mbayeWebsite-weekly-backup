<div class="box-body">
    <div class="form-group">
        {{ Form::label('Profession_name', 'Profession Name', ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('profession_name', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.blogtags.title'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->
</div>