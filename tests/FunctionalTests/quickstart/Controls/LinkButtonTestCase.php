<?php

class QuickstartLinkButtonTestCase extends PradoGenericSelenium2Test
{
	function test ()
	{
		$this->url("../../demos/quickstart/index.php?page=Controls.Samples.TLinkButton.Home&amp;notheme=true&amp;lang=en");

		$this->assertEquals("PRADO QuickStart Sample", $this->title());

		// regular buttons
		$this->byLinkText("link button")->click();
		$this->byXPath("//a[contains(text(),'body content')]")->click();

		// a click button
		$this->byLinkText("click me")->click();
		$this->byLinkText("I'm clicked")->click();

		// a command button
		$this->byLinkText("click me")->click();
		$this->byXPath("//a[contains(text(),'Name: test, Param: value')]")->click();

		// a button causing validation
		$this->assertNotVisible('ctl0_body_ctl4');
		$this->byLinkText("submit")->click();
//		$this->pause(1000);
		$this->assertVisible('ctl0_body_ctl4');
		$this->type("ctl0\$body\$TextBox", "test");
		$this->byLinkText("submit")->click();
		$this->assertNotVisible('ctl0_body_ctl4');
	}
}
