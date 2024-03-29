<?php

namespace {

    use SilverStripe\AssetAdmin\Forms\UploadField;
    use SilverStripe\Assets\Image;
    use SilverStripe\CMS\Model\SiteTree;
    use SilverStripe\Security\Security;
    use SilverStripe\Subsites\State\SubsiteState;
    use SilverStripe\Control\Controller;
    use SilverStripe\Control\Director;

    class Page extends SiteTree
    {
        const DOMAIN    = "seaticks.pramesh";
        private static $db = [

        ];
        


        private static $many_many = [
            'Slides' => Image::class
        ];

        private static $owns = [
            'Slides'
        ];

        public function getCMSFields()
        {
            $fields = parent::getCMSFields();
            $fields->addFieldsToTab('Root.Slides', [
                UploadField::create('Slides', 'Hero Slides')
            ]);
            return $fields;
            // TODO: Change the autogenerated stub
        }

        public function getAllEvents()
        {
            return Controller::curr()->getAllEvents();
        }

        public function getAllEventsWithSubsites()
        {
            return Controller::curr()->getAllEventsWithSubsites();
        }

        public function getControllerName(){
            return PageController::class;
        }

        public function getEvents(){
            return Event::get();
        }

        public function getBookingLink(){
            $link = Controller::join_links(
                $this->Link(),
                'booking/book'
            );
            return strtok($link, '?');
        }

        public function canCreate($member = null, $context = array())
        {
            if ($this->SubsiteID == 0) {
                return true;
            }

            return false;
        }

        public function canDelete($member = null)
        {
            if ($this->SubsiteID == 0) {
                return true;
            }

            return false;
        }

        public function getVirtualPageLink(){
            if($vPage = VirtualImagePage::get()->filter('SubsiteID', $this->SubsiteID)->first()){
                $base = Director::absoluteBaseURL();

                return $base.ltrim(strtok( $vPage->Link('sphere'), '?'), '/');

            }
        }

        public function getCategoryLink(){
            $link = $this->Link();
            $base = Director::absoluteBaseURL();
            return $base.ltrim(strtok($link, '?'), '/');
        }

        public function getAllCategories(){
            return EventCategory::get();
        }

        public function getLoggedUser(){
            return Security::getCurrentUser();
        }

    }
}
