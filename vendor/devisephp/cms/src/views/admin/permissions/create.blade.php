@extends('devise::admin.layouts.master')

@section('title')
    <div id="dvs-admin-title">
        <h1><span class="ion-lock-combination"></span> New Permission</h1>
    </div>
@stop

@section('subnavigation')
    <div id="dvs-admin-actions">
        <?= link_to(URL::route('dvs-permissions'), 'All Permissions', array('class'=>'dvs-button dvs-button-secondary')) ?>
    </div>
@stop

@section('main')
    <div class="dvs-admin-form-horizontal">
        <?= Form::open(array('method' => 'POST', 'route' => array('dvs-permissions-store'))) ?>
            <div class="dvs-form-group">
                <?= Form::label('Condition') ?>
                <?= Form::text('permission_name', null, array('id'=>'permission-name')) ?>
                <span data-dvs-document="condition" class="dvs-document-button"></span>
            </div>

            <div class="dvs-form-group">
                <?= Form::label('Redirect Route or Action') ?>
                <?= Form::text('redirect', null, array('class' => 'short')) ?>
                <span data-dvs-document="redirect-route-or-action" class="dvs-document-button"></span>
            </div>

            <div class="dvs-form-group">
                <?= Form::label('Redirect Type') ?>
                <?= Form::select('redirect_type', ['route'=>'Route','action'=>'Action'], null, array('class' => 'short')) ?>
                <span data-dvs-document="redirect-type" class="dvs-document-button"></span>
            </div>

            <div class="dvs-form-group">
                <?= Form::label('Redirect Message') ?>
                <?= Form::text('redirect_message', null, array('class' => 'short')) ?>
                <span data-dvs-document="redirect-message" class="dvs-document-button"></span>
            </div>

            <div id="dvs-permissions">
                <div class="dvs-form-group">
                    @include('devise::admin.permissions._group')
                </div>
            </div>

            <div class="dvs-form-group">
                <div class="dvs-submit-margin">&nbsp;</div>
                    <?= Form::submit('Create Permission', array('class' => 'dvs-button')) ?>
                    <?= Form::button('Reset Form', array('class' => 'dvs-button', 'id' => 'dvs-reset-form')) ?>
                </div>
            </div>
        <?= Form::close() ?>
    </div>
@stop

@section('js')
    <script>
        var ruleParamMap = <?= json_encode($ruleParamMap) ?>;
        var emptyParamInput = '<?= Form::text('', null, array('class' => 'rule-param', 'placeholder' => 'Parameter')) ?>';
        var emptyGroup = '<?= HTML::getHtmlForJsVar('devise::admin.permissions._group', array('availableRulesList'=> $availableRulesList)) ?>';
        var emptyRule = '<?= HTML::getHtmlForJsVar('devise::admin.permissions._rule', array('availableRulesList'=> $availableRulesList)) ?>';
        var operatorHtml = '<?= HTML::getHtmlForJsVar('devise::admin.permissions._operator') ?>';
        devise.require(['app/admin/permissions'], function(obj) {
            obj.initialize();
        });
    </script>
@stop

