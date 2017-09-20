<?php
namespace Facebook\WebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Yandex\Allure\Adapter\Annotation\Title;
use Yandex\Allure\Adapter\Annotation\Severity;
use Yandex\Allure\Adapter\Model\SeverityLevel;

require_once('vendor/autoload.php');

/**
 * @Title("Human-readable test class title")
 */
class TestTask extends \PHPUnit_Framework_TestCase {

    protected $webDriver;
	protected $url = 'https://yandex.ru/video/';
	
	public function setUp()
    {
        $capabilities = DesiredCapabilities::chrome();
		$host = 'http://localhost:4444/wd/hub';
		$this->webDriver = RemoteWebDriver::create($host, $capabilities);
		$this->webDriver->manage()->window()->maximize();
    }

	public function tearDown()
    {
        $this->webDriver->quit();
    }
	
	/**
     * @Title("Human-readable test method title")
	 * @Severity(level = SeverityLevel::CRITICAL)
     */
    public function testCheckVideoPreviewPic()
    {
        $this->webDriver->get($this->url);
		// wait until the page is loaded
		$this->webDriver->wait()->until(
			WebDriverExpectedCondition::titleContains('Смотрите видео онлайн: сериалы, мультики, игры, клипы, фильмы на Яндексе')
		);
        // checking that page title contains correct words
        $this->assertContains(
			'Смотрите видео онлайн: сериалы, мультики, игры, клипы, фильмы на Яндексе', $this->webDriver->getTitle());
		// write 'ураган' in the search box
		$this->webDriver->findElement(WebDriverBy::cssSelector('.input__box-layout .input__control'))
			->sendKeys('ураган');
		// submit the form
		$this->webDriver->findElement(WebDriverBy::cssSelector('.search2__button .button_theme_websearch'))
			->click();
		// wait until page load finished
		$this->webDriver->wait(5, 100)->until(
			function () {
				$elements = $this->webDriver->findElements(WebDriverBy::cssSelector('.fade_progress_yes'));
				return count($elements) == 0;
			},
			'Error: loading request too long!'
		);	
		// TODO: select random preview
		$videoFrameDivCSS = WebDriverBy::cssSelector('div.serp-list .serp-item:nth-of-type(2) .thumb-image__shadow');
		$videoFrameDiv = $this->webDriver->findElement($videoFrameDivCSS);
		$this->webDriver->getMouse()->mouseMove( $videoFrameDiv->getCoordinates() );
		// Check that preview pic changed
		$this->webDriver->wait(5, 100)->until(
			function () {
				$videoFrameImgCSS = 'div.serp-list .serp-item:nth-of-type(2) .thumb-image__image[src*="https://avatars.mds.yandex.net/get-video_frame/"]';
				$videoFrameImg = $this->webDriver->findElements(WebDriverBy::cssSelector($videoFrameImgCSS));
				return count($videoFrameImg) == 1;
			},
			'Error: no preview pics in set time period!'
		);
    }    
}
?>