- Create Model and Api:
    + Create Data Interface for Model (Api\Data\StudentInterface.php)
    + Create Data Interface for SearchResult (Api\Data\StudentSearchResultsInterface.php)
    + Create Repository Interface (Api\StudentRepositoryInterface.php)
    + Create Model Class (Model\Student.php)
    + Create Resource Model Class (Model\ResourceModel\Student.php)
    + Create Collection Class (Model\ResourceModel\Student\Collection.php)
    + Create Repository Class (Model\StudentRepository.php)
    + Create SearchResult Class (Model\StudentSearchResults.php)
    + Define Preference Mapping & collectionProcessor (etc\di.xml)

- Create new admin page:
    + create \etc\adminhtml\routes.xml (router id="admin")
    + create \etc\adminhtml\menu.xml
    + create \Controller\Adminhtml\Listing\Index.php
    + create view\adminhtml\layout\student_listing_index.xml (modify layout="" attribute for admin)
    + create Block\... and view\adminhtml\templates\... (if need)

- Create UiComponent
    1. Listing
        + create \view\adminhtml\ui_component\student_listing.xml
        + create \Ui\Dataprovider\StudentDataProvider.php (for 'dataProvider' in student_listing.xml)
        + create \Ui\Component\Listing\Columns\StudentActions (for 'actionsColumn' in student_listing.xml)
        + create controllers for actionsColumn

        + for inlineEdit you need:
            - settings/editorConfig (columns tag)
            - settings/childDefaults (columns tag)
            - settings/editor (column tag)

        + for filterSearch
            - filterSearch tag in Ui Listing
            - addFilter method in DataProvider class
            - collectionProcessor
            - collectionFactory (di.xml)
    2. Form
        *Note: You can't use 2 templates (tab & collapsible) in the same ui form
        + create controller (edit)
        + create \view\adminghhtml\ui_component\student_form.xml
        + create \Ui\Dataprovider\StudentFormDataProvider.php (for 'dataProvider' in student_form.xml)
        + create buttons (GenericButton first)
        + create controller (save)

        *multi-tab widget form
        + create controller (widget)
        + create layout (2-columns-left)
        + create \Block\Adminhtml\Student\Form\Edit\Form.php (declare main form)
        + create \Block\Adminhtml\Student\Form\Edit\Tabs.php (declare tabs)
        + create \Block\Adminhtml\Student\Form\Edit\Tab\... (add fields to main form in each tab)
        + create controller (save)

