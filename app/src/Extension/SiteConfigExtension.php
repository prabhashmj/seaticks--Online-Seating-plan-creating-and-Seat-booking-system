<?php
/**
 * Created by PhpStorm.
 * User: Prabhash
 * Date: 7/13/2020
 * Time: 5:44 PM
 */

use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\TextField;

class SiteConfigExtension extends \SilverStripe\ORM\DataExtension
{
    private static $db = [
        'PaypalUser' => 'Varchar',
        'PaypalPass' => 'Varchar',
        'Signature' => 'Varchar',
        'DefaultHomeContent'=>'HTMLText',
    ];

    private static $many_many = [
        'FooterLinks' => \Sheadawson\Linkable\Models\Link::class,
    ];

    public function updateCMSFields(\SilverStripe\Forms\FieldList $fields)
    {

        parent::updateCMSFields($fields);
        $fields->addFieldsToTab('Root.Footer', [
            GridField::create('FooterLinks', 'FooterLinks', $this->owner->FooterLinks(), \SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor::create())
        ]);
        $fields->addFieldsToTab('Root.DefaultContents', [
            HTMLEditorField::create('DefaultHomeContent'),
        ]);
        $fields->addFieldsToTab('Root.Payment', [
           TextField::create('PaypalUser'),
           TextField::create('PaypalPass'),
           TextField::create('Signature')
        ]);
        // TODO: Change the autogenerated stub
    }
}