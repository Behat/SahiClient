<?php

namespace Behat\SahiClient;

use Behat\SahiClient\Accessor;

/*
 * This file is part of the Behat\SahiClient.
 * (c) 2010 Konstantin Kudryashov <ever.zet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Browser Accessor API methods.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
class Browser
{
    /**
     * Sahi Driver instance.
     *
     * @var     Driver
     */
    protected $con;

    /**
     * Initialize Accessor.
     *
     * @param   Connection  $connection Sahi Connection
     */
    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    /**
     * Set Sahi Connection.
     *
     * @param   Connection  $con    Sahi Connection
     */
    public function setConnection(Connection $con)
    {
        $this->con = $con;
    }

    /**
     * Return Accessor active connection instance.
     *
     * @return  Connection
     */
    public function getConnection()
    {
        return $this->con;
    }

    /**
     * Navigates to the given URL.
     *
     * @param   string  $url    URL
     * @param   boolean $reload force reload
     */
    public function navigateTo($url, $reload = null)
    {
        $arguments = array('"' . quoted_printable_encode($url) . '"');

        if (null !== $reload) {
            $arguments[] = (bool) $reload ? 'true' : 'false';
        }

        $this->con->executeStep(sprintf('_sahi._navigateTo(%s)', implode(', ', $arguments)));
    }

    /**
     * Set speed of execution (in milli seconds).
     *
     * @param   integer $speed  speed in milli seconds
     */
    public function setSpeed($speed)
    {
        $this->con->executeCommand('setSpeed', array('speed' => $speed));
    }

    /**
     * Find element on page by specified class & tag.
     *
     * @param   string  $class      tag class
     * @param   string  $tag        tag name
     * @param   array   $relations  tag relations (near, in, under)
     *
     * @return  ByClassNameAccessor
     */
    public function findByClassName($class, $tag, array $relations = array())
    {
        return new Accessor\ByClassNameAccessor($class, $tag, $relations, $this->con);
    }

    /**
     * Find element by id.
     *
     * @param   string  $id element id
     *
     * @return  ByIdAccessor
     */
    public function findById($id)
    {
        return new Accessor\ByIdAccessor($id, $this->con);
    }

    /**
     * Find element by it's text.
     *
     * @param   string  $text   tag text
     * @param   string  $tag    tag name
     *
     * @return  ByTextAccessor
     */
    public function findByText($text, $tag)
    {
        return new Accessor\ByTextAccessor($text, $tag, $this->con);
    }

    /**
     * Find element by it's text.
     *
     * @param   string  $xpath      XPath expression
     * @param   array   $relations  tag relations (near, in, under)
     *
     * @return  ByXPathAccessor
     */
    public function findByXPath($xpath, array $relations = array())
    {
        return new Accessor\ByXPathAccessor($xpath, $relations, $this->con);
    }

    /**
     * Find DIV element.
     *
     * @param   string  $id         element identifier
     * @param   string  $tag        tag name
     * @param   array   $relations  tag relations (near, in, under)
     *
     * @return  DivAccessor
     */
    public function findDiv($id = null, array $relations = array())
    {
        return new Accessor\DivAccessor($id, $relations, $this->con);
    }

    /**
     * Find element by it's JS DOM representation.
     *
     * @param   string  $dom    DOM expression
     *
     * @return  DomAccessor
     */
    public function findDom($dom)
    {
        return new Accessor\DomAccessor($dom, $this->con);
    }

    /**
     * Find heading element (h1, h2, h3)
     *
     * @param   integer $level      heading level 1 for h1, 2 for h2, ...
     * @param   string  $id         element identifier
     * @param   array   $relations  tag relations (near, in, under)
     *
     * @return  HeadingAccessor
     */
    public function findHeader($level = 1, $id = null, array $relations = array())
    {
        return new Accessor\HeadingAccessor($level, $id, $relations, $this->con);
    }

    /**
     * Find img element.
     *
     * @param   string  $id         element identifier
     * @param   array   $relations  tag relations (near, in, under)
     *
     * @return  ImageAccessor
     */
    public function findImage($id = null, array $relations = array())
    {
        return new Accessor\ImageAccessor($id, $relations, $this->con);
    }

    /**
     * Find label element.
     *
     * @param   string  $id         element identifier
     * @param   array   $relations  tag relations (near, in, under)
     *
     * @return  LabelAccessor
     */
    public function findLabel($id = null, array $relations = array())
    {
        return new Accessor\LabelAccessor($id, $relations, $this->con);
    }

    /**
     * Find a element.
     *
     * @param   string  $id         element identifier
     * @param   array   $relations  tag relations (near, in, under)
     *
     * @return  LinkAccessor
     */
    public function findLink($id = null, array $relations = array())
    {
        return new Accessor\LinkAccessor($id, $relations, $this->con);
    }

    /**
     * Find li element.
     *
     * @param   string  $id         element identifier
     * @param   array   $relations  tag relations (near, in, under)
     *
     * @return  ListItemAccessor
     */
    public function findListItem($id = null, array $relations = array())
    {
        return new Accessor\ListItemAccessor($id, $relations, $this->con);
    }

    /**
     * Find span element.
     *
     * @param   string  $id         element identifier
     * @param   array   $relations  tag relations (near, in, under)
     *
     * @return  SpanAccessor
     */
    public function findSpan($id = null, array $relations = array())
    {
        return new Accessor\SpanAccessor($id, $relations, $this->con);
    }

    /**
     * Find button element.
     *
     * @param   string  $id         element identifier
     * @param   array   $relations  tag relations (near, in, under)
     *
     * @return  ButtonAccessor
     */
    public function findButton($id = null, array $relations = array())
    {
        return new Accessor\Form\ButtonAccessor($id, $relations, $this->con);
    }

    /**
     * Find checkbox element.
     *
     * @param   string  $id         element identifier
     * @param   array   $relations  tag relations (near, in, under)
     *
     * @return  CheckboxAccessor
     */
    public function findCheckbox($id = null, array $relations = array())
    {
        return new Accessor\Form\CheckboxAccessor($id, $relations, $this->con);
    }

    /**
     * Find file element.
     *
     * @param   string  $id         element identifier
     * @param   array   $relations  tag relations (near, in, under)
     *
     * @return  FileAccessor
     */
    public function findFile($id = null, array $relations = array())
    {
        return new Accessor\Form\FileAccessor($id, $relations, $this->con);
    }

    /**
     * Find hidden element.
     *
     * @param   string  $id         element identifier
     * @param   array   $relations  tag relations (near, in, under)
     *
     * @return  HiddenAccessor
     */
    public function findHidden($id = null, array $relations = array())
    {
        return new Accessor\Form\HiddenAccessor($id, $relations, $this->con);
    }

    /**
     * Find image submit button element.
     *
     * @param   string  $id         element identifier
     * @param   array   $relations  tag relations (near, in, under)
     *
     * @return  ImageSubmitButtonAccessor
     */
    public function findImageSubmitButton($id = null, array $relations = array())
    {
        return new Accessor\Form\ImageSubmitButtonAccessor($id, $relations, $this->con);
    }

    /**
     * Find select option element.
     *
     * @param   string  $id         element identifier
     * @param   array   $relations  tag relations (near, in, under)
     *
     * @return  OptionAccessor
     */
    public function findOption($id = null, array $relations = array())
    {
        return new Accessor\Form\OptionAccessor($id, $relations, $this->con);
    }

    /**
     * Find password element.
     *
     * @param   string  $id         element identifier
     * @param   array   $relations  tag relations (near, in, under)
     *
     * @return  PasswordAccessor
     */
    public function findPassword($id = null, array $relations = array())
    {
        return new Accessor\Form\PasswordAccessor($id, $relations, $this->con);
    }

    /**
     * Find radio button element.
     *
     * @param   string  $id         element identifier
     * @param   array   $relations  tag relations (near, in, under)
     *
     * @return  RadioAccessor
     */
    public function findRadio($id = null, array $relations = array())
    {
        return new Accessor\Form\RadioAccessor($id, $relations, $this->con);
    }

    /**
     * Find reset button element.
     *
     * @param   string  $id         element identifier
     * @param   array   $relations  tag relations (near, in, under)
     *
     * @return  ResetAccessor
     */
    public function findReset($id = null, array $relations = array())
    {
        return new Accessor\Form\ResetAccessor($id, $relations, $this->con);
    }

    /**
     * Find select element.
     *
     * @param   string  $id         element identifier
     * @param   array   $relations  tag relations (near, in, under)
     *
     * @return  SelectAccessor
     */
    public function findSelect($id = null, array $relations = array())
    {
        return new Accessor\Form\SelectAccessor($id, $relations, $this->con);
    }

    /**
     * Find submit element.
     *
     * @param   string  $id         element identifier
     * @param   array   $relations  tag relations (near, in, under)
     *
     * @return  SubmitAccessor
     */
    public function findSubmit($id = null, array $relations = array())
    {
        return new Accessor\Form\SubmitAccessor($id, $relations, $this->con);
    }

    /**
     * Find textarea element.
     *
     * @param   string  $id         element identifier
     * @param   array   $relations  tag relations (near, in, under)
     *
     * @return  TextareaAccessor
     */
    public function findTextarea($id = null, array $relations = array())
    {
        return new Accessor\Form\TextareaAccessor($id, $relations, $this->con);
    }

    /**
     * Find textbox element.
     *
     * @param   string  $id         element identifier
     * @param   array   $relations  tag relations (near, in, under)
     *
     * @return  TextboxAccessor
     */
    public function findTextbox($id = null, array $relations = array())
    {
        return new Accessor\Form\TextboxAccessor($id, $relations, $this->con);
    }

    /**
     * Find table cell element.
     *
     * @param   string|array    $id         simple element identifier or array of (Table, rowText, colText)
     * @param   array           $relations  tag relations (near, in, under)
     *
     * @return  CellAccessor
     */
    public function findCell($id = null, array $relations = array())
    {
        return new Accessor\Table\CellAccessor($id, $relations, $this->con);
    }

    /**
     * Find table row element.
     *
     * @param   string  $id         element identifier
     * @param   array   $relations  tag relations (near, in, under)
     *
     * @return  RowAccessor
     */
    public function findRow($id = null, array $relations = array())
    {
        return new Accessor\Table\RowAccessor($id, $relations, $this->con);
    }

    /**
     * Find table header element.
     *
     * @param   string  $id         element identifier
     * @param   array   $relations  tag relations (near, in, under)
     *
     * @return  TableHeaderAccessor
     */
    public function findTableHeader($id = null, array $relations = array())
    {
        return new Accessor\Table\TableHeaderAccessor($id, $relations, $this->con);
    }

    /**
     * Find table element.
     *
     * @param   string  $id         element identifier
     * @param   array   $relations  tag relations (near, in, under)
     *
     * @return  TableAccessor
     */
    public function findTable($id = null, array $relations = array())
    {
        return new Accessor\Table\TableAccessor($id, $relations, $this->con);
    }
}
