- Create Model and Api:
    + Create Data Interface for Model (Api\Data\StudentInterface.php)
    + Create Data Interface for SearchResult (Api\Data\StudentSearchResultsInterface.php)
    + Create Repository Interface (Api\StudentRepositoryInterface.php)
    + Create Model Class (Model\Student.php)
    + Create Resource Model Class (Model\ResourceModel\Student.php)
    + Create Collection Class (Model\ResourceModel\Student\Collection.php)
    + Create Repository Class (Model\StudentRepository.php)
    + Create SearchResult Class (Model\StudentSearchResults.php)
    + Define Preference Mapping (etc\di.xml)

- Create new admin page:
    + create \etc\adminhtml\routes.xml (router id="admin")
    + create \etc\adminhtml\menu.xml
    + create \Controller\Adminhtml\Listing\Index.php
    + create view\adminhtml\layout\student_listing_index.xml (page tag not contain layout="" attribute)
    + create Block\... and view\adminhtml\templates\... (if need)

- Create UiComponent
    1. Listing
        + create \view\adminhtml\ui_component\student_listing.xml
        + create \Ui\Dataprovider\StudentDataProvider.php (for 'dataProvider' in student_listing.xml)
        + create \Ui\Component\Listing\Columns\StudentActions (for 'actionsColumn' in student_listing.xml)
        + create controllers for actionsColumn
    2. Form

