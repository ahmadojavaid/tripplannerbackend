<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Form;

class FormServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   *
   * @return void
   */
  public function register()
  {
    //
  }

  /**
   * Bootstrap services.
   *
   * @return void
   */
  public function boot()
  {

    Form::component('fieldText', 'components.admin.form.field', ['name', 'value' => null, 'placeholder' => null, 'attributes' => []]);
    Form::component('fieldEmail', 'components.admin.form.email', ['name', 'value' => null, 'placeholder' => null, 'attributes' => []]);
    Form::component('fieldSelect', 'components.admin.form.select', ['name', 'data' => [], 'value' => null, 'placeholder' => null, 'attributes' => []]);
    Form::component('fieldSelect2', 'components.admin.form.select2', ['name', 'data' => [], 'value' => null, 'placeholder' => null, 'attributes' => [], 'label' => null, 'tag' => false]);
    Form::component('fieldTextarea', 'components.admin.form.textarea', ['name', 'value' => null, 'placeholder' => null, 'attributes' => []]);
    Form::component('fieldTextEditor', 'components.admin.form.text_editor', ['name', 'value' => null, 'placeholder' => null, 'attributes' => []]);
    Form::component('fieldFile', 'components.admin.form.file', ['name', 'value' => null, 'label' => null, 'attributes' => []]);
    Form::component('fieldPassword', 'components.admin.form.password', ['name', 'placeholder' => null, 'attributes' => []]);
    Form::component('fieldCheckbox', 'components.admin.form.checkbox', ['name', 'value' => null, 'checked' => false, 'label' => '', 'attributes' => []]);
    Form::component('customSelect', 'components.admin.form.custom_select', ['name', 'options' => []]);
    Form::component('customField', 'components.admin.form.custom_field', ['name', 'options' => []]);
  }
}
