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
    
    
    
    class dbo_PerformanceManagement_ProgramKPIsPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                new MsCOMConnectionFactory(),
                GetConnectionOptions(),
                '[dbo].[PerformanceManagement_ProgramKPIs]');
            $field = new IntegerField('MeasureID', null, null, true);
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new StringField('MeasureName');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('DepartmentID');
            $this->dataset->AddField($field, false);
            $field = new StringField('Program');
            $this->dataset->AddField($field, false);
            $field = new StringField('PriorityArea');
            $this->dataset->AddField($field, false);
            $field = new BooleanField('Active');
            $this->dataset->AddField($field, false);
            $field = new DateTimeField('LastEdit');
            $this->dataset->AddField($field, false);
            $field = new StringField('Editor');
            $this->dataset->AddField($field, false);
            $field = new StringField('Interval');
            $this->dataset->AddField($field, false);
            $field = new StringField('Description');
            $this->dataset->AddField($field, false);
            $field = new StringField('Collection');
            $this->dataset->AddField($field, false);
            $field = new StringField('Calculation');
            $this->dataset->AddField($field, false);
            $field = new BooleanField('DeptKPI');
            $this->dataset->AddField($field, false);
            $field = new StringField('ProgramNumber');
            $this->dataset->AddField($field, false);
            $field = new StringField('Organization');
            $this->dataset->AddField($field, false);
            $field = new StringField('Fund');
            $this->dataset->AddField($field, false);
            $field = new StringField('MeasureNumber');
            $this->dataset->AddField($field, false);
            $field = new StringField('MeasureType');
            $this->dataset->AddField($field, false);
            $field = new StringField('Department');
            $this->dataset->AddField($field, false);
            $field = new StringField('MeasureUnit');
            $this->dataset->AddField($field, false);
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
            $grid->SearchControl = new SimpleSearch('dbo_PerformanceManagement_ProgramKPIsssearch', $this->dataset,
                array('MeasureID', 'MeasureName', 'DepartmentID', 'Program', 'PriorityArea', 'Active', 'LastEdit', 'Editor', 'Interval', 'Description', 'Collection', 'Calculation', 'DeptKPI', 'ProgramNumber', 'Organization', 'Fund', 'MeasureNumber', 'MeasureType', 'Department', 'MeasureUnit'),
                array($this->RenderText('MeasureID'), $this->RenderText('MeasureName'), $this->RenderText('DepartmentID'), $this->RenderText('Program'), $this->RenderText('PriorityArea'), $this->RenderText('Active'), $this->RenderText('LastEdit'), $this->RenderText('Editor'), $this->RenderText('Interval'), $this->RenderText('Description'), $this->RenderText('Collection'), $this->RenderText('Calculation'), $this->RenderText('DeptKPI'), $this->RenderText('ProgramNumber'), $this->RenderText('Organization'), $this->RenderText('Fund'), $this->RenderText('MeasureNumber'), $this->RenderText('MeasureType'), $this->RenderText('Department'), $this->RenderText('MeasureUnit')),
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
            $this->AdvancedSearchControl = new AdvancedSearchControl('dbo_PerformanceManagement_ProgramKPIsasearch', $this->dataset, $this->GetLocalizerCaptions(), $this->GetColumnVariableContainer(), $this->CreateLinkBuilder());
            $this->AdvancedSearchControl->setTimerInterval(1000);
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('MeasureID', $this->RenderText('MeasureID')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('MeasureName', $this->RenderText('MeasureName')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('DepartmentID', $this->RenderText('DepartmentID')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('Program', $this->RenderText('Program')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('PriorityArea', $this->RenderText('PriorityArea')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('Active', $this->RenderText('Active')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateDateTimeSearchInput('LastEdit', $this->RenderText('LastEdit'), 'Y-m-d H:i:s'));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('Editor', $this->RenderText('Editor')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('Interval', $this->RenderText('Interval')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('Description', $this->RenderText('Description')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('Collection', $this->RenderText('Collection')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('Calculation', $this->RenderText('Calculation')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('DeptKPI', $this->RenderText('DeptKPI')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ProgramNumber', $this->RenderText('ProgramNumber')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('Organization', $this->RenderText('Organization')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('Fund', $this->RenderText('Fund')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('MeasureNumber', $this->RenderText('MeasureNumber')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('MeasureType', $this->RenderText('MeasureType')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('Department', $this->RenderText('Department')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('MeasureUnit', $this->RenderText('MeasureUnit')));
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
            // View column for MeasureID field
            //
            $column = new TextViewColumn('MeasureID', 'MeasureID', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for MeasureName field
            //
            $column = new TextViewColumn('MeasureName', 'MeasureName', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('dbo_PerformanceManagement_ProgramKPIsGrid_MeasureName_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for DepartmentID field
            //
            $column = new TextViewColumn('DepartmentID', 'DepartmentID', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Program field
            //
            $column = new TextViewColumn('Program', 'Program', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('dbo_PerformanceManagement_ProgramKPIsGrid_Program_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for PriorityArea field
            //
            $column = new TextViewColumn('PriorityArea', 'PriorityArea', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('dbo_PerformanceManagement_ProgramKPIsGrid_PriorityArea_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Active field
            //
            $column = new TextViewColumn('Active', 'Active', $this->dataset);
            $column->SetOrderable(true);
            $column = new CheckBoxFormatValueViewColumnDecorator($column);
            $column->SetDisplayValues($this->RenderText('<img src="images/checked.png" alt="true">'), $this->RenderText(''));
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
            // View column for Interval field
            //
            $column = new TextViewColumn('Interval', 'Interval', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Description field
            //
            $column = new TextViewColumn('Description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Collection field
            //
            $column = new TextViewColumn('Collection', 'Collection', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Calculation field
            //
            $column = new TextViewColumn('Calculation', 'Calculation', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for DeptKPI field
            //
            $column = new TextViewColumn('DeptKPI', 'DeptKPI', $this->dataset);
            $column->SetOrderable(true);
            $column = new CheckBoxFormatValueViewColumnDecorator($column);
            $column->SetDisplayValues($this->RenderText('<img src="images/checked.png" alt="true">'), $this->RenderText(''));
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ProgramNumber field
            //
            $column = new TextViewColumn('ProgramNumber', 'ProgramNumber', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Organization field
            //
            $column = new TextViewColumn('Organization', 'Organization', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Fund field
            //
            $column = new TextViewColumn('Fund', 'Fund', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for MeasureNumber field
            //
            $column = new TextViewColumn('MeasureNumber', 'MeasureNumber', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for MeasureType field
            //
            $column = new TextViewColumn('MeasureType', 'MeasureType', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Department field
            //
            $column = new TextViewColumn('Department', 'Department', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('dbo_PerformanceManagement_ProgramKPIsGrid_Department_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for MeasureUnit field
            //
            $column = new TextViewColumn('MeasureUnit', 'MeasureUnit', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for MeasureID field
            //
            $column = new TextViewColumn('MeasureID', 'MeasureID', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for MeasureName field
            //
            $column = new TextViewColumn('MeasureName', 'MeasureName', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('dbo_PerformanceManagement_ProgramKPIsGrid_MeasureName_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for DepartmentID field
            //
            $column = new TextViewColumn('DepartmentID', 'DepartmentID', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Program field
            //
            $column = new TextViewColumn('Program', 'Program', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('dbo_PerformanceManagement_ProgramKPIsGrid_Program_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for PriorityArea field
            //
            $column = new TextViewColumn('PriorityArea', 'PriorityArea', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('dbo_PerformanceManagement_ProgramKPIsGrid_PriorityArea_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Active field
            //
            $column = new TextViewColumn('Active', 'Active', $this->dataset);
            $column->SetOrderable(true);
            $column = new CheckBoxFormatValueViewColumnDecorator($column);
            $column->SetDisplayValues($this->RenderText('<img src="images/checked.png" alt="true">'), $this->RenderText(''));
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
            // View column for Interval field
            //
            $column = new TextViewColumn('Interval', 'Interval', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Description field
            //
            $column = new TextViewColumn('Description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Collection field
            //
            $column = new TextViewColumn('Collection', 'Collection', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Calculation field
            //
            $column = new TextViewColumn('Calculation', 'Calculation', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for DeptKPI field
            //
            $column = new TextViewColumn('DeptKPI', 'DeptKPI', $this->dataset);
            $column->SetOrderable(true);
            $column = new CheckBoxFormatValueViewColumnDecorator($column);
            $column->SetDisplayValues($this->RenderText('<img src="images/checked.png" alt="true">'), $this->RenderText(''));
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ProgramNumber field
            //
            $column = new TextViewColumn('ProgramNumber', 'ProgramNumber', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Organization field
            //
            $column = new TextViewColumn('Organization', 'Organization', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Fund field
            //
            $column = new TextViewColumn('Fund', 'Fund', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for MeasureNumber field
            //
            $column = new TextViewColumn('MeasureNumber', 'MeasureNumber', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for MeasureType field
            //
            $column = new TextViewColumn('MeasureType', 'MeasureType', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Department field
            //
            $column = new TextViewColumn('Department', 'Department', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('dbo_PerformanceManagement_ProgramKPIsGrid_Department_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for MeasureUnit field
            //
            $column = new TextViewColumn('MeasureUnit', 'MeasureUnit', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for MeasureName field
            //
            $editor = new TextAreaEdit('measurename_edit', 50, 8);
            $editColumn = new CustomEditColumn('MeasureName', 'MeasureName', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for DepartmentID field
            //
            $editor = new TextEdit('departmentid_edit');
            $editColumn = new CustomEditColumn('DepartmentID', 'DepartmentID', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Program field
            //
            $editor = new TextEdit('program_edit');
            $editor->SetSize(100);
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Program', 'Program', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for PriorityArea field
            //
            $editor = new TextEdit('priorityarea_edit');
            $editor->SetSize(100);
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('PriorityArea', 'PriorityArea', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Active field
            //
            $editor = new CheckBox('active_edit');
            $editColumn = new CustomEditColumn('Active', 'Active', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for LastEdit field
            //
            $editor = new DateTimeEdit('lastedit_edit', true, 'Y-m-d H:i:s', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('LastEdit', 'LastEdit', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
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
            // Edit column for Interval field
            //
            $editor = new TextEdit('interval_edit');
            $editor->SetSize(30);
            $editor->SetMaxLength(30);
            $editColumn = new CustomEditColumn('Interval', 'Interval', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Description field
            //
            $editor = new TextEdit('description_edit');
            $editColumn = new CustomEditColumn('Description', 'Description', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Collection field
            //
            $editor = new TextEdit('collection_edit');
            $editColumn = new CustomEditColumn('Collection', 'Collection', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Calculation field
            //
            $editor = new TextEdit('calculation_edit');
            $editColumn = new CustomEditColumn('Calculation', 'Calculation', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for DeptKPI field
            //
            $editor = new CheckBox('deptkpi_edit');
            $editColumn = new CustomEditColumn('DeptKPI', 'DeptKPI', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ProgramNumber field
            //
            $editor = new TextEdit('programnumber_edit');
            $editor->SetSize(20);
            $editor->SetMaxLength(20);
            $editColumn = new CustomEditColumn('ProgramNumber', 'ProgramNumber', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Organization field
            //
            $editor = new TextEdit('organization_edit');
            $editor->SetSize(12);
            $editor->SetMaxLength(12);
            $editColumn = new CustomEditColumn('Organization', 'Organization', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Fund field
            //
            $editor = new TextEdit('fund_edit');
            $editor->SetSize(10);
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Fund', 'Fund', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for MeasureNumber field
            //
            $editor = new TextEdit('measurenumber_edit');
            $editor->SetSize(24);
            $editor->SetMaxLength(24);
            $editColumn = new CustomEditColumn('MeasureNumber', 'MeasureNumber', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for MeasureType field
            //
            $editor = new TextEdit('measuretype_edit');
            $editor->SetSize(30);
            $editor->SetMaxLength(30);
            $editColumn = new CustomEditColumn('MeasureType', 'MeasureType', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Department field
            //
            $editor = new TextEdit('department_edit');
            $editor->SetSize(100);
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Department', 'Department', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for MeasureUnit field
            //
            $editor = new TextEdit('measureunit_edit');
            $editor->SetSize(24);
            $editor->SetMaxLength(24);
            $editColumn = new CustomEditColumn('MeasureUnit', 'MeasureUnit', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for MeasureName field
            //
            $editor = new TextAreaEdit('measurename_edit', 50, 8);
            $editColumn = new CustomEditColumn('MeasureName', 'MeasureName', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for DepartmentID field
            //
            $editor = new TextEdit('departmentid_edit');
            $editColumn = new CustomEditColumn('DepartmentID', 'DepartmentID', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Program field
            //
            $editor = new TextEdit('program_edit');
            $editor->SetSize(100);
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Program', 'Program', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for PriorityArea field
            //
            $editor = new TextEdit('priorityarea_edit');
            $editor->SetSize(100);
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('PriorityArea', 'PriorityArea', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Active field
            //
            $editor = new CheckBox('active_edit');
            $editColumn = new CustomEditColumn('Active', 'Active', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for LastEdit field
            //
            $editor = new DateTimeEdit('lastedit_edit', true, 'Y-m-d H:i:s', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('LastEdit', 'LastEdit', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
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
            // Edit column for Interval field
            //
            $editor = new TextEdit('interval_edit');
            $editor->SetSize(30);
            $editor->SetMaxLength(30);
            $editColumn = new CustomEditColumn('Interval', 'Interval', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Description field
            //
            $editor = new TextEdit('description_edit');
            $editColumn = new CustomEditColumn('Description', 'Description', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Collection field
            //
            $editor = new TextEdit('collection_edit');
            $editColumn = new CustomEditColumn('Collection', 'Collection', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Calculation field
            //
            $editor = new TextEdit('calculation_edit');
            $editColumn = new CustomEditColumn('Calculation', 'Calculation', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for DeptKPI field
            //
            $editor = new CheckBox('deptkpi_edit');
            $editColumn = new CustomEditColumn('DeptKPI', 'DeptKPI', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ProgramNumber field
            //
            $editor = new TextEdit('programnumber_edit');
            $editor->SetSize(20);
            $editor->SetMaxLength(20);
            $editColumn = new CustomEditColumn('ProgramNumber', 'ProgramNumber', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Organization field
            //
            $editor = new TextEdit('organization_edit');
            $editor->SetSize(12);
            $editor->SetMaxLength(12);
            $editColumn = new CustomEditColumn('Organization', 'Organization', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Fund field
            //
            $editor = new TextEdit('fund_edit');
            $editor->SetSize(10);
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Fund', 'Fund', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for MeasureNumber field
            //
            $editor = new TextEdit('measurenumber_edit');
            $editor->SetSize(24);
            $editor->SetMaxLength(24);
            $editColumn = new CustomEditColumn('MeasureNumber', 'MeasureNumber', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for MeasureType field
            //
            $editor = new TextEdit('measuretype_edit');
            $editor->SetSize(30);
            $editor->SetMaxLength(30);
            $editColumn = new CustomEditColumn('MeasureType', 'MeasureType', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Department field
            //
            $editor = new TextEdit('department_edit');
            $editor->SetSize(100);
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Department', 'Department', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for MeasureUnit field
            //
            $editor = new TextEdit('measureunit_edit');
            $editor->SetSize(24);
            $editor->SetMaxLength(24);
            $editColumn = new CustomEditColumn('MeasureUnit', 'MeasureUnit', $editor, $this->dataset);
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
            // View column for MeasureID field
            //
            $column = new TextViewColumn('MeasureID', 'MeasureID', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for MeasureName field
            //
            $column = new TextViewColumn('MeasureName', 'MeasureName', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for DepartmentID field
            //
            $column = new TextViewColumn('DepartmentID', 'DepartmentID', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Program field
            //
            $column = new TextViewColumn('Program', 'Program', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for PriorityArea field
            //
            $column = new TextViewColumn('PriorityArea', 'PriorityArea', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Active field
            //
            $column = new TextViewColumn('Active', 'Active', $this->dataset);
            $column->SetOrderable(true);
            $column = new CheckBoxFormatValueViewColumnDecorator($column);
            $column->SetDisplayValues($this->RenderText('<img src="images/checked.png" alt="true">'), $this->RenderText(''));
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
            // View column for Interval field
            //
            $column = new TextViewColumn('Interval', 'Interval', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Description field
            //
            $column = new TextViewColumn('Description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Collection field
            //
            $column = new TextViewColumn('Collection', 'Collection', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Calculation field
            //
            $column = new TextViewColumn('Calculation', 'Calculation', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for DeptKPI field
            //
            $column = new TextViewColumn('DeptKPI', 'DeptKPI', $this->dataset);
            $column->SetOrderable(true);
            $column = new CheckBoxFormatValueViewColumnDecorator($column);
            $column->SetDisplayValues($this->RenderText('<img src="images/checked.png" alt="true">'), $this->RenderText(''));
            $grid->AddPrintColumn($column);
            
            //
            // View column for ProgramNumber field
            //
            $column = new TextViewColumn('ProgramNumber', 'ProgramNumber', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Organization field
            //
            $column = new TextViewColumn('Organization', 'Organization', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Fund field
            //
            $column = new TextViewColumn('Fund', 'Fund', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for MeasureNumber field
            //
            $column = new TextViewColumn('MeasureNumber', 'MeasureNumber', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for MeasureType field
            //
            $column = new TextViewColumn('MeasureType', 'MeasureType', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Department field
            //
            $column = new TextViewColumn('Department', 'Department', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for MeasureUnit field
            //
            $column = new TextViewColumn('MeasureUnit', 'MeasureUnit', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for MeasureID field
            //
            $column = new TextViewColumn('MeasureID', 'MeasureID', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for MeasureName field
            //
            $column = new TextViewColumn('MeasureName', 'MeasureName', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for DepartmentID field
            //
            $column = new TextViewColumn('DepartmentID', 'DepartmentID', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Program field
            //
            $column = new TextViewColumn('Program', 'Program', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for PriorityArea field
            //
            $column = new TextViewColumn('PriorityArea', 'PriorityArea', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Active field
            //
            $column = new TextViewColumn('Active', 'Active', $this->dataset);
            $column->SetOrderable(true);
            $column = new CheckBoxFormatValueViewColumnDecorator($column);
            $column->SetDisplayValues($this->RenderText('<img src="images/checked.png" alt="true">'), $this->RenderText(''));
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
            // View column for Interval field
            //
            $column = new TextViewColumn('Interval', 'Interval', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Description field
            //
            $column = new TextViewColumn('Description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Collection field
            //
            $column = new TextViewColumn('Collection', 'Collection', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Calculation field
            //
            $column = new TextViewColumn('Calculation', 'Calculation', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for DeptKPI field
            //
            $column = new TextViewColumn('DeptKPI', 'DeptKPI', $this->dataset);
            $column->SetOrderable(true);
            $column = new CheckBoxFormatValueViewColumnDecorator($column);
            $column->SetDisplayValues($this->RenderText('<img src="images/checked.png" alt="true">'), $this->RenderText(''));
            $grid->AddExportColumn($column);
            
            //
            // View column for ProgramNumber field
            //
            $column = new TextViewColumn('ProgramNumber', 'ProgramNumber', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Organization field
            //
            $column = new TextViewColumn('Organization', 'Organization', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Fund field
            //
            $column = new TextViewColumn('Fund', 'Fund', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for MeasureNumber field
            //
            $column = new TextViewColumn('MeasureNumber', 'MeasureNumber', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for MeasureType field
            //
            $column = new TextViewColumn('MeasureType', 'MeasureType', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Department field
            //
            $column = new TextViewColumn('Department', 'Department', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for MeasureUnit field
            //
            $column = new TextViewColumn('MeasureUnit', 'MeasureUnit', $this->dataset);
            $column->SetOrderable(true);
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
        
        public function GetModalGridDeleteHandler() { return 'dbo_PerformanceManagement_ProgramKPIs_modal_delete'; }
        protected function GetEnableModalGridDelete() { return true; }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset, 'dbo_PerformanceManagement_ProgramKPIsGrid');
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
            //
            // View column for MeasureName field
            //
            $column = new TextViewColumn('MeasureName', 'MeasureName', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'dbo_PerformanceManagement_ProgramKPIsGrid_MeasureName_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for Program field
            //
            $column = new TextViewColumn('Program', 'Program', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'dbo_PerformanceManagement_ProgramKPIsGrid_Program_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for PriorityArea field
            //
            $column = new TextViewColumn('PriorityArea', 'PriorityArea', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'dbo_PerformanceManagement_ProgramKPIsGrid_PriorityArea_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for Department field
            //
            $column = new TextViewColumn('Department', 'Department', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'dbo_PerformanceManagement_ProgramKPIsGrid_Department_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);//
            // View column for MeasureName field
            //
            $column = new TextViewColumn('MeasureName', 'MeasureName', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'dbo_PerformanceManagement_ProgramKPIsGrid_MeasureName_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for Program field
            //
            $column = new TextViewColumn('Program', 'Program', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'dbo_PerformanceManagement_ProgramKPIsGrid_Program_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for PriorityArea field
            //
            $column = new TextViewColumn('PriorityArea', 'PriorityArea', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'dbo_PerformanceManagement_ProgramKPIsGrid_PriorityArea_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for Department field
            //
            $column = new TextViewColumn('Department', 'Department', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'dbo_PerformanceManagement_ProgramKPIsGrid_Department_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
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
        $Page = new dbo_PerformanceManagement_ProgramKPIsPage("dbo.PerformanceManagement_ProgramKPIs.php", "dbo_PerformanceManagement_ProgramKPIs", GetCurrentUserGrantForDataSource("dbo.PerformanceManagement_ProgramKPIs"), 'UTF-8');
        $Page->SetShortCaption('Dbo.PerformanceManagement ProgramKPIs');
        $Page->SetHeader(GetPagesHeader());
        $Page->SetFooter(GetPagesFooter());
        $Page->SetCaption('Dbo.PerformanceManagement ProgramKPIs');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("dbo.PerformanceManagement_ProgramKPIs"));
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
	
