<?php namespace Devise\Pages\Interrupter;

class DeviseBladeCompilerTest extends \DeviseTestCase
{
	public function test_it_can_compile_view1()
	{
		// given
		$viewOpener = $this->getMock('Devise\Pages\Interrupter\ViewOpener');
		$viewOpener->method('open')->willReturn($this->fixture('devise-views.view2'));
		$compiler = $this->getMock('Devise\Pages\Interrupter\ExtendedBladeCompiler');

		$factory = new BlockFactory($viewOpener);
		$compiler = new DeviseBladeCompiler($factory);

		// when
		$view = $compiler->compile($this->fixture('devise-views.view1'), $compiler);

		// then
		assertContains('<span style="display:none;" data-dvs-placeholder-keyname1-id="keyname1"></span>', $view);
		assertContains('<span style="display:none;" data-dvs-placeholder-keyname2-id="keyname2"></span>', $view);
		assertContains('<span style="display:none;" data-dvs-placeholder-keyname3-id="keyname3"></span>', $view);
		assertContains("<?php" . PHP_EOL .
				"App::make('dvsPageData')->addCollection('col', 'keyname5', 'type', 'humanName', 'groupName', 'categoryName', null);" . PHP_EOL .
				"App::make('dvsPageData')->addBinding('keyname1', 'type', 'humanName', null, null, null);" . PHP_EOL .
				"App::make('dvsPageData')->addBinding('keyname2', 'type', 'humanName', null, null, null);" . PHP_EOL .
				"App::make('dvsPageData')->addBinding('keyname3', 'type', 'humanName', null, null, null);" . PHP_EOL .
				"App::make('dvsPageData')->addBinding('keyname4', 'type', 'humanName', null, null, null);" . PHP_EOL . "?>", $view);
		assertContains('<div data-dvs-col-keyname5-id="keyname5"></div>', $view);
		assertContains('<div data-dvs-keyname4-id="keyname4"></div>', $view);
	}

	public function test_it_can_compile_view4_with_a_devise_model()
	{
		// given
		$viewOpener = $this->getMock('Devise\Pages\Interrupter\ViewOpener');
		$compiler = $this->getMock('Devise\Pages\Interrupter\ExtendedBladeCompiler');
		$factory = new BlockFactory($viewOpener);
		$compiler = new DeviseBladeCompiler($factory);

		// when
		$view = $compiler->compile($this->fixture('devise-views.view4'), $compiler);

		// then
		assertContains('<div data-dvs-cid-', $view);
	}

	public function test_it_can_compile_view5_with_a_model_creator()
	{
		// given
		$viewOpener = $this->getMock('Devise\Pages\Interrupter\ViewOpener');
		$compiler = $this->getMock('Devise\Pages\Interrupter\ExtendedBladeCompiler');

		$factory = new BlockFactory($viewOpener);
		$compiler = new DeviseBladeCompiler($factory);

		// when
		$view = $compiler->compile($this->fixture('devise-views.view5'), $compiler);

		// then
		assertContains('<div data-dvs-cid-821377269d7d99cfa97e5d5d4ff41150e29693df', $view);
	}

	public function test_it_can_handle_view6_with_real_php_tags()
	{

	}
}