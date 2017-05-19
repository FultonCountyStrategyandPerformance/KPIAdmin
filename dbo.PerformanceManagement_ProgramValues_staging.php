<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                                   ATTENTION!
 * If you see this message in your browser (Internet Explorer, Mozilla Firefox, Google Chrome, etc.)
 * this means that PHP is not properly installed on your web server. Please refer to the PHP manual
 * for more details: http://php.net/manual/install.php 
 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */


    include_once dirname(__FILE__) . '/' . 'components/utils/check_utils.php';
    CheckPHPVersion();
    CheckTemplatesCacheFolderIsExistsAndWritable();


    include_once dirname(__FILE__) . '/' . 'phpgen_settings.php';
    include_once dirname(__FILE__) . '/' . 'database_engine/mssql_engine.php';
    include_once dirname(__FILE__) . '/' . 'components/page.php';


    function GetConnectionOptions()
    {
        $result = GetGlobalConnectionOptions();
        GetApplication()->GetUserAuthorizationStrategy()->ApplyIdentityToConnectionOptions($result);
        return $result;
    }

    
    // OnGlobalBeforePageExecute event handler
    
    
    // OnBeforePageExecute event handler
    
    
    
    class dbo_PerformanceManagement_ProgramValues_stagingPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                new MsCOMConnectionFactory(),
                GetConnectionOptions(),
                '[dbo].[PerformanceManagement_ProgramValues_staging]');
            $field = new IntegerField('ValueID', null, null, true);
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new IntegerField('MeasureID');
            $this->dataset->AddField($field, false);
            $field = new StringField('Year');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('Quarter');
            $this->dataset->AddField($field, false);
            $field = new StringField('ValueType');
            $this->dataset->AddField($field, false);
            $field = new DateTimeField('LastEdit');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new StringField('Editor');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('Value');
            $this->dataset->AddField($field, false);
            $this->dataset->AddLookupField('MeasureID', 'dbo.PerformanceManagement_ProgramKPIs', new IntegerField('MeasureID', null, null, true), new StringField('MeasureName', 'MeasureID_MeasureName', 'MeasureID_MeasureName_dbo_PerformanceManagement_ProgramKPIs'), 'MeasureID_MeasureName_dbo_PerformanceManagement_ProgramKPIs');
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
            $partitionNavigator = new PageNavigator('pnav', $this, $this->dataset);
            $partitionNavigator->SetRowsPerPage(20);
            $result->AddPageNavigator($partitionNavigator);
            
            return $result;
        }
    
        public function GetPageList()
        {
            $currentPageCaption = $this->GetShortCaption();
            $result = new PageList($this);
            $result->AddGroup($this->RenderText('Default'));
            if (GetCurrentUserGrantForDataSource('dbo.PerformanceManagement_ProgramKPIs')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Dbo.PerformanceManagement ProgramKPIs'), 'dbo.PerformanceManagement_ProgramKPIs.php', $this->RenderText('Dbo.PerformanceManagement ProgramKPIs'), $currentPageCaption == $this->RenderText('Dbo.PerformanceManagement ProgramKPIs'), false, $this->RenderText('Default')));
            if (GetCurrentUserGrantForDataSource('dbo.PerformanceManagement_ProgramValues')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Dbo.PerformanceManagement ProgramValues'), 'dbo.PerformanceManagement_ProgramValues.php', $this->RenderText('Dbo.PerformanceManagement ProgramValues'), $currentPageCaption == $this->RenderText('Dbo.PerformanceManagement ProgramValues'), false, $this->RenderText('Default')));
            if (GetCurrentUserGrantForDataSource('dbo.PerformanceManagement_ProgramValues_staging')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Dbo.PerformanceManagement ProgramValues Staging'), 'dbo.PerformanceManagement_ProgramValues_staging.php', $this->RenderText('Dbo.PerformanceManagement ProgramValues Staging'), $currentPageCaption == $this->RenderText('Dbo.PerformanceManagement ProgramValues Staging'), false, $this->RenderText('Default')));
            if (GetCurrentUserGrantForDataSource('dbo.PerformanceManagement_StartDates')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Dbo.PerformanceManagement StartDates'), 'dbo.PerformanceManagement_StartDates.php', $this->RenderText('Dbo.PerformanceManagement StartDates'), $currentPageCaption == $this->RenderText('Dbo.PerformanceManagement StartDates'), false, $this->RenderText('Default')));
            if (GetCurrentUserGrantForDataSource('dbo.PerformanceManagement_Users')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Dbo.PerformanceManagement Users'), 'dbo.PerformanceManagement_Users.php', $this->RenderText('Dbo.PerformanceManagement Users'), $currentPageCaption == $this->RenderText('Dbo.PerformanceManagement Users'), false, $this->RenderText('Default')));
            if (GetCurrentUserGrantForDataSource('dbo.PerformanceManagement_ProgramTargets')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Dbo.PerformanceManagement ProgramTargets'), 'dbo.PerformanceManagement_ProgramTargets.php', $this->RenderText('Dbo.PerformanceManagement ProgramTargets'), $currentPageCaption == $this->RenderText('Dbo.PerformanceManagement ProgramTargets'), false, $this->RenderText('Default')));
            
            if ( HasAdminPage() && GetApplication()->HasAdminGrantForCurrentUser() ) {
              $result->AddGroup('Admin area');
              $result->AddPage(new PageLink($this->GetLocalizerCaptions()->GetMessageString('AdminPage'), 'phpgen_admin.php', $this->GetLocalizerCaptions()->GetMessageString('AdminPage'), false, false, 'Admin area'));
            }
            return $result;
        }
    
        protected function CreateRssGenerator()
        {
            return null;
        }
    
        protected function CreateGridSearchControl(Grid $grid)
        {
            $grid->UseFilter = true;
            $grid->SearchControl = new SimpleSearch('dbo_PerformanceManagement_ProgramValues_stagingssearch', $this->dataset,
                array('ValueID', 'MeasureID_MeasureName', 'Year', 'Quarter', 'ValueType', 'LastEdit', 'Editor', 'Value'),
                array($this->RenderText('ValueID'), $this->RenderText('MeasureID'), $this->RenderText('Year'), $this->RenderText('Quarter'), $this->RenderText('ValueType'), $this->RenderText('LastEdit'), $this->RenderText('Editor'), $this->RenderText('Value')),
                array(
                    '=' => $this->GetLocalizerCaptions()->GetMessageString('equals'),
                    '<>' => $this->GetLocalizerCaptions()->GetMessageString('doesNotEquals'),
                    '<' => $this->GetLocalizerCaptions()->GetMessageString('isLessThan'),
                    '<=' => $this->GetLocalizerCaptions()->GetMessageString('isLessThanOrEqualsTo'),
                    '>' => $this->GetLocalizerCaptions()->GetMessageString('isGreaterThan'),
                    '>=' => $this->GetLocalizerCaptions()->GetMessageString('isGreaterThanOrEqualsTo'),
                    'ILIKE' => $this->GetLocalizerCaptions()->GetMessageString('Like'),
                    'STARTS' => $this->GetLocalizerCaptions()->GetMessageString('StartsWith'),
                    'ENDS' => $this->GetLocalizerCaptions()->GetMessageString('EndsWith'),
                    'CONTAINS' => $this->GetLocalizerCaptions()->GetMessageString('Contains')
                    ), $this->GetLocalizerCaptions(), $this, 'CONTAINS'
                );
        }
    
        protected function CreateGridAdvancedSearchControl(Grid $grid)
        {
            $this->AdvancedSearchControl = new AdvancedSearchControl('dbo_PerformanceManagement_ProgramValues_stagingasearch', $this->dataset, $this->GetLocalizerCaptions(), $this->GetColumnVariableContainer(), $this->CreateLinkBuilder());
            $this->AdvancedSearchControl->setTimerInterval(1000);
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ValueID', $this->RenderText('ValueID')));
            
            $lookupDataset = new TableDataset(
                new MsCOMConnectionFactory(),
                GetConnectionOptions(),
                '[dbo].[PerformanceManagement_ProgramKPIs]');
            $field = new IntegerField('MeasureID', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('MeasureName');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('DepartmentID');
            $lookupDataset->AddField($field, false);
            $field = new StringField('Program');
            $lookupDataset->AddField($field, false);
            $field = new StringField('PriorityArea');
            $lookupDataset->AddField($field, false);
            $field = new BooleanField('Active');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('LastEdit');
            $lookupDataset->AddField($field, false);
            $field = new StringField('Editor');
            $lookupDataset->AddField($field, false);
            $field = new StringField('Interval');
            $lookupDataset->AddField($field, false);
            $field = new StringField('Description');
            $lookupDataset->AddField($field, false);
            $field = new StringField('Collection');
            $lookupDataset->AddField($field, false);
            $field = new StringField('Calculation');
            $lookupDataset->AddField($field, false);
            $field = new BooleanField('DeptKPI');
            $lookupDataset->AddField($field, false);
            $field = new StringField('ProgramNumber');
            $lookupDataset->AddField($field, false);
            $field = new StringField('Organization');
            $lookupDataset->AddField($field, false);
            $field = new StringField('Fund');
            $lookupDataset->AddField($field, false);
            $field = new StringField('MeasureNumber');
            $lookupDataset->AddField($field, false);
            $field = new StringField('MeasureType');
            $lookupDataset->AddField($field, false);
            $field = new StringField('Department');
            $lookupDataset->AddField($field, false);
            $field = new StringField('MeasureUnit');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('MeasureName', GetOrderTypeAsSQL(otAscending));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateLookupSearchInput('MeasureID', $this->RenderText('MeasureID'), $lookupDataset, 'MeasureID', 'MeasureName', false, 8));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('Year', $this->RenderText('Year')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('Quarter', $this->RenderText('Quarter')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ValueType', $this->RenderText('ValueType')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateDateTimeSearchInput('LastEdit', $this->RenderText('LastEdit'), 'Y-m-d H:i:s'));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('Editor', $this->RenderText('Editor')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('Value', $this->RenderText('Value')));
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
            $actionsBandName = 'actions';
            $grid->AddBandToBegin($actionsBandName, $this->GetLocalizerCaptions()->GetMessageString('Actions'), true);
            if ($this->GetSecurityInfo()->HasViewGrant())
            {
                $column = new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('View'), OPERATION_VIEW, $this->dataset);
                $grid->AddViewColumn($column, $actionsBandName);
            }
            if ($this->GetSecurityInfo()->HasEditGrant())
            {
                $column = new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('Edit'), OPERATION_EDIT, $this->dataset);
                $grid->AddViewColumn($column, $actionsBandName);
                $column->OnShow->AddListener('ShowEditButtonHandler', $this);
            }
            if ($this->GetSecurityInfo()->HasDeleteGrant())
            {
                $column = new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('Delete'), OPERATION_DELETE, $this->dataset);
                $grid->AddViewColumn($column, $actionsBandName);
                $column->OnShow->AddListener('ShowDeleteButtonHandler', $this);
                $column->SetAdditionalAttribute('data-modal-delete', 'true');
                $column->SetAdditionalAttribute('data-delete-handler-name', $this->GetModalGridDeleteHandler());
            }
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $column = new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('Copy'), OPERATION_COPY, $this->dataset);
                $grid->AddViewColumn($column, $actionsBandName);
            }
        }
    
        protected function AddFieldColumns(Grid $grid)
        {
            //
            // View column for ValueID field
            //
            $column = new TextViewColumn('ValueID', 'ValueID', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for MeasureName field
            //
            $column = new TextViewColumn('MeasureID_MeasureName', 'MeasureID', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Year field
            //
            $column = new TextViewColumn('Year', 'Year', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Quarter field
            //
            $column = new TextViewColumn('Quarter', 'Quarter', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ValueType field
            //
            $column = new TextViewColumn('ValueType', 'ValueType', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for LastEdit field
            //
            $column = new DateTimeViewColumn('LastEdit', 'LastEdit', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Editor field
            //
            $column = new TextViewColumn('Editor', 'Editor', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Value field
            //
            $column = new TextViewColumn('Value', 'Value', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 4, ',', '.');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for ValueID field
            //
            $column = new TextViewColumn('ValueID', 'ValueID', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for MeasureName field
            //
            $column = new TextViewColumn('MeasureID_MeasureName', 'MeasureID', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Year field
            //
            $column = new TextViewColumn('Year', 'Year', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Quarter field
            //
            $column = new TextViewColumn('Quarter', 'Quarter', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ValueType field
            //
            $column = new TextViewColumn('ValueType', 'ValueType', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for LastEdit field
            //
            $column = new DateTimeViewColumn('LastEdit', 'LastEdit', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Editor field
            //
            $column = new TextViewColumn('Editor', 'Editor', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Value field
            //
            $column = new TextViewColumn('Value', 'Value', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 4, ',', '.');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for MeasureID field
            //
            $editor = new ComboBox('measureid_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new MsCOMConnectionFactory(),
                GetConnectionOptions(),
                '[dbo].[PerformanceManagement_ProgramKPIs]');
            $field = new IntegerField('MeasureID', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('MeasureName');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('DepartmentID');
            $lookupDataset->AddField($field, false);
            $field = new StringField('Program');
            $lookupDataset->AddField($field, false);
            $field = new StringField('PriorityArea');
            $lookupDataset->AddField($field, false);
            $field = new BooleanField('Active');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('LastEdit');
            $lookupDataset->AddField($field, false);
            $field = new StringField('Editor');
            $lookupDataset->AddField($field, false);
            $field = new StringField('Interval');
            $lookupDataset->AddField($field, false);
            $field = new StringField('Description');
            $lookupDataset->AddField($field, false);
            $field = new StringField('Collection');
            $lookupDataset->AddField($field, false);
            $field = new StringField('Calculation');
            $lookupDataset->AddField($field, false);
            $field = new BooleanField('DeptKPI');
            $lookupDataset->AddField($field, false);
            $field = new StringField('ProgramNumber');
            $lookupDataset->AddField($field, false);
            $field = new StringField('Organization');
            $lookupDataset->AddField($field, false);
            $field = new StringField('Fund');
            $lookupDataset->AddField($field, false);
            $field = new StringField('MeasureNumber');
            $lookupDataset->AddField($field, false);
            $field = new StringField('MeasureType');
            $lookupDataset->AddField($field, false);
            $field = new StringField('Department');
            $lookupDataset->AddField($field, false);
            $field = new StringField('MeasureUnit');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('MeasureName', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'MeasureID', 
                'MeasureID', 
                $editor, 
                $this->dataset, 'MeasureID', 'MeasureName', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Year field
            //
            $editor = new TextEdit('year_edit');
            $editor->SetSize(4);
            $editor->SetMaxLength(4);
            $editColumn = new CustomEditColumn('Year', 'Year', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Quarter field
            //
            $editor = new TextEdit('quarter_edit');
            $editColumn = new CustomEditColumn('Quarter', 'Quarter', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ValueType field
            //
            $editor = new TextEdit('valuetype_edit');
            $editor->SetSize(50);
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('ValueType', 'ValueType', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for LastEdit field
            //
            $editor = new DateTimeEdit('lastedit_edit', true, 'Y-m-d H:i:s', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('LastEdit', 'LastEdit', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Editor field
            //
            $editor = new TextEdit('editor_edit');
            $editor->SetSize(50);
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('Editor', 'Editor', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Value field
            //
            $editor = new TextEdit('value_edit');
            $editColumn = new CustomEditColumn('Value', 'Value', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for MeasureID field
            //
            $editor = new ComboBox('measureid_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new MsCOMConnectionFactory(),
                GetConnectionOptions(),
                '[dbo].[PerformanceManagement_ProgramKPIs]');
            $field = new IntegerField('MeasureID', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('MeasureName');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('DepartmentID');
            $lookupDataset->AddField($field, false);
            $field = new StringField('Program');
            $lookupDataset->AddField($field, false);
            $field = new StringField('PriorityArea');
            $lookupDataset->AddField($field, false);
            $field = new BooleanField('Active');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('LastEdit');
            $lookupDataset->AddField($field, false);
            $field = new StringField('Editor');
            $lookupDataset->AddField($field, false);
            $field = new StringField('Interval');
            $lookupDataset->AddField($field, false);
            $field = new StringField('Description');
            $lookupDataset->AddField($field, false);
            $field = new StringField('Collection');
            $lookupDataset->AddField($field, false);
            $field = new StringField('Calculation');
            $lookupDataset->AddField($field, false);
            $field = new BooleanField('DeptKPI');
            $lookupDataset->AddField($field, false);
            $field = new StringField('ProgramNumber');
            $lookupDataset->AddField($field, false);
            $field = new StringField('Organization');
            $lookupDataset->AddField($field, false);
            $field = new StringField('Fund');
            $lookupDataset->AddField($field, false);
            $field = new StringField('MeasureNumber');
            $lookupDataset->AddField($field, false);
            $field = new StringField('MeasureType');
            $lookupDataset->AddField($field, false);
            $field = new StringField('Department');
            $lookupDataset->AddField($field, false);
            $field = new StringField('MeasureUnit');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('MeasureName', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'MeasureID', 
                'MeasureID', 
                $editor, 
                $this->dataset, 'MeasureID', 'MeasureName', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Year field
            //
            $editor = new TextEdit('year_edit');
            $editor->SetSize(4);
            $editor->SetMaxLength(4);
            $editColumn = new CustomEditColumn('Year', 'Year', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Quarter field
            //
            $editor = new TextEdit('quarter_edit');
            $editColumn = new CustomEditColumn('Quarter', 'Quarter', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ValueType field
            //
            $editor = new TextEdit('valuetype_edit');
            $editor->SetSize(50);
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('ValueType', 'ValueType', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for LastEdit field
            //
            $editor = new DateTimeEdit('lastedit_edit', true, 'Y-m-d H:i:s', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('LastEdit', 'LastEdit', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Editor field
            //
            $editor = new TextEdit('editor_edit');
            $editor->SetSize(50);
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('Editor', 'Editor', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Value field
            //
            $editor = new TextEdit('value_edit');
            $editColumn = new CustomEditColumn('Value', 'Value', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $grid->SetShowAddButton(true);
                $grid->SetShowInlineAddButton(false);
            }
            else
            {
                $grid->SetShowInlineAddButton(false);
                $grid->SetShowAddButton(false);
            }
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for ValueID field
            //
            $column = new TextViewColumn('ValueID', 'ValueID', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for MeasureName field
            //
            $column = new TextViewColumn('MeasureID_MeasureName', 'MeasureID', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Year field
            //
            $column = new TextViewColumn('Year', 'Year', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Quarter field
            //
            $column = new TextViewColumn('Quarter', 'Quarter', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ValueType field
            //
            $column = new TextViewColumn('ValueType', 'ValueType', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for LastEdit field
            //
            $column = new DateTimeViewColumn('LastEdit', 'LastEdit', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Editor field
            //
            $column = new TextViewColumn('Editor', 'Editor', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Value field
            //
            $column = new TextViewColumn('Value', 'Value', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 4, ',', '.');
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for ValueID field
            //
            $column = new TextViewColumn('ValueID', 'ValueID', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for MeasureName field
            //
            $column = new TextViewColumn('MeasureID_MeasureName', 'MeasureID', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Year field
            //
            $column = new TextViewColumn('Year', 'Year', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Quarter field
            //
            $column = new TextViewColumn('Quarter', 'Quarter', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for ValueType field
            //
            $column = new TextViewColumn('ValueType', 'ValueType', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for LastEdit field
            //
            $column = new DateTimeViewColumn('LastEdit', 'LastEdit', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Editor field
            //
            $column = new TextViewColumn('Editor', 'Editor', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Value field
            //
            $column = new TextViewColumn('Value', 'Value', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 4, ',', '.');
            $grid->AddExportColumn($column);
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
    		$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
        public function ShowEditButtonHandler(&$show)
        {
            if ($this->GetRecordPermission() != null)
                $show = $this->GetRecordPermission()->HasEditGrant($this->GetDataset());
        }
        public function ShowDeleteButtonHandler(&$show)
        {
            if ($this->GetRecordPermission() != null)
                $show = $this->GetRecordPermission()->HasDeleteGrant($this->GetDataset());
        }
        
        public function GetModalGridDeleteHandler() { return 'dbo_PerformanceManagement_ProgramValues_staging_modal_delete'; }
        protected function GetEnableModalGridDelete() { return true; }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset, 'dbo_PerformanceManagement_ProgramValues_stagingGrid');
            if ($this->GetSecurityInfo()->HasDeleteGrant())
               $result->SetAllowDeleteSelected(false);
            else
               $result->SetAllowDeleteSelected(false);   
            
            ApplyCommonPageSettings($this, $result);
            
            $result->SetUseImagesForActions(false);
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            
            $result->SetHighlightRowAtHover(false);
            $result->SetWidth('');
            $this->CreateGridSearchControl($result);
            $this->CreateGridAdvancedSearchControl($result);
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
    
            $this->SetShowPageList(true);
            $this->SetHidePageListByDefault(false);
            $this->SetExportToExcelAvailable(false);
            $this->SetExportToWordAvailable(false);
            $this->SetExportToXmlAvailable(false);
            $this->SetExportToCsvAvailable(false);
            $this->SetExportToPdfAvailable(false);
            $this->SetPrinterFriendlyAvailable(false);
            $this->SetSimpleSearchAvailable(true);
            $this->SetAdvancedSearchAvailable(false);
            $this->SetFilterRowAvailable(false);
            $this->SetVisualEffectsEnabled(true);
            $this->SetShowTopPageNavigator(true);
            $this->SetShowBottomPageNavigator(true);
    
            //
            // Http Handlers
            //
    
            return $result;
        }
        
        public function OpenAdvancedSearchByDefault()
        {
            return false;
        }
    
        protected function DoGetGridHeader()
        {
            return '';
        }
    }



    try
    {
        $Page = new dbo_PerformanceManagement_ProgramValues_stagingPage("dbo.PerformanceManagement_ProgramValues_staging.php", "dbo_PerformanceManagement_ProgramValues_staging", GetCurrentUserGrantForDataSource("dbo.PerformanceManagement_ProgramValues_staging"), 'UTF-8');
        $Page->SetShortCaption('Dbo.PerformanceManagement ProgramValues Staging');
        $Page->SetHeader(GetPagesHeader());
        $Page->SetFooter(GetPagesFooter());
        $Page->SetCaption('Dbo.PerformanceManagement ProgramValues Staging');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("dbo.PerformanceManagement_ProgramValues_staging"));
        GetApplication()->SetEnableLessRunTimeCompile(GetEnableLessFilesRunTimeCompilation());
        GetApplication()->SetCanUserChangeOwnPassword(
            !function_exists('CanUserChangeOwnPassword') || CanUserChangeOwnPassword());
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e->getMessage());
    }
	
