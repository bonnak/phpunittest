<?php 

use App\Tasks\FetchTask;

Class FetchTest extends TestCase
{
	public function setUp()
	{
		$this->fetch = new FetchTask;
	}

	public function testStoresListOfAssets()
	{
		$this->assertClassHasStaticAttribute('path', 'App\Tasks\FetchTask');
		$this->assertArrayHasKey('jquery', FetchTask::$path);
	}

	/**
	* @expectedException InvalidArgumentException
	*/
	public function testThrowsExceptionIfNoAssetIsProvided()
	{
		$this->fetch->run();
	}

	public function testDownloadsAssetIfFound()
	{
		$this->fetch->run(['jquery']);
		$this->assertFileExists('public/js/vendor/jquery.js');
	}

}