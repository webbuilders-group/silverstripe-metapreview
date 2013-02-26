<?php 
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
	    $page = $this->getPage();
	    
	    if($page->MetaTitle){
	        return $page->MetaTitle;
	    }else {
	        return $page->Title;
	    }
	}
	
	/**
	 * return the absoluteLink for the current page
	 * @return {String}
	 */
	public function getPreviewLink(){
	    $page = $this->getPage();
	    
	    return $page->AbsoluteLink();
	}
	
	/**
	 * return the appropiate MetaDescription
	 * @return {String}
	 */
	public function getMetaDescription(){
	    $page = $this->getPage();
	    
	    if($page->MetaDescription){
	        return $page->MetaDescription;
	    } else {
	        return $page->Content;
	    }
	}

}

?>