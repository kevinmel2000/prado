<?php
/**
 * TLabel class file.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.xisc.com/
 * @copyright Copyright &copy; 2004-2005, Qiang Xue
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 * @version $Revision: $  $Date: $
 * @package System.Web.UI.WebControls
 */

/**
 * TLabel class
 *
 * TLabel represents a label control that displays text on a Web pagge.
 * Use <b>Text</b> property to set the text to be displayed.
 * TLabel will render the contents enclosed within its component tag
 * if <b>Text</b> is empty.
 * To use TLabel as a form label, associate it with a control by setting the
 * <b>AssociateControlID</b> property. The associated control must be locatable
 * within the label's naming container.
 *
 * Note, <b>Text</b> will NOT be encoded for rendering.
 * Make usre it does not contain dangerous characters that you want to avoid.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @version $Revision: $  $Date: $
 * @package System.Web.UI.WebControls
 * @since 3.0
 */
class TLabel extends TWebControl
{
	/**
	 * @return string tag name of the label, returns 'label' if there is an associated control, 'span' otherwise.
	 */
	protected function getTagName()
	{
		return ($this->getAssociatedControlID()==='')?'span':'label';
	}

	/**
	 * Adds attributes to renderer.
	 * @param THtmlTextWriter the renderer
	 * @throws TInvalidDataValueException if associated control cannot be found using the ID
	 */
	protected function addAttributesToRender($writer)
	{
		if(($aid=$this->getAssociatedControlID())!=='')
		{
			if($control=$this->findControl($aid))
				$writer->addAttribute('for',$control->getClientID());
			else
				throw new TInvalidDataValueException('control_not_found',$aid);
		}
		parent::addAttributesToRender($writer);
	}

	/**
	 * Renders the body content of the label.
	 * @param THtmlTextWriter the renderer
	 */
	protected function renderContents($writer)
	{
		if(($text=$this->getText())==='')
			parent::renderContents($writer);
		else
			$writer->write($text);
	}

	/**
	 * @return string the text value of the label
	 */
	public function getText()
	{
		return $this->getViewState('Text','');
	}

	/**
	 * @param string the text value of the label
	 */
	public function setText($value)
	{
		$this->setViewState('Text',$value,'');
	}

	/**
	 * @return string the associated control ID
	 */
	public function getAssociatedControlID()
	{
		return $this->getViewState('AssociatedControlID','');
	}

	/**
	 * Sets the ID of the control that the label is associated with.
	 * The control must be locatable via {@link TControl::findControl} using the ID.
	 * @param string the associated control ID
	 */
	public function setAssociatedControlID($value)
	{
		$this->setViewState('AssociatedControlID',$value,'');
	}
}

?>