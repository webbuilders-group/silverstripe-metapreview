<?php
namespace WebbuildersGroup\MetaPreview\Fields;

use SilverStripe\Forms\DatalessField;
use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\View\Requirements;
use SilverStripe\ORM\DataList;

class MetaPreviewField extends DatalessField
{
    protected $id;
    protected $page;

    /**
     * Constructor
	 * @param string $name
	 * @param string $title
	 * @param int $id
	 */
	public function __construct($name, $title, $id)
    {	   
		if ($id) {
		    $this->id = $id;
		}

		//css requirements
	    Requirements::css('webbuilders-group/silverstripe-metapreview:css/metapreviewfield.css');	    	   

		parent::__construct($name, $title);
	}

	/**
	 * Get the current SiteConfig
	 * @return \SilverStripe\SiteConfig\SiteConfig
	 */
	public function getSiteConfig()
    {
	    return SiteConfig::current_site_config();
	}

	/**
	 * Return the current page
	 * @return \SilverStripe\CMS\Model\SiteTree
	 */
	public function getPage()
    {	    
	    if ($this->page == null) {
	        return $this->page = DataList::create('Page')->byID($this->id);	    	    
	    } else {
	        return $this->page;
	    }
	}

	/**
	 * return the appropiate MetaTitle
	 * @return string
	 */
	public function getMetaTitle()
    {
	    if ($page = $this->getPage()) {
            if ($page->MetaTitle) {
                return $page->MetaTitle;
            } else if ($page->Title) {
                return $page->Title;
            }          
        }	    	     	
	}
	
	/**
	 * Return the absoluteLink for the current page
	 * @return string
	 */
	public function getPreviewLink()
    {
	    if ($page = $this->getPage()) {
            if ($page->AbsoluteLink()) {
                return $page->AbsoluteLink();
            }	
        }	    	      
	}
	
	/**
	 * return the appropiate MetaDescription
	 * @return string
	 */
	public function getMetaDescription()
    {
	    if ($page = $this->getPage()) {
            if ($page->MetaDescription) {
                return $page->MetaDescription;
            } else if ($page->Content) {
                return strip_tags($page->Content);
            }
        }	    	   
	}
}
