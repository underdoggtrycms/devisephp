@extends('devise::admin.layouts.modal')

@section('content')
    <ul class="js-tab-links">
        <li class="dvs-active" data-target="#dvs-tab-1">Create New</li>
        <li data-target="#dvs-tab-2">Pick from Existing</li>
        <li data-target="#dvs-tab-3">Pick from Vars Found in Template</li>
    </ul>

    <div class="dvs-admin-form-horizontal">
        <?= Form::open(array('method' => 'POST', 'route' => array('dvs-templates-var-store', $params['templatePath']))) ?>
            <div class="js-tab-content" id="dvs-tab-1">
                <h4>Create New Variable</h4>
                <div class="dvs-form-group">
                    <?= Form::text('var_name', null, ['placeholder' => 'Variable Name']) ?>
                    <?= Form::text('class_path', null, ['placeholder' => 'Class Path']) ?>
                    <?= Form::text('method_name', null, ['placeholder' => 'Method Name']) ?>
                    <button type="submit" class="dvs-button dvs-button-secondary mt sp30">ADD VARIABLE</button>
                </div>
            </div>

            <div class="js-tab-content dvs-hidden" id="dvs-tab-2">
                <h4>Pick From Existing Variables List</h4>
                <div class="dvs-form-group">
                    <?= Form::select('copy_var', ['Existing Variables'] + $usedVariables) ?>
                </div>
                <button type="submit" class="dvs-button dvs-button-secondary mt sp30">ADD VARIABLE</button>
            </div>
        <?=Form::close() ?>

        <?= Form::open(array('method' => 'POST', 'route' => array('dvs-templates-var-store', $params['templatePath']))) ?>
            <div class="js-tab-content dvs-hidden" id="dvs-tab-3">
                <h4>Pick From List of Variables Found in Template</h4>
                <div class="dvs-form-group">
                    @if(isset($template['newVars']) && count($template['newVars']))

                        <select name="var_name">
                            @foreach($template['newVars'] as $newVarName => $newVar)
                                <option value="<?= $newVarName ?>"><?= $newVarName ?></option>
                            @endforeach
                        </select>
                        <?= Form::text('class_path', null, ['placeholder' => 'Class Path']) ?>
                        <?= Form::text('method_name', null, ['placeholder' => 'Method Name']) ?>

                    @else

                        <p>No un-registered variables found in template.</p>

                    @endif
                </div>
                <button type="submit" class="dvs-button dvs-button-secondary mt sp30">ADD VARIABLE</button>
            </div>
        <?=Form::close() ?>
    </div>
@stop