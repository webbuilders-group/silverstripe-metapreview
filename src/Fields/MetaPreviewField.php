<?php

namespace rsmclaren\MetaPreview\Fields;

use SilverStripe\Forms\DatalessField;
use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\View\Requirements;
use SilverStripe\ORM\DataList;

/**
 * an extension to the @see DatalessField class
 * @package fields
 */
class MetaPreviewField extends DatalessField {
    
    protected $id;
    
    protected $page;
    
    /**
	 * @param string $name
	 * @param string $title
	 * @param Form $form
	 */
	public function __construct($name, $title, $id) {	   
        
		if($id){
		    $this->id = $id;
		}
		
		//css requirements
	    Requirements::css('metapreview/css/metapreviewfield.css');	    	   
		
		parent::__construct($name, $title);
	}
	
	/**
	 * get the current siteconfig
	 * @return {SiteConfig}
	 */
	public function getSiteConfig(){
	    return SiteConfig::current_site_config();
	}
	
	/**
	 * return the current page
	 * @return {DataList}
	 */
	public function getPage(){	    
	    if($this->page == null){
	        return $this->page = DataList::create('Page')->byID($this->id);	    	    
	    } else {
	        return $this->page;
	    }
	}
	
	/**
	 * return the appropiate MetaTitle
	 * @return {String}
	 */
	public function getMetaTitle(){
	    if($page = $this->getPage()){
            if($page->MetaTitle){
                return $page->MetaTitle;
            }elseif($page->Title){
                return $page->Title;
            }          
        }	    	     	
	}
	
	/**
	 * return the absoluteLink for the current page
	 * @return {String}
	 */
	public function getPreviewLink(){
	    if($page = $this->getPage()){
            if($page->AbsoluteLink()){
                return $page->AbsoluteLink();
            }	
        }	    	      
	}
	
	/**
	 * return the appropiate MetaDescription
	 * @return {String}
	 */
	public function getMetaDescription(){
	    if($page = $this->getPage()){
            if($page->MetaDescription){
                return $page->MetaDescription;
            } else {
                return strip_tags($page->Content);
            }
        }	    	   
	}

}

?>
