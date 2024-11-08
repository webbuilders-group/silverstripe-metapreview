<?php
namespace WebbuildersGroup\MetaPreview\Extensions;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldList;
use WebbuildersGroup\MetaPreview\Fields\MetaPreviewField;

class MetaPreviewPageExtension extends Extension
{
    /**
     * updates the fields used in the CMS
     * @param {FieldList}
     */
    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldToTab('Root.Main', new MetaPreviewField('MetaPreview',_t('METAPREVIEWPAGEEXTENSION.GOOGLEPREVIEW', '_Google Search Results Preview (save your page to view changes)'), $this->owner->ID), 'ExtraMeta');
    }
}
