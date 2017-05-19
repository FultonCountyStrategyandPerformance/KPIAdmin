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
    
    
    
    class dbo_PerformanceManagement_UsersPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                new MsCOMConnectionFactory(),
                GetConnectionOptions(),
                '[dbo].[PerformanceManagement_Users]');
            $field = new IntegerField('user_id');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new StringField('user_name');
            $this->dataset->AddField($field, false);
            $field = new StringField('user_password');
            $this->dataset->AddField($field, false);
            $field = new StringField('department');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('department_head');
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
            $grid->SearchControl = new SimpleSearch('dbo_PerformanceManagement_Usersssearch', $this->dataset,
                array('user_id', 'user_name', 'user_password', 'department', 'department_head'),
                array($this->RenderText('User Id'), $this->RenderText('User Name'), $this->RenderText('User Password'), $this->RenderText('Department'), $this->RenderText('Department Head')),
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
            $this->AdvancedSearchControl = new AdvancedSearchControl('dbo_PerformanceManagement_Usersasearch', $this->dataset, $this->GetLocalizerCaptions(), $this->GetColumnVariableContainer(), $this->CreateLinkBuilder());
            $this->AdvancedSearchControl->setTimerInterval(1000);
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('user_id', $this->RenderText('User Id')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('user_name', $this->RenderText('User Name')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('user_password', $this->RenderText('User Password')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('department', $this->RenderText('Department')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('department_head', $this->RenderText('Department Head')));
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
            // View column for user_id field
            //
            $column = new TextViewColumn('user_id', 'User Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for user_name field
            //
            $column = new TextViewColumn('user_name', 'User Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('dbo_PerformanceManagement_UsersGrid_user_name_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for user_password field
            //
            $column = new TextViewColumn('user_password', 'User Password', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('dbo_PerformanceManagement_UsersGrid_user_password_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for department field
            //
            $column = new TextViewColumn('department', 'Department', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('dbo_PerformanceManagement_UsersGrid_department_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for department_head field
            //
            $column = new TextViewColumn('department_head', 'Department Head', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for user_id field
            //
            $column = new TextViewColumn('user_id', 'User Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for user_name field
            //
            $column = new TextViewColumn('user_name', 'User Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('dbo_PerformanceManagement_UsersGrid_user_name_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for user_password field
            //
            $column = new TextViewColumn('user_password', 'User Password', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('dbo_PerformanceManagement_UsersGrid_user_password_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for department field
            //
            $column = new TextViewColumn('department', 'Department', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('dbo_PerformanceManagement_UsersGrid_department_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for department_head field
            //
            $column = new TextViewColumn('department_head', 'Department Head', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for user_id field
            //
            $editor = new TextEdit('user_id_edit');
            $editColumn = new CustomEditColumn('User Id', 'user_id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for user_name field
            //
            $editor = new TextAreaEdit('user_name_edit', 50, 8);
            $editColumn = new CustomEditColumn('User Name', 'user_name', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for user_password field
            //
            $editor = new TextAreaEdit('user_password_edit', 50, 8);
            $editColumn = new CustomEditColumn('User Password', 'user_password', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for department field
            //
            $editor = new TextEdit('department_edit');
            $editor->SetSize(100);
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Department', 'department', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for department_head field
            //
            $editor = new TextEdit('department_head_edit');
            $editColumn = new CustomEditColumn('Department Head', 'department_head', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for user_id field
            //
            $editor = new TextEdit('user_id_edit');
            $editColumn = new CustomEditColumn('User Id', 'user_id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for user_name field
            //
            $editor = new TextAreaEdit('user_name_edit', 50, 8);
            $editColumn = new CustomEditColumn('User Name', 'user_name', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for user_password field
            //
            $editor = new TextAreaEdit('user_password_edit', 50, 8);
            $editColumn = new CustomEditColumn('User Password', 'user_password', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for department field
            //
            $editor = new TextEdit('department_edit');
            $editor->SetSize(100);
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Department', 'department', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for department_head field
            //
            $editor = new TextEdit('department_head_edit');
            $editColumn = new CustomEditColumn('Department Head', 'department_head', $editor, $this->dataset);
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
            // View column for user_id field
            //
            $column = new TextViewColumn('user_id', 'User Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for user_name field
            //
            $column = new TextViewColumn('user_name', 'User Name', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for user_password field
            //
            $column = new TextViewColumn('user_password', 'User Password', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for department field
            //
            $column = new TextViewColumn('department', 'Department', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for department_head field
            //
            $column = new TextViewColumn('department_head', 'Department Head', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for user_id field
            //
            $column = new TextViewColumn('user_id', 'User Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for user_name field
            //
            $column = new TextViewColumn('user_name', 'User Name', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for user_password field
            //
            $column = new TextViewColumn('user_password', 'User Password', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for department field
            //
            $column = new TextViewColumn('department', 'Department', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for department_head field
            //
            $column = new TextViewColumn('department_head', 'Department Head', $this->dataset);
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
        
        public function GetModalGridDeleteHandler() { return 'dbo_PerformanceManagement_Users_modal_delete'; }
        protected function GetEnableModalGridDelete() { return true; }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset, 'dbo_PerformanceManagement_UsersGrid');
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
            // View column for user_name field
            //
            $column = new TextViewColumn('user_name', 'User Name', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'dbo_PerformanceManagement_UsersGrid_user_name_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for user_password field
            //
            $column = new TextViewColumn('user_password', 'User Password', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'dbo_PerformanceManagement_UsersGrid_user_password_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for department field
            //
            $column = new TextViewColumn('department', 'Department', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'dbo_PerformanceManagement_UsersGrid_department_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);//
            // View column for user_name field
            //
            $column = new TextViewColumn('user_name', 'User Name', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'dbo_PerformanceManagement_UsersGrid_user_name_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for user_password field
            //
            $column = new TextViewColumn('user_password', 'User Password', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'dbo_PerformanceManagement_UsersGrid_user_password_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for department field
            //
            $column = new TextViewColumn('department', 'Department', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'dbo_PerformanceManagement_UsersGrid_department_handler_view', $column);
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
        $Page = new dbo_PerformanceManagement_UsersPage("dbo.PerformanceManagement_Users.php", "dbo_PerformanceManagement_Users", GetCurrentUserGrantForDataSource("dbo.PerformanceManagement_Users"), 'UTF-8');
        $Page->SetShortCaption('Dbo.PerformanceManagement Users');
        $Page->SetHeader(GetPagesHeader());
        $Page->SetFooter(GetPagesFooter());
        $Page->SetCaption('Dbo.PerformanceManagement Users');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("dbo.PerformanceManagement_Users"));
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
	
