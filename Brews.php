<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                                   ATTENTION!
 * If you see this message in your browser (Internet Explorer, Mozilla Firefox, Google Chrome, etc.)
 * this means that PHP is not properly installed on your web server. Please refer to the PHP manual
 * for more details: http://php.net/manual/install.php 
 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */

    include_once dirname(__FILE__) . '/components/startup.php';
    include_once dirname(__FILE__) . '/components/application.php';
    include_once dirname(__FILE__) . '/' . 'authorization.php';


    include_once dirname(__FILE__) . '/' . 'database_engine/mysql_engine.php';
    include_once dirname(__FILE__) . '/' . 'components/page/page_includes.php';

    function GetConnectionOptions()
    {
        $result = GetGlobalConnectionOptions();
        $result['client_encoding'] = 'utf8';
        GetApplication()->GetUserAuthentication()->applyIdentityToConnectionOptions($result);
        return $result;
    }

    
    
    
    
    // OnBeforePageExecute event handler
    
    
    
    class Brews_InventoryActivitiesPage extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Inventory Activities');
            $this->SetMenuLabel('Inventory Activities');
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`InventoryActivities`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new DateTimeField('updated', true),
                    new StringField('Inventory Item', true),
                    new StringField('Template'),
                    new StringField('Batch'),
                    new StringField('Brew'),
                    new StringField('PackageLog'),
                    new IntegerField('Order ID'),
                    new IntegerField('Committed'),
                    new DateField('Activity Date'),
                    new StringField('Vendor'),
                    new StringField('Entry Type'),
                    new StringField('Unit of Measure'),
                    new StringField('Pkg Type'),
                    new StringField('Activity'),
                    new IntegerField('Units per Pkg'),
                    new IntegerField('Activity Pkg Qty'),
                    new IntegerField('Activity Unit Qty'),
                    new IntegerField('Total Packages'),
                    new IntegerField('Total Units'),
                    new IntegerField('Price/Unit'),
                    new IntegerField('Total Price'),
                    new IntegerField('Activity Pkgs Debit'),
                    new IntegerField('Activity Pkgs Credit'),
                    new IntegerField('Activity Units Debit'),
                    new IntegerField('Activity Units Credit'),
                    new IntegerField('Committed Pkg Qty'),
                    new IntegerField('Committed Unit Qty'),
                    new StringField('User'),
                    new StringField('Notes'),
                    new StringField('Description'),
                    new StringField('Keg'),
                    new StringField('GrainYield'),
                    new StringField('Usage'),
                    new StringField('Category'),
                    new StringField('Format'),
                    new StringField('Potential Yield'),
                    new StringField('DeviceID'),
                    new StringField('DeviceName')
                )
            );
            $this->dataset->AddLookupField('Inventory Item', 'InventoryItems', new StringField('Inventory Item'), new IntegerField('id', false, false, false, false, 'Inventory Item_id', 'Inventory Item_id_InventoryItems'), 'Inventory Item_id_InventoryItems');
            $this->dataset->AddLookupField('Template', 'Templates', new StringField('Template'), new IntegerField('id', false, false, false, false, 'Template_id', 'Template_id_Templates'), 'Template_id_Templates');
            $this->dataset->AddLookupField('Batch', 'Batches', new StringField('Batch'), new IntegerField('id', false, false, false, false, 'Batch_id', 'Batch_id_Batches'), 'Batch_id_Batches');
            $this->dataset->AddLookupField('Brew', 'Brews', new StringField('Brew'), new IntegerField('id', false, false, false, false, 'Brew_id', 'Brew_id_Brews'), 'Brew_id_Brews');
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
    
        protected function CreateRssGenerator()
        {
            return null;
        }
    
        protected function setupCharts()
        {
    
        }
    
        protected function getFiltersColumns()
        {
            return array(
                new FilterColumn($this->dataset, 'id', 'id', 'Id'),
                new FilterColumn($this->dataset, 'updated', 'updated', 'Updated'),
                new FilterColumn($this->dataset, 'Inventory Item', 'Inventory Item_id', 'Inventory Item'),
                new FilterColumn($this->dataset, 'Template', 'Template_id', 'Template'),
                new FilterColumn($this->dataset, 'Batch', 'Batch_id', 'Batch'),
                new FilterColumn($this->dataset, 'Brew', 'Brew_id', 'Brew'),
                new FilterColumn($this->dataset, 'PackageLog', 'PackageLog', 'Package Log'),
                new FilterColumn($this->dataset, 'Order ID', 'Order ID', 'Order ID'),
                new FilterColumn($this->dataset, 'Committed', 'Committed', 'Committed'),
                new FilterColumn($this->dataset, 'Activity Date', 'Activity Date', 'Activity Date'),
                new FilterColumn($this->dataset, 'Vendor', 'Vendor', 'Vendor'),
                new FilterColumn($this->dataset, 'Entry Type', 'Entry Type', 'Entry Type'),
                new FilterColumn($this->dataset, 'Unit of Measure', 'Unit of Measure', 'Unit Of Measure'),
                new FilterColumn($this->dataset, 'Pkg Type', 'Pkg Type', 'Pkg Type'),
                new FilterColumn($this->dataset, 'Activity', 'Activity', 'Activity'),
                new FilterColumn($this->dataset, 'Units per Pkg', 'Units per Pkg', 'Units Per Pkg'),
                new FilterColumn($this->dataset, 'Activity Pkg Qty', 'Activity Pkg Qty', 'Activity Pkg Qty'),
                new FilterColumn($this->dataset, 'Activity Unit Qty', 'Activity Unit Qty', 'Activity Unit Qty'),
                new FilterColumn($this->dataset, 'Total Packages', 'Total Packages', 'Total Packages'),
                new FilterColumn($this->dataset, 'Total Units', 'Total Units', 'Total Units'),
                new FilterColumn($this->dataset, 'Price/Unit', 'Price/Unit', 'Price/Unit'),
                new FilterColumn($this->dataset, 'Total Price', 'Total Price', 'Total Price'),
                new FilterColumn($this->dataset, 'Activity Pkgs Debit', 'Activity Pkgs Debit', 'Activity Pkgs Debit'),
                new FilterColumn($this->dataset, 'Activity Pkgs Credit', 'Activity Pkgs Credit', 'Activity Pkgs Credit'),
                new FilterColumn($this->dataset, 'Activity Units Debit', 'Activity Units Debit', 'Activity Units Debit'),
                new FilterColumn($this->dataset, 'Activity Units Credit', 'Activity Units Credit', 'Activity Units Credit'),
                new FilterColumn($this->dataset, 'Committed Pkg Qty', 'Committed Pkg Qty', 'Committed Pkg Qty'),
                new FilterColumn($this->dataset, 'Committed Unit Qty', 'Committed Unit Qty', 'Committed Unit Qty'),
                new FilterColumn($this->dataset, 'User', 'User', 'User'),
                new FilterColumn($this->dataset, 'Notes', 'Notes', 'Notes'),
                new FilterColumn($this->dataset, 'Description', 'Description', 'Description'),
                new FilterColumn($this->dataset, 'Keg', 'Keg', 'Keg'),
                new FilterColumn($this->dataset, 'GrainYield', 'GrainYield', 'Grain Yield'),
                new FilterColumn($this->dataset, 'Usage', 'Usage', 'Usage'),
                new FilterColumn($this->dataset, 'Category', 'Category', 'Category'),
                new FilterColumn($this->dataset, 'Format', 'Format', 'Format'),
                new FilterColumn($this->dataset, 'Potential Yield', 'Potential Yield', 'Potential Yield'),
                new FilterColumn($this->dataset, 'DeviceID', 'DeviceID', 'Device ID'),
                new FilterColumn($this->dataset, 'DeviceName', 'DeviceName', 'Device Name')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['id'])
                ->addColumn($columns['updated'])
                ->addColumn($columns['Inventory Item'])
                ->addColumn($columns['Template'])
                ->addColumn($columns['Batch'])
                ->addColumn($columns['Brew'])
                ->addColumn($columns['PackageLog'])
                ->addColumn($columns['Order ID'])
                ->addColumn($columns['Committed'])
                ->addColumn($columns['Activity Date'])
                ->addColumn($columns['Vendor'])
                ->addColumn($columns['Entry Type'])
                ->addColumn($columns['Unit of Measure'])
                ->addColumn($columns['Pkg Type'])
                ->addColumn($columns['Activity'])
                ->addColumn($columns['Units per Pkg'])
                ->addColumn($columns['Activity Pkg Qty'])
                ->addColumn($columns['Activity Unit Qty'])
                ->addColumn($columns['Total Packages'])
                ->addColumn($columns['Total Units'])
                ->addColumn($columns['Price/Unit'])
                ->addColumn($columns['Total Price'])
                ->addColumn($columns['Activity Pkgs Debit'])
                ->addColumn($columns['Activity Pkgs Credit'])
                ->addColumn($columns['Activity Units Debit'])
                ->addColumn($columns['Activity Units Credit'])
                ->addColumn($columns['Committed Pkg Qty'])
                ->addColumn($columns['Committed Unit Qty'])
                ->addColumn($columns['User'])
                ->addColumn($columns['Notes'])
                ->addColumn($columns['Description'])
                ->addColumn($columns['Keg'])
                ->addColumn($columns['GrainYield'])
                ->addColumn($columns['Usage'])
                ->addColumn($columns['Category'])
                ->addColumn($columns['Format'])
                ->addColumn($columns['Potential Yield'])
                ->addColumn($columns['DeviceID'])
                ->addColumn($columns['DeviceName']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('updated')
                ->setOptionsFor('Inventory Item')
                ->setOptionsFor('Template')
                ->setOptionsFor('Batch')
                ->setOptionsFor('Brew')
                ->setOptionsFor('Activity Date');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new TextEdit('id_edit');
            
            $filterBuilder->addColumn(
                $columns['id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('updated_edit', false, 'Y-m-d H:i:s');
            
            $filterBuilder->addColumn(
                $columns['updated'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('inventory_item_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_Brews_InventoryActivities_Inventory Item_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('Inventory Item', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_Brews_InventoryActivities_Inventory Item_search');
            
            $filterBuilder->addColumn(
                $columns['Inventory Item'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('template_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_Brews_InventoryActivities_Template_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('Template', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_Brews_InventoryActivities_Template_search');
            
            $filterBuilder->addColumn(
                $columns['Template'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('batch_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_Brews_InventoryActivities_Batch_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('Batch', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_Brews_InventoryActivities_Batch_search');
            
            $filterBuilder->addColumn(
                $columns['Batch'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('brew_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_Brews_InventoryActivities_Brew_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('Brew', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_Brews_InventoryActivities_Brew_search');
            
            $filterBuilder->addColumn(
                $columns['Brew'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('PackageLog');
            
            $filterBuilder->addColumn(
                $columns['PackageLog'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('order_id_edit');
            
            $filterBuilder->addColumn(
                $columns['Order ID'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('committed_edit');
            
            $filterBuilder->addColumn(
                $columns['Committed'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('activity_date_edit', false, 'Y-m-d');
            
            $filterBuilder->addColumn(
                $columns['Activity Date'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('Vendor');
            
            $filterBuilder->addColumn(
                $columns['Vendor'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('Entry Type');
            
            $filterBuilder->addColumn(
                $columns['Entry Type'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('Unit of Measure');
            
            $filterBuilder->addColumn(
                $columns['Unit of Measure'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('Pkg Type');
            
            $filterBuilder->addColumn(
                $columns['Pkg Type'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('Activity');
            
            $filterBuilder->addColumn(
                $columns['Activity'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('units_per_pkg_edit');
            
            $filterBuilder->addColumn(
                $columns['Units per Pkg'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('activity_pkg_qty_edit');
            
            $filterBuilder->addColumn(
                $columns['Activity Pkg Qty'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('activity_unit_qty_edit');
            
            $filterBuilder->addColumn(
                $columns['Activity Unit Qty'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('total_packages_edit');
            
            $filterBuilder->addColumn(
                $columns['Total Packages'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('total_units_edit');
            
            $filterBuilder->addColumn(
                $columns['Total Units'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('price/unit_edit');
            
            $filterBuilder->addColumn(
                $columns['Price/Unit'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('total_price_edit');
            
            $filterBuilder->addColumn(
                $columns['Total Price'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('activity_pkgs_debit_edit');
            
            $filterBuilder->addColumn(
                $columns['Activity Pkgs Debit'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('activity_pkgs_credit_edit');
            
            $filterBuilder->addColumn(
                $columns['Activity Pkgs Credit'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('activity_units_debit_edit');
            
            $filterBuilder->addColumn(
                $columns['Activity Units Debit'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('activity_units_credit_edit');
            
            $filterBuilder->addColumn(
                $columns['Activity Units Credit'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('committed_pkg_qty_edit');
            
            $filterBuilder->addColumn(
                $columns['Committed Pkg Qty'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('committed_unit_qty_edit');
            
            $filterBuilder->addColumn(
                $columns['Committed Unit Qty'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('User');
            
            $filterBuilder->addColumn(
                $columns['User'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('Notes');
            
            $filterBuilder->addColumn(
                $columns['Notes'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('Description');
            
            $filterBuilder->addColumn(
                $columns['Description'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('Keg');
            
            $filterBuilder->addColumn(
                $columns['Keg'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('GrainYield');
            
            $filterBuilder->addColumn(
                $columns['GrainYield'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('Usage');
            
            $filterBuilder->addColumn(
                $columns['Usage'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('Category');
            
            $filterBuilder->addColumn(
                $columns['Category'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('Format');
            
            $filterBuilder->addColumn(
                $columns['Format'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('Potential Yield');
            
            $filterBuilder->addColumn(
                $columns['Potential Yield'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('DeviceID');
            
            $filterBuilder->addColumn(
                $columns['DeviceID'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('DeviceName');
            
            $filterBuilder->addColumn(
                $columns['DeviceName'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
            $actions = $grid->getActions();
            $actions->setCaption($this->GetLocalizerCaptions()->GetMessageString('Actions'));
            $actions->setPosition(ActionList::POSITION_LEFT);
            
            if ($this->GetSecurityInfo()->HasViewGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('View'), OPERATION_VIEW, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
            
            if ($this->GetSecurityInfo()->HasEditGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Edit'), OPERATION_EDIT, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowEditButtonHandler', $this);
            }
            
            if ($this->deleteOperationIsAllowed()) {
                $operation = new AjaxOperation(OPERATION_DELETE,
                    $this->GetLocalizerCaptions()->GetMessageString('Delete'),
                    $this->GetLocalizerCaptions()->GetMessageString('Delete'), $this->dataset,
                    $this->GetModalGridDeleteHandler(), $grid
                );
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowDeleteButtonHandler', $this);
            }
            
            
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Copy'), OPERATION_COPY, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
        }
    
        protected function AddFieldColumns(Grid $grid, $withDetails = true)
        {
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for updated field
            //
            $column = new DateTimeViewColumn('updated', 'updated', 'Updated', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for id field
            //
            $column = new NumberViewColumn('Inventory Item', 'Inventory Item_id', 'Inventory Item', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for id field
            //
            $column = new NumberViewColumn('Template', 'Template_id', 'Template', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for id field
            //
            $column = new NumberViewColumn('Batch', 'Batch_id', 'Batch', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for id field
            //
            $column = new NumberViewColumn('Brew', 'Brew_id', 'Brew', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for PackageLog field
            //
            $column = new TextViewColumn('PackageLog', 'PackageLog', 'Package Log', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Order ID field
            //
            $column = new NumberViewColumn('Order ID', 'Order ID', 'Order ID', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Committed field
            //
            $column = new NumberViewColumn('Committed', 'Committed', 'Committed', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Activity Date field
            //
            $column = new DateTimeViewColumn('Activity Date', 'Activity Date', 'Activity Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Vendor field
            //
            $column = new TextViewColumn('Vendor', 'Vendor', 'Vendor', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Entry Type field
            //
            $column = new TextViewColumn('Entry Type', 'Entry Type', 'Entry Type', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Unit of Measure field
            //
            $column = new TextViewColumn('Unit of Measure', 'Unit of Measure', 'Unit Of Measure', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Pkg Type field
            //
            $column = new TextViewColumn('Pkg Type', 'Pkg Type', 'Pkg Type', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Activity field
            //
            $column = new TextViewColumn('Activity', 'Activity', 'Activity', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Units per Pkg field
            //
            $column = new NumberViewColumn('Units per Pkg', 'Units per Pkg', 'Units Per Pkg', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Activity Pkg Qty field
            //
            $column = new NumberViewColumn('Activity Pkg Qty', 'Activity Pkg Qty', 'Activity Pkg Qty', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Activity Unit Qty field
            //
            $column = new NumberViewColumn('Activity Unit Qty', 'Activity Unit Qty', 'Activity Unit Qty', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Total Packages field
            //
            $column = new NumberViewColumn('Total Packages', 'Total Packages', 'Total Packages', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Total Units field
            //
            $column = new NumberViewColumn('Total Units', 'Total Units', 'Total Units', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Price/Unit field
            //
            $column = new NumberViewColumn('Price/Unit', 'Price/Unit', 'Price/Unit', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Total Price field
            //
            $column = new NumberViewColumn('Total Price', 'Total Price', 'Total Price', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Activity Pkgs Debit field
            //
            $column = new NumberViewColumn('Activity Pkgs Debit', 'Activity Pkgs Debit', 'Activity Pkgs Debit', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Activity Pkgs Credit field
            //
            $column = new NumberViewColumn('Activity Pkgs Credit', 'Activity Pkgs Credit', 'Activity Pkgs Credit', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Activity Units Debit field
            //
            $column = new NumberViewColumn('Activity Units Debit', 'Activity Units Debit', 'Activity Units Debit', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Activity Units Credit field
            //
            $column = new NumberViewColumn('Activity Units Credit', 'Activity Units Credit', 'Activity Units Credit', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Committed Pkg Qty field
            //
            $column = new NumberViewColumn('Committed Pkg Qty', 'Committed Pkg Qty', 'Committed Pkg Qty', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Committed Unit Qty field
            //
            $column = new NumberViewColumn('Committed Unit Qty', 'Committed Unit Qty', 'Committed Unit Qty', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for User field
            //
            $column = new TextViewColumn('User', 'User', 'User', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Notes field
            //
            $column = new TextViewColumn('Notes', 'Notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Description field
            //
            $column = new TextViewColumn('Description', 'Description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Keg field
            //
            $column = new TextViewColumn('Keg', 'Keg', 'Keg', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for GrainYield field
            //
            $column = new TextViewColumn('GrainYield', 'GrainYield', 'Grain Yield', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Usage field
            //
            $column = new TextViewColumn('Usage', 'Usage', 'Usage', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Category field
            //
            $column = new TextViewColumn('Category', 'Category', 'Category', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Format field
            //
            $column = new TextViewColumn('Format', 'Format', 'Format', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Potential Yield field
            //
            $column = new TextViewColumn('Potential Yield', 'Potential Yield', 'Potential Yield', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for DeviceID field
            //
            $column = new TextViewColumn('DeviceID', 'DeviceID', 'Device ID', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for DeviceName field
            //
            $column = new TextViewColumn('DeviceName', 'DeviceName', 'Device Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for updated field
            //
            $column = new DateTimeViewColumn('updated', 'updated', 'Updated', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for id field
            //
            $column = new NumberViewColumn('Inventory Item', 'Inventory Item_id', 'Inventory Item', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for id field
            //
            $column = new NumberViewColumn('Template', 'Template_id', 'Template', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for id field
            //
            $column = new NumberViewColumn('Batch', 'Batch_id', 'Batch', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for id field
            //
            $column = new NumberViewColumn('Brew', 'Brew_id', 'Brew', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for PackageLog field
            //
            $column = new TextViewColumn('PackageLog', 'PackageLog', 'Package Log', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Order ID field
            //
            $column = new NumberViewColumn('Order ID', 'Order ID', 'Order ID', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Committed field
            //
            $column = new NumberViewColumn('Committed', 'Committed', 'Committed', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Activity Date field
            //
            $column = new DateTimeViewColumn('Activity Date', 'Activity Date', 'Activity Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Vendor field
            //
            $column = new TextViewColumn('Vendor', 'Vendor', 'Vendor', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Entry Type field
            //
            $column = new TextViewColumn('Entry Type', 'Entry Type', 'Entry Type', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Unit of Measure field
            //
            $column = new TextViewColumn('Unit of Measure', 'Unit of Measure', 'Unit Of Measure', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Pkg Type field
            //
            $column = new TextViewColumn('Pkg Type', 'Pkg Type', 'Pkg Type', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Activity field
            //
            $column = new TextViewColumn('Activity', 'Activity', 'Activity', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Units per Pkg field
            //
            $column = new NumberViewColumn('Units per Pkg', 'Units per Pkg', 'Units Per Pkg', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Activity Pkg Qty field
            //
            $column = new NumberViewColumn('Activity Pkg Qty', 'Activity Pkg Qty', 'Activity Pkg Qty', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Activity Unit Qty field
            //
            $column = new NumberViewColumn('Activity Unit Qty', 'Activity Unit Qty', 'Activity Unit Qty', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Total Packages field
            //
            $column = new NumberViewColumn('Total Packages', 'Total Packages', 'Total Packages', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Total Units field
            //
            $column = new NumberViewColumn('Total Units', 'Total Units', 'Total Units', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Price/Unit field
            //
            $column = new NumberViewColumn('Price/Unit', 'Price/Unit', 'Price/Unit', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Total Price field
            //
            $column = new NumberViewColumn('Total Price', 'Total Price', 'Total Price', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Activity Pkgs Debit field
            //
            $column = new NumberViewColumn('Activity Pkgs Debit', 'Activity Pkgs Debit', 'Activity Pkgs Debit', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Activity Pkgs Credit field
            //
            $column = new NumberViewColumn('Activity Pkgs Credit', 'Activity Pkgs Credit', 'Activity Pkgs Credit', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Activity Units Debit field
            //
            $column = new NumberViewColumn('Activity Units Debit', 'Activity Units Debit', 'Activity Units Debit', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Activity Units Credit field
            //
            $column = new NumberViewColumn('Activity Units Credit', 'Activity Units Credit', 'Activity Units Credit', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Committed Pkg Qty field
            //
            $column = new NumberViewColumn('Committed Pkg Qty', 'Committed Pkg Qty', 'Committed Pkg Qty', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Committed Unit Qty field
            //
            $column = new NumberViewColumn('Committed Unit Qty', 'Committed Unit Qty', 'Committed Unit Qty', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for User field
            //
            $column = new TextViewColumn('User', 'User', 'User', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Notes field
            //
            $column = new TextViewColumn('Notes', 'Notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Description field
            //
            $column = new TextViewColumn('Description', 'Description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Keg field
            //
            $column = new TextViewColumn('Keg', 'Keg', 'Keg', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for GrainYield field
            //
            $column = new TextViewColumn('GrainYield', 'GrainYield', 'Grain Yield', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Usage field
            //
            $column = new TextViewColumn('Usage', 'Usage', 'Usage', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Category field
            //
            $column = new TextViewColumn('Category', 'Category', 'Category', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Format field
            //
            $column = new TextViewColumn('Format', 'Format', 'Format', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Potential Yield field
            //
            $column = new TextViewColumn('Potential Yield', 'Potential Yield', 'Potential Yield', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for DeviceID field
            //
            $column = new TextViewColumn('DeviceID', 'DeviceID', 'Device ID', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for DeviceName field
            //
            $column = new TextViewColumn('DeviceName', 'DeviceName', 'Device Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for updated field
            //
            $editor = new DateTimeEdit('updated_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Updated', 'updated', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Inventory Item field
            //
            $editor = new DynamicCombobox('inventory_item_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`InventoryItems`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new DateTimeField('updated', true),
                    new StringField('Item ID'),
                    new StringField('Inventory Item', true, true),
                    new IntegerField('Price/Unit'),
                    new StringField('Active'),
                    new StringField('Label Name from Template'),
                    new StringField('Brand from Template'),
                    new StringField('Brand from Item'),
                    new StringField('BeerSmith Name'),
                    new StringField('Brand'),
                    new StringField('Product Name'),
                    new StringField('Category'),
                    new StringField('Notes'),
                    new StringField('Pkg Type'),
                    new StringField('Qty per Pkg'),
                    new StringField('Unit of Measure'),
                    new StringField('Image'),
                    new StringField('Image : URL'),
                    new IntegerField('Activity Pkg Sum'),
                    new IntegerField('Activity Units (Calc)'),
                    new IntegerField('Activity Units (Sum)'),
                    new StringField('Inventory Pkgs'),
                    new IntegerField('Inventory Units'),
                    new IntegerField('Inventory Value'),
                    new StringField('Qty Description'),
                    new StringField('Activities'),
                    new IntegerField('Inventory - Order'),
                    new IntegerField('Inventory - Warning'),
                    new IntegerField('Inventory - Critical'),
                    new StringField('Orders Pending'),
                    new StringField('Inventory Level'),
                    new StringField('Re-Order Status'),
                    new StringField('Used past 30 days'),
                    new StringField('Alpha Acids'),
                    new StringField('GrainYield'),
                    new StringField('Format'),
                    new StringField('Attachment'),
                    new StringField('Attachment : URL')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Inventory Item', 'Inventory Item', 'Inventory Item_id', 'edit_Brews_InventoryActivities_Inventory Item_search', $editor, $this->dataset, $lookupDataset, 'Inventory Item', 'id', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Template field
            //
            $editor = new DynamicCombobox('template_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`Templates`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new DateTimeField('updated', true),
                    new StringField('Template', true, true),
                    new StringField('Brand/Name', true),
                    new StringField('Style'),
                    new IntegerField('Color'),
                    new IntegerField('IBU'),
                    new IntegerField('OG_Avg'),
                    new IntegerField('OG_Override'),
                    new IntegerField('OG_Eq'),
                    new IntegerField('ABV_Avg'),
                    new IntegerField('ABV_Avg_Dec'),
                    new IntegerField('ABV_Eq'),
                    new IntegerField('Attenuation_Override'),
                    new IntegerField('Attenuation_Override_Dec'),
                    new IntegerField('Attenuation_Avg'),
                    new IntegerField('Attenuation_Avg_Dec'),
                    new IntegerField('Attenuation_Eq'),
                    new IntegerField('FG_Eq'),
                    new StringField('Notes'),
                    new IntegerField('Batches')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Template', 'Template', 'Template_id', 'edit_Brews_InventoryActivities_Template_search', $editor, $this->dataset, $lookupDataset, 'Template', 'id', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Batch field
            //
            $editor = new DynamicCombobox('batch_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`Batches`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new DateTimeField('updated', true),
                    new IntegerField('BatchID', true),
                    new StringField('Template', true),
                    new StringField('Batch', true, true),
                    new DateField('Brew Date'),
                    new IntegerField('Ingredient_Cnt'),
                    new IntegerField('Brews-Records'),
                    new StringField('Brews Blended from this Batch'),
                    new StringField('Brews Blended into this Batch'),
                    new IntegerField('Brews'),
                    new IntegerField('Total Brews Calc 1'),
                    new IntegerField('Total Brews Calc 2'),
                    new DateField('Brew Date Start Calc 1'),
                    new DateField('Brew Date End Calc 1'),
                    new DateField('Brew Date Start Calc 2'),
                    new DateField('Brew Date End Calc 2'),
                    new DateField('Brew Date Start'),
                    new DateField('Brew Date End'),
                    new IntegerField('Brew Days'),
                    new IntegerField('Total Brews (Net)'),
                    new StringField('ProPitch'),
                    new StringField('Yeast'),
                    new StringField('Yeast Source'),
                    new StringField('Yeast from FV'),
                    new StringField('Nickname'),
                    new StringField('Status'),
                    new StringField('Batch-Status'),
                    new StringField('Days Running 1'),
                    new StringField('Days Running 2'),
                    new StringField('Style'),
                    new StringField('FV'),
                    new StringField('FV Tank'),
                    new StringField('BT'),
                    new StringField('BT Tank'),
                    new StringField('Current Tank'),
                    new StringField('Bbls'),
                    new StringField('Color'),
                    new StringField('IBU'),
                    new StringField('OG-A'),
                    new StringField('OG-B'),
                    new StringField('OG-C'),
                    new StringField('OG-D'),
                    new StringField('OG-AB'),
                    new StringField('OG-ABC'),
                    new StringField('OG-ABCD'),
                    new StringField('OG'),
                    new StringField('FG_Min'),
                    new StringField('Current Gravity'),
                    new StringField('FG'),
                    new StringField('ABV'),
                    new StringField('Attenuation'),
                    new StringField('Yeast Pitch'),
                    new StringField('Blend Ratio'),
                    new StringField('Notes'),
                    new StringField('Status2'),
                    new StringField('Dry Hop Date'),
                    new StringField('Dry Hop Date Formula'),
                    new StringField('Crash Date'),
                    new StringField('Brite Tank Date'),
                    new StringField('Gone Date'),
                    new StringField('Dry Hop Days'),
                    new StringField('Total Days'),
                    new StringField('Dry Hopped Running'),
                    new StringField('User'),
                    new StringField('Maximum CO2'),
                    new StringField('CO2 Volumes'),
                    new StringField('This Batch Blended into Batch'),
                    new StringField('Batches Blended into this Batch'),
                    new StringField('Calculated Days'),
                    new StringField('Blended'),
                    new StringField('TankLog Count'),
                    new StringField('KegLog Count'),
                    new StringField('Kegs Count'),
                    new StringField('PackageLog Count'),
                    new StringField('KegOrders Count'),
                    new StringField('Net Bbls'),
                    new StringField('Canned & Kegged Barrels'),
                    new StringField('Canning Runs'),
                    new StringField('5G Kegs'),
                    new StringField('50L Kegs'),
                    new StringField('Brews-Bbls'),
                    new StringField('Brews-OG'),
                    new StringField('Net Beer Factor'),
                    new StringField('Batch Gross Bbls Calc'),
                    new StringField('Gross Bbls'),
                    new StringField('Remaining Bbls Calc'),
                    new StringField('Remaining Bbls (Est)'),
                    new StringField('Can Be Deleted'),
                    new StringField('Brews from Template'),
                    new StringField('FermStart-DateCalc'),
                    new StringField('FermStart-DateCalc2'),
                    new StringField('FermEnd-DateCalc'),
                    new StringField('FermEnd-DateCalc2'),
                    new StringField('Ferm-DateCalc'),
                    new StringField('Ferm-DateCalc2'),
                    new StringField('FermEnd-DateDayNumber'),
                    new StringField('DryHop-DateDayAdd'),
                    new StringField('Dryhop-DateCalc'),
                    new StringField('Dryhop-DateDayNumber'),
                    new StringField('Crash-DateDayAdd'),
                    new StringField('Crash-DateCalc'),
                    new StringField('Crash-DateDayNumber'),
                    new StringField('Transfer-DateDayAdd'),
                    new StringField('Transfer-DateCalc'),
                    new StringField('Transfer-DateDayNumber'),
                    new StringField('Package-DateDayAdd'),
                    new StringField('Package-DateCalc'),
                    new StringField('Scheduled Steps'),
                    new StringField('Steps Remaining'),
                    new StringField('PropCrash-DateCalc'),
                    new StringField('PropTrans-DateCalc'),
                    new StringField('Brew Size (Gallons)'),
                    new StringField('Brew % of 7Bbl'),
                    new StringField('Sum - Potential Yield'),
                    new StringField('Potential OG'),
                    new StringField('Efficiency'),
                    new StringField('Ratings'),
                    new StringField('CurrentTank_Name'),
                    new DateField('Canned'),
                    new StringField('PendingActivities'),
                    new StringField('TempLogsCount'),
                    new StringField('Rating')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Batch', 'Batch', 'Batch_id', 'edit_Brews_InventoryActivities_Batch_search', $editor, $this->dataset, $lookupDataset, 'Batch', 'id', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Brew field
            //
            $editor = new DynamicCombobox('brew_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`Brews`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new DateTimeField('updated', true),
                    new StringField('Batch', true),
                    new StringField('Brew ID', true),
                    new StringField('Brew', true, true),
                    new DateField('Brew Date', true),
                    new StringField('Status'),
                    new IntegerField('Mash Temp'),
                    new IntegerField('Lactic Acid'),
                    new IntegerField('Preboil Grav'),
                    new IntegerField('OG'),
                    new IntegerField('pH-Mash'),
                    new IntegerField('pH-First'),
                    new IntegerField('pH-Last'),
                    new IntegerField('pH-Pre boil'),
                    new IntegerField('pH-KO'),
                    new StringField('O2 Setting'),
                    new IntegerField('DO-Line'),
                    new IntegerField('DO-Tank'),
                    new StringField('Notes'),
                    new StringField('User'),
                    new IntegerField('Bbls')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Brew', 'Brew', 'Brew_id', 'edit_Brews_InventoryActivities_Brew_search', $editor, $this->dataset, $lookupDataset, 'Brew', 'id', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for PackageLog field
            //
            $editor = new TextAreaEdit('packagelog_edit', 50, 8);
            $editColumn = new CustomEditColumn('Package Log', 'PackageLog', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Order ID field
            //
            $editor = new TextEdit('order_id_edit');
            $editColumn = new CustomEditColumn('Order ID', 'Order ID', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Committed field
            //
            $editor = new TextEdit('committed_edit');
            $editColumn = new CustomEditColumn('Committed', 'Committed', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Activity Date field
            //
            $editor = new DateTimeEdit('activity_date_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Activity Date', 'Activity Date', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Vendor field
            //
            $editor = new TextAreaEdit('vendor_edit', 50, 8);
            $editColumn = new CustomEditColumn('Vendor', 'Vendor', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Entry Type field
            //
            $editor = new TextAreaEdit('entry_type_edit', 50, 8);
            $editColumn = new CustomEditColumn('Entry Type', 'Entry Type', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Unit of Measure field
            //
            $editor = new TextAreaEdit('unit_of_measure_edit', 50, 8);
            $editColumn = new CustomEditColumn('Unit Of Measure', 'Unit of Measure', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Pkg Type field
            //
            $editor = new TextAreaEdit('pkg_type_edit', 50, 8);
            $editColumn = new CustomEditColumn('Pkg Type', 'Pkg Type', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Activity field
            //
            $editor = new TextAreaEdit('activity_edit', 50, 8);
            $editColumn = new CustomEditColumn('Activity', 'Activity', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Units per Pkg field
            //
            $editor = new TextEdit('units_per_pkg_edit');
            $editColumn = new CustomEditColumn('Units Per Pkg', 'Units per Pkg', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Activity Pkg Qty field
            //
            $editor = new TextEdit('activity_pkg_qty_edit');
            $editColumn = new CustomEditColumn('Activity Pkg Qty', 'Activity Pkg Qty', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Activity Unit Qty field
            //
            $editor = new TextEdit('activity_unit_qty_edit');
            $editColumn = new CustomEditColumn('Activity Unit Qty', 'Activity Unit Qty', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Total Packages field
            //
            $editor = new TextEdit('total_packages_edit');
            $editColumn = new CustomEditColumn('Total Packages', 'Total Packages', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Total Units field
            //
            $editor = new TextEdit('total_units_edit');
            $editColumn = new CustomEditColumn('Total Units', 'Total Units', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Price/Unit field
            //
            $editor = new TextEdit('price/unit_edit');
            $editColumn = new CustomEditColumn('Price/Unit', 'Price/Unit', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Total Price field
            //
            $editor = new TextEdit('total_price_edit');
            $editColumn = new CustomEditColumn('Total Price', 'Total Price', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Activity Pkgs Debit field
            //
            $editor = new TextEdit('activity_pkgs_debit_edit');
            $editColumn = new CustomEditColumn('Activity Pkgs Debit', 'Activity Pkgs Debit', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Activity Pkgs Credit field
            //
            $editor = new TextEdit('activity_pkgs_credit_edit');
            $editColumn = new CustomEditColumn('Activity Pkgs Credit', 'Activity Pkgs Credit', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Activity Units Debit field
            //
            $editor = new TextEdit('activity_units_debit_edit');
            $editColumn = new CustomEditColumn('Activity Units Debit', 'Activity Units Debit', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Activity Units Credit field
            //
            $editor = new TextEdit('activity_units_credit_edit');
            $editColumn = new CustomEditColumn('Activity Units Credit', 'Activity Units Credit', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Committed Pkg Qty field
            //
            $editor = new TextEdit('committed_pkg_qty_edit');
            $editColumn = new CustomEditColumn('Committed Pkg Qty', 'Committed Pkg Qty', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Committed Unit Qty field
            //
            $editor = new TextEdit('committed_unit_qty_edit');
            $editColumn = new CustomEditColumn('Committed Unit Qty', 'Committed Unit Qty', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for User field
            //
            $editor = new TextAreaEdit('user_edit', 50, 8);
            $editColumn = new CustomEditColumn('User', 'User', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Notes field
            //
            $editor = new TextAreaEdit('notes_edit', 50, 8);
            $editColumn = new CustomEditColumn('Notes', 'Notes', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Description field
            //
            $editor = new TextAreaEdit('description_edit', 50, 8);
            $editColumn = new CustomEditColumn('Description', 'Description', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Keg field
            //
            $editor = new TextAreaEdit('keg_edit', 50, 8);
            $editColumn = new CustomEditColumn('Keg', 'Keg', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for GrainYield field
            //
            $editor = new TextAreaEdit('grainyield_edit', 50, 8);
            $editColumn = new CustomEditColumn('Grain Yield', 'GrainYield', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Usage field
            //
            $editor = new TextAreaEdit('usage_edit', 50, 8);
            $editColumn = new CustomEditColumn('Usage', 'Usage', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Category field
            //
            $editor = new TextAreaEdit('category_edit', 50, 8);
            $editColumn = new CustomEditColumn('Category', 'Category', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Format field
            //
            $editor = new TextAreaEdit('format_edit', 50, 8);
            $editColumn = new CustomEditColumn('Format', 'Format', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Potential Yield field
            //
            $editor = new TextAreaEdit('potential_yield_edit', 50, 8);
            $editColumn = new CustomEditColumn('Potential Yield', 'Potential Yield', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for DeviceID field
            //
            $editor = new TextAreaEdit('deviceid_edit', 50, 8);
            $editColumn = new CustomEditColumn('Device ID', 'DeviceID', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for DeviceName field
            //
            $editor = new TextAreaEdit('devicename_edit', 50, 8);
            $editColumn = new CustomEditColumn('Device Name', 'DeviceName', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for updated field
            //
            $editor = new DateTimeEdit('updated_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Updated', 'updated', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Inventory Item field
            //
            $editor = new DynamicCombobox('inventory_item_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`InventoryItems`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new DateTimeField('updated', true),
                    new StringField('Item ID'),
                    new StringField('Inventory Item', true, true),
                    new IntegerField('Price/Unit'),
                    new StringField('Active'),
                    new StringField('Label Name from Template'),
                    new StringField('Brand from Template'),
                    new StringField('Brand from Item'),
                    new StringField('BeerSmith Name'),
                    new StringField('Brand'),
                    new StringField('Product Name'),
                    new StringField('Category'),
                    new StringField('Notes'),
                    new StringField('Pkg Type'),
                    new StringField('Qty per Pkg'),
                    new StringField('Unit of Measure'),
                    new StringField('Image'),
                    new StringField('Image : URL'),
                    new IntegerField('Activity Pkg Sum'),
                    new IntegerField('Activity Units (Calc)'),
                    new IntegerField('Activity Units (Sum)'),
                    new StringField('Inventory Pkgs'),
                    new IntegerField('Inventory Units'),
                    new IntegerField('Inventory Value'),
                    new StringField('Qty Description'),
                    new StringField('Activities'),
                    new IntegerField('Inventory - Order'),
                    new IntegerField('Inventory - Warning'),
                    new IntegerField('Inventory - Critical'),
                    new StringField('Orders Pending'),
                    new StringField('Inventory Level'),
                    new StringField('Re-Order Status'),
                    new StringField('Used past 30 days'),
                    new StringField('Alpha Acids'),
                    new StringField('GrainYield'),
                    new StringField('Format'),
                    new StringField('Attachment'),
                    new StringField('Attachment : URL')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Inventory Item', 'Inventory Item', 'Inventory Item_id', 'multi_edit_Brews_InventoryActivities_Inventory Item_search', $editor, $this->dataset, $lookupDataset, 'Inventory Item', 'id', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Template field
            //
            $editor = new DynamicCombobox('template_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`Templates`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new DateTimeField('updated', true),
                    new StringField('Template', true, true),
                    new StringField('Brand/Name', true),
                    new StringField('Style'),
                    new IntegerField('Color'),
                    new IntegerField('IBU'),
                    new IntegerField('OG_Avg'),
                    new IntegerField('OG_Override'),
                    new IntegerField('OG_Eq'),
                    new IntegerField('ABV_Avg'),
                    new IntegerField('ABV_Avg_Dec'),
                    new IntegerField('ABV_Eq'),
                    new IntegerField('Attenuation_Override'),
                    new IntegerField('Attenuation_Override_Dec'),
                    new IntegerField('Attenuation_Avg'),
                    new IntegerField('Attenuation_Avg_Dec'),
                    new IntegerField('Attenuation_Eq'),
                    new IntegerField('FG_Eq'),
                    new StringField('Notes'),
                    new IntegerField('Batches')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Template', 'Template', 'Template_id', 'multi_edit_Brews_InventoryActivities_Template_search', $editor, $this->dataset, $lookupDataset, 'Template', 'id', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Batch field
            //
            $editor = new DynamicCombobox('batch_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`Batches`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new DateTimeField('updated', true),
                    new IntegerField('BatchID', true),
                    new StringField('Template', true),
                    new StringField('Batch', true, true),
                    new DateField('Brew Date'),
                    new IntegerField('Ingredient_Cnt'),
                    new IntegerField('Brews-Records'),
                    new StringField('Brews Blended from this Batch'),
                    new StringField('Brews Blended into this Batch'),
                    new IntegerField('Brews'),
                    new IntegerField('Total Brews Calc 1'),
                    new IntegerField('Total Brews Calc 2'),
                    new DateField('Brew Date Start Calc 1'),
                    new DateField('Brew Date End Calc 1'),
                    new DateField('Brew Date Start Calc 2'),
                    new DateField('Brew Date End Calc 2'),
                    new DateField('Brew Date Start'),
                    new DateField('Brew Date End'),
                    new IntegerField('Brew Days'),
                    new IntegerField('Total Brews (Net)'),
                    new StringField('ProPitch'),
                    new StringField('Yeast'),
                    new StringField('Yeast Source'),
                    new StringField('Yeast from FV'),
                    new StringField('Nickname'),
                    new StringField('Status'),
                    new StringField('Batch-Status'),
                    new StringField('Days Running 1'),
                    new StringField('Days Running 2'),
                    new StringField('Style'),
                    new StringField('FV'),
                    new StringField('FV Tank'),
                    new StringField('BT'),
                    new StringField('BT Tank'),
                    new StringField('Current Tank'),
                    new StringField('Bbls'),
                    new StringField('Color'),
                    new StringField('IBU'),
                    new StringField('OG-A'),
                    new StringField('OG-B'),
                    new StringField('OG-C'),
                    new StringField('OG-D'),
                    new StringField('OG-AB'),
                    new StringField('OG-ABC'),
                    new StringField('OG-ABCD'),
                    new StringField('OG'),
                    new StringField('FG_Min'),
                    new StringField('Current Gravity'),
                    new StringField('FG'),
                    new StringField('ABV'),
                    new StringField('Attenuation'),
                    new StringField('Yeast Pitch'),
                    new StringField('Blend Ratio'),
                    new StringField('Notes'),
                    new StringField('Status2'),
                    new StringField('Dry Hop Date'),
                    new StringField('Dry Hop Date Formula'),
                    new StringField('Crash Date'),
                    new StringField('Brite Tank Date'),
                    new StringField('Gone Date'),
                    new StringField('Dry Hop Days'),
                    new StringField('Total Days'),
                    new StringField('Dry Hopped Running'),
                    new StringField('User'),
                    new StringField('Maximum CO2'),
                    new StringField('CO2 Volumes'),
                    new StringField('This Batch Blended into Batch'),
                    new StringField('Batches Blended into this Batch'),
                    new StringField('Calculated Days'),
                    new StringField('Blended'),
                    new StringField('TankLog Count'),
                    new StringField('KegLog Count'),
                    new StringField('Kegs Count'),
                    new StringField('PackageLog Count'),
                    new StringField('KegOrders Count'),
                    new StringField('Net Bbls'),
                    new StringField('Canned & Kegged Barrels'),
                    new StringField('Canning Runs'),
                    new StringField('5G Kegs'),
                    new StringField('50L Kegs'),
                    new StringField('Brews-Bbls'),
                    new StringField('Brews-OG'),
                    new StringField('Net Beer Factor'),
                    new StringField('Batch Gross Bbls Calc'),
                    new StringField('Gross Bbls'),
                    new StringField('Remaining Bbls Calc'),
                    new StringField('Remaining Bbls (Est)'),
                    new StringField('Can Be Deleted'),
                    new StringField('Brews from Template'),
                    new StringField('FermStart-DateCalc'),
                    new StringField('FermStart-DateCalc2'),
                    new StringField('FermEnd-DateCalc'),
                    new StringField('FermEnd-DateCalc2'),
                    new StringField('Ferm-DateCalc'),
                    new StringField('Ferm-DateCalc2'),
                    new StringField('FermEnd-DateDayNumber'),
                    new StringField('DryHop-DateDayAdd'),
                    new StringField('Dryhop-DateCalc'),
                    new StringField('Dryhop-DateDayNumber'),
                    new StringField('Crash-DateDayAdd'),
                    new StringField('Crash-DateCalc'),
                    new StringField('Crash-DateDayNumber'),
                    new StringField('Transfer-DateDayAdd'),
                    new StringField('Transfer-DateCalc'),
                    new StringField('Transfer-DateDayNumber'),
                    new StringField('Package-DateDayAdd'),
                    new StringField('Package-DateCalc'),
                    new StringField('Scheduled Steps'),
                    new StringField('Steps Remaining'),
                    new StringField('PropCrash-DateCalc'),
                    new StringField('PropTrans-DateCalc'),
                    new StringField('Brew Size (Gallons)'),
                    new StringField('Brew % of 7Bbl'),
                    new StringField('Sum - Potential Yield'),
                    new StringField('Potential OG'),
                    new StringField('Efficiency'),
                    new StringField('Ratings'),
                    new StringField('CurrentTank_Name'),
                    new DateField('Canned'),
                    new StringField('PendingActivities'),
                    new StringField('TempLogsCount'),
                    new StringField('Rating')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Batch', 'Batch', 'Batch_id', 'multi_edit_Brews_InventoryActivities_Batch_search', $editor, $this->dataset, $lookupDataset, 'Batch', 'id', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Brew field
            //
            $editor = new DynamicCombobox('brew_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`Brews`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new DateTimeField('updated', true),
                    new StringField('Batch', true),
                    new StringField('Brew ID', true),
                    new StringField('Brew', true, true),
                    new DateField('Brew Date', true),
                    new StringField('Status'),
                    new IntegerField('Mash Temp'),
                    new IntegerField('Lactic Acid'),
                    new IntegerField('Preboil Grav'),
                    new IntegerField('OG'),
                    new IntegerField('pH-Mash'),
                    new IntegerField('pH-First'),
                    new IntegerField('pH-Last'),
                    new IntegerField('pH-Pre boil'),
                    new IntegerField('pH-KO'),
                    new StringField('O2 Setting'),
                    new IntegerField('DO-Line'),
                    new IntegerField('DO-Tank'),
                    new StringField('Notes'),
                    new StringField('User'),
                    new IntegerField('Bbls')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Brew', 'Brew', 'Brew_id', 'multi_edit_Brews_InventoryActivities_Brew_search', $editor, $this->dataset, $lookupDataset, 'Brew', 'id', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for PackageLog field
            //
            $editor = new TextAreaEdit('packagelog_edit', 50, 8);
            $editColumn = new CustomEditColumn('Package Log', 'PackageLog', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Order ID field
            //
            $editor = new TextEdit('order_id_edit');
            $editColumn = new CustomEditColumn('Order ID', 'Order ID', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Committed field
            //
            $editor = new TextEdit('committed_edit');
            $editColumn = new CustomEditColumn('Committed', 'Committed', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Activity Date field
            //
            $editor = new DateTimeEdit('activity_date_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Activity Date', 'Activity Date', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Vendor field
            //
            $editor = new TextAreaEdit('vendor_edit', 50, 8);
            $editColumn = new CustomEditColumn('Vendor', 'Vendor', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Entry Type field
            //
            $editor = new TextAreaEdit('entry_type_edit', 50, 8);
            $editColumn = new CustomEditColumn('Entry Type', 'Entry Type', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Unit of Measure field
            //
            $editor = new TextAreaEdit('unit_of_measure_edit', 50, 8);
            $editColumn = new CustomEditColumn('Unit Of Measure', 'Unit of Measure', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Pkg Type field
            //
            $editor = new TextAreaEdit('pkg_type_edit', 50, 8);
            $editColumn = new CustomEditColumn('Pkg Type', 'Pkg Type', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Activity field
            //
            $editor = new TextAreaEdit('activity_edit', 50, 8);
            $editColumn = new CustomEditColumn('Activity', 'Activity', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Units per Pkg field
            //
            $editor = new TextEdit('units_per_pkg_edit');
            $editColumn = new CustomEditColumn('Units Per Pkg', 'Units per Pkg', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Activity Pkg Qty field
            //
            $editor = new TextEdit('activity_pkg_qty_edit');
            $editColumn = new CustomEditColumn('Activity Pkg Qty', 'Activity Pkg Qty', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Activity Unit Qty field
            //
            $editor = new TextEdit('activity_unit_qty_edit');
            $editColumn = new CustomEditColumn('Activity Unit Qty', 'Activity Unit Qty', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Total Packages field
            //
            $editor = new TextEdit('total_packages_edit');
            $editColumn = new CustomEditColumn('Total Packages', 'Total Packages', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Total Units field
            //
            $editor = new TextEdit('total_units_edit');
            $editColumn = new CustomEditColumn('Total Units', 'Total Units', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Price/Unit field
            //
            $editor = new TextEdit('price/unit_edit');
            $editColumn = new CustomEditColumn('Price/Unit', 'Price/Unit', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Total Price field
            //
            $editor = new TextEdit('total_price_edit');
            $editColumn = new CustomEditColumn('Total Price', 'Total Price', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Activity Pkgs Debit field
            //
            $editor = new TextEdit('activity_pkgs_debit_edit');
            $editColumn = new CustomEditColumn('Activity Pkgs Debit', 'Activity Pkgs Debit', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Activity Pkgs Credit field
            //
            $editor = new TextEdit('activity_pkgs_credit_edit');
            $editColumn = new CustomEditColumn('Activity Pkgs Credit', 'Activity Pkgs Credit', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Activity Units Debit field
            //
            $editor = new TextEdit('activity_units_debit_edit');
            $editColumn = new CustomEditColumn('Activity Units Debit', 'Activity Units Debit', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Activity Units Credit field
            //
            $editor = new TextEdit('activity_units_credit_edit');
            $editColumn = new CustomEditColumn('Activity Units Credit', 'Activity Units Credit', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Committed Pkg Qty field
            //
            $editor = new TextEdit('committed_pkg_qty_edit');
            $editColumn = new CustomEditColumn('Committed Pkg Qty', 'Committed Pkg Qty', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Committed Unit Qty field
            //
            $editor = new TextEdit('committed_unit_qty_edit');
            $editColumn = new CustomEditColumn('Committed Unit Qty', 'Committed Unit Qty', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for User field
            //
            $editor = new TextAreaEdit('user_edit', 50, 8);
            $editColumn = new CustomEditColumn('User', 'User', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Notes field
            //
            $editor = new TextAreaEdit('notes_edit', 50, 8);
            $editColumn = new CustomEditColumn('Notes', 'Notes', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Description field
            //
            $editor = new TextAreaEdit('description_edit', 50, 8);
            $editColumn = new CustomEditColumn('Description', 'Description', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Keg field
            //
            $editor = new TextAreaEdit('keg_edit', 50, 8);
            $editColumn = new CustomEditColumn('Keg', 'Keg', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for GrainYield field
            //
            $editor = new TextAreaEdit('grainyield_edit', 50, 8);
            $editColumn = new CustomEditColumn('Grain Yield', 'GrainYield', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Usage field
            //
            $editor = new TextAreaEdit('usage_edit', 50, 8);
            $editColumn = new CustomEditColumn('Usage', 'Usage', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Category field
            //
            $editor = new TextAreaEdit('category_edit', 50, 8);
            $editColumn = new CustomEditColumn('Category', 'Category', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Format field
            //
            $editor = new TextAreaEdit('format_edit', 50, 8);
            $editColumn = new CustomEditColumn('Format', 'Format', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Potential Yield field
            //
            $editor = new TextAreaEdit('potential_yield_edit', 50, 8);
            $editColumn = new CustomEditColumn('Potential Yield', 'Potential Yield', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for DeviceID field
            //
            $editor = new TextAreaEdit('deviceid_edit', 50, 8);
            $editColumn = new CustomEditColumn('Device ID', 'DeviceID', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for DeviceName field
            //
            $editor = new TextAreaEdit('devicename_edit', 50, 8);
            $editColumn = new CustomEditColumn('Device Name', 'DeviceName', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddToggleEditColumns(Grid $grid)
        {
    
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for updated field
            //
            $editor = new DateTimeEdit('updated_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Updated', 'updated', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Inventory Item field
            //
            $editor = new DynamicCombobox('inventory_item_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`InventoryItems`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new DateTimeField('updated', true),
                    new StringField('Item ID'),
                    new StringField('Inventory Item', true, true),
                    new IntegerField('Price/Unit'),
                    new StringField('Active'),
                    new StringField('Label Name from Template'),
                    new StringField('Brand from Template'),
                    new StringField('Brand from Item'),
                    new StringField('BeerSmith Name'),
                    new StringField('Brand'),
                    new StringField('Product Name'),
                    new StringField('Category'),
                    new StringField('Notes'),
                    new StringField('Pkg Type'),
                    new StringField('Qty per Pkg'),
                    new StringField('Unit of Measure'),
                    new StringField('Image'),
                    new StringField('Image : URL'),
                    new IntegerField('Activity Pkg Sum'),
                    new IntegerField('Activity Units (Calc)'),
                    new IntegerField('Activity Units (Sum)'),
                    new StringField('Inventory Pkgs'),
                    new IntegerField('Inventory Units'),
                    new IntegerField('Inventory Value'),
                    new StringField('Qty Description'),
                    new StringField('Activities'),
                    new IntegerField('Inventory - Order'),
                    new IntegerField('Inventory - Warning'),
                    new IntegerField('Inventory - Critical'),
                    new StringField('Orders Pending'),
                    new StringField('Inventory Level'),
                    new StringField('Re-Order Status'),
                    new StringField('Used past 30 days'),
                    new StringField('Alpha Acids'),
                    new StringField('GrainYield'),
                    new StringField('Format'),
                    new StringField('Attachment'),
                    new StringField('Attachment : URL')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Inventory Item', 'Inventory Item', 'Inventory Item_id', 'insert_Brews_InventoryActivities_Inventory Item_search', $editor, $this->dataset, $lookupDataset, 'Inventory Item', 'id', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Template field
            //
            $editor = new DynamicCombobox('template_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`Templates`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new DateTimeField('updated', true),
                    new StringField('Template', true, true),
                    new StringField('Brand/Name', true),
                    new StringField('Style'),
                    new IntegerField('Color'),
                    new IntegerField('IBU'),
                    new IntegerField('OG_Avg'),
                    new IntegerField('OG_Override'),
                    new IntegerField('OG_Eq'),
                    new IntegerField('ABV_Avg'),
                    new IntegerField('ABV_Avg_Dec'),
                    new IntegerField('ABV_Eq'),
                    new IntegerField('Attenuation_Override'),
                    new IntegerField('Attenuation_Override_Dec'),
                    new IntegerField('Attenuation_Avg'),
                    new IntegerField('Attenuation_Avg_Dec'),
                    new IntegerField('Attenuation_Eq'),
                    new IntegerField('FG_Eq'),
                    new StringField('Notes'),
                    new IntegerField('Batches')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Template', 'Template', 'Template_id', 'insert_Brews_InventoryActivities_Template_search', $editor, $this->dataset, $lookupDataset, 'Template', 'id', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Batch field
            //
            $editor = new DynamicCombobox('batch_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`Batches`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new DateTimeField('updated', true),
                    new IntegerField('BatchID', true),
                    new StringField('Template', true),
                    new StringField('Batch', true, true),
                    new DateField('Brew Date'),
                    new IntegerField('Ingredient_Cnt'),
                    new IntegerField('Brews-Records'),
                    new StringField('Brews Blended from this Batch'),
                    new StringField('Brews Blended into this Batch'),
                    new IntegerField('Brews'),
                    new IntegerField('Total Brews Calc 1'),
                    new IntegerField('Total Brews Calc 2'),
                    new DateField('Brew Date Start Calc 1'),
                    new DateField('Brew Date End Calc 1'),
                    new DateField('Brew Date Start Calc 2'),
                    new DateField('Brew Date End Calc 2'),
                    new DateField('Brew Date Start'),
                    new DateField('Brew Date End'),
                    new IntegerField('Brew Days'),
                    new IntegerField('Total Brews (Net)'),
                    new StringField('ProPitch'),
                    new StringField('Yeast'),
                    new StringField('Yeast Source'),
                    new StringField('Yeast from FV'),
                    new StringField('Nickname'),
                    new StringField('Status'),
                    new StringField('Batch-Status'),
                    new StringField('Days Running 1'),
                    new StringField('Days Running 2'),
                    new StringField('Style'),
                    new StringField('FV'),
                    new StringField('FV Tank'),
                    new StringField('BT'),
                    new StringField('BT Tank'),
                    new StringField('Current Tank'),
                    new StringField('Bbls'),
                    new StringField('Color'),
                    new StringField('IBU'),
                    new StringField('OG-A'),
                    new StringField('OG-B'),
                    new StringField('OG-C'),
                    new StringField('OG-D'),
                    new StringField('OG-AB'),
                    new StringField('OG-ABC'),
                    new StringField('OG-ABCD'),
                    new StringField('OG'),
                    new StringField('FG_Min'),
                    new StringField('Current Gravity'),
                    new StringField('FG'),
                    new StringField('ABV'),
                    new StringField('Attenuation'),
                    new StringField('Yeast Pitch'),
                    new StringField('Blend Ratio'),
                    new StringField('Notes'),
                    new StringField('Status2'),
                    new StringField('Dry Hop Date'),
                    new StringField('Dry Hop Date Formula'),
                    new StringField('Crash Date'),
                    new StringField('Brite Tank Date'),
                    new StringField('Gone Date'),
                    new StringField('Dry Hop Days'),
                    new StringField('Total Days'),
                    new StringField('Dry Hopped Running'),
                    new StringField('User'),
                    new StringField('Maximum CO2'),
                    new StringField('CO2 Volumes'),
                    new StringField('This Batch Blended into Batch'),
                    new StringField('Batches Blended into this Batch'),
                    new StringField('Calculated Days'),
                    new StringField('Blended'),
                    new StringField('TankLog Count'),
                    new StringField('KegLog Count'),
                    new StringField('Kegs Count'),
                    new StringField('PackageLog Count'),
                    new StringField('KegOrders Count'),
                    new StringField('Net Bbls'),
                    new StringField('Canned & Kegged Barrels'),
                    new StringField('Canning Runs'),
                    new StringField('5G Kegs'),
                    new StringField('50L Kegs'),
                    new StringField('Brews-Bbls'),
                    new StringField('Brews-OG'),
                    new StringField('Net Beer Factor'),
                    new StringField('Batch Gross Bbls Calc'),
                    new StringField('Gross Bbls'),
                    new StringField('Remaining Bbls Calc'),
                    new StringField('Remaining Bbls (Est)'),
                    new StringField('Can Be Deleted'),
                    new StringField('Brews from Template'),
                    new StringField('FermStart-DateCalc'),
                    new StringField('FermStart-DateCalc2'),
                    new StringField('FermEnd-DateCalc'),
                    new StringField('FermEnd-DateCalc2'),
                    new StringField('Ferm-DateCalc'),
                    new StringField('Ferm-DateCalc2'),
                    new StringField('FermEnd-DateDayNumber'),
                    new StringField('DryHop-DateDayAdd'),
                    new StringField('Dryhop-DateCalc'),
                    new StringField('Dryhop-DateDayNumber'),
                    new StringField('Crash-DateDayAdd'),
                    new StringField('Crash-DateCalc'),
                    new StringField('Crash-DateDayNumber'),
                    new StringField('Transfer-DateDayAdd'),
                    new StringField('Transfer-DateCalc'),
                    new StringField('Transfer-DateDayNumber'),
                    new StringField('Package-DateDayAdd'),
                    new StringField('Package-DateCalc'),
                    new StringField('Scheduled Steps'),
                    new StringField('Steps Remaining'),
                    new StringField('PropCrash-DateCalc'),
                    new StringField('PropTrans-DateCalc'),
                    new StringField('Brew Size (Gallons)'),
                    new StringField('Brew % of 7Bbl'),
                    new StringField('Sum - Potential Yield'),
                    new StringField('Potential OG'),
                    new StringField('Efficiency'),
                    new StringField('Ratings'),
                    new StringField('CurrentTank_Name'),
                    new DateField('Canned'),
                    new StringField('PendingActivities'),
                    new StringField('TempLogsCount'),
                    new StringField('Rating')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Batch', 'Batch', 'Batch_id', 'insert_Brews_InventoryActivities_Batch_search', $editor, $this->dataset, $lookupDataset, 'Batch', 'id', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Brew field
            //
            $editor = new DynamicCombobox('brew_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`Brews`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new DateTimeField('updated', true),
                    new StringField('Batch', true),
                    new StringField('Brew ID', true),
                    new StringField('Brew', true, true),
                    new DateField('Brew Date', true),
                    new StringField('Status'),
                    new IntegerField('Mash Temp'),
                    new IntegerField('Lactic Acid'),
                    new IntegerField('Preboil Grav'),
                    new IntegerField('OG'),
                    new IntegerField('pH-Mash'),
                    new IntegerField('pH-First'),
                    new IntegerField('pH-Last'),
                    new IntegerField('pH-Pre boil'),
                    new IntegerField('pH-KO'),
                    new StringField('O2 Setting'),
                    new IntegerField('DO-Line'),
                    new IntegerField('DO-Tank'),
                    new StringField('Notes'),
                    new StringField('User'),
                    new IntegerField('Bbls')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Brew', 'Brew', 'Brew_id', 'insert_Brews_InventoryActivities_Brew_search', $editor, $this->dataset, $lookupDataset, 'Brew', 'id', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for PackageLog field
            //
            $editor = new TextAreaEdit('packagelog_edit', 50, 8);
            $editColumn = new CustomEditColumn('Package Log', 'PackageLog', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Order ID field
            //
            $editor = new TextEdit('order_id_edit');
            $editColumn = new CustomEditColumn('Order ID', 'Order ID', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Committed field
            //
            $editor = new TextEdit('committed_edit');
            $editColumn = new CustomEditColumn('Committed', 'Committed', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Activity Date field
            //
            $editor = new DateTimeEdit('activity_date_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Activity Date', 'Activity Date', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Vendor field
            //
            $editor = new TextAreaEdit('vendor_edit', 50, 8);
            $editColumn = new CustomEditColumn('Vendor', 'Vendor', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Entry Type field
            //
            $editor = new TextAreaEdit('entry_type_edit', 50, 8);
            $editColumn = new CustomEditColumn('Entry Type', 'Entry Type', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Unit of Measure field
            //
            $editor = new TextAreaEdit('unit_of_measure_edit', 50, 8);
            $editColumn = new CustomEditColumn('Unit Of Measure', 'Unit of Measure', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Pkg Type field
            //
            $editor = new TextAreaEdit('pkg_type_edit', 50, 8);
            $editColumn = new CustomEditColumn('Pkg Type', 'Pkg Type', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Activity field
            //
            $editor = new TextAreaEdit('activity_edit', 50, 8);
            $editColumn = new CustomEditColumn('Activity', 'Activity', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Units per Pkg field
            //
            $editor = new TextEdit('units_per_pkg_edit');
            $editColumn = new CustomEditColumn('Units Per Pkg', 'Units per Pkg', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Activity Pkg Qty field
            //
            $editor = new TextEdit('activity_pkg_qty_edit');
            $editColumn = new CustomEditColumn('Activity Pkg Qty', 'Activity Pkg Qty', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Activity Unit Qty field
            //
            $editor = new TextEdit('activity_unit_qty_edit');
            $editColumn = new CustomEditColumn('Activity Unit Qty', 'Activity Unit Qty', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Total Packages field
            //
            $editor = new TextEdit('total_packages_edit');
            $editColumn = new CustomEditColumn('Total Packages', 'Total Packages', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Total Units field
            //
            $editor = new TextEdit('total_units_edit');
            $editColumn = new CustomEditColumn('Total Units', 'Total Units', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Price/Unit field
            //
            $editor = new TextEdit('price/unit_edit');
            $editColumn = new CustomEditColumn('Price/Unit', 'Price/Unit', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Total Price field
            //
            $editor = new TextEdit('total_price_edit');
            $editColumn = new CustomEditColumn('Total Price', 'Total Price', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Activity Pkgs Debit field
            //
            $editor = new TextEdit('activity_pkgs_debit_edit');
            $editColumn = new CustomEditColumn('Activity Pkgs Debit', 'Activity Pkgs Debit', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Activity Pkgs Credit field
            //
            $editor = new TextEdit('activity_pkgs_credit_edit');
            $editColumn = new CustomEditColumn('Activity Pkgs Credit', 'Activity Pkgs Credit', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Activity Units Debit field
            //
            $editor = new TextEdit('activity_units_debit_edit');
            $editColumn = new CustomEditColumn('Activity Units Debit', 'Activity Units Debit', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Activity Units Credit field
            //
            $editor = new TextEdit('activity_units_credit_edit');
            $editColumn = new CustomEditColumn('Activity Units Credit', 'Activity Units Credit', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Committed Pkg Qty field
            //
            $editor = new TextEdit('committed_pkg_qty_edit');
            $editColumn = new CustomEditColumn('Committed Pkg Qty', 'Committed Pkg Qty', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Committed Unit Qty field
            //
            $editor = new TextEdit('committed_unit_qty_edit');
            $editColumn = new CustomEditColumn('Committed Unit Qty', 'Committed Unit Qty', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for User field
            //
            $editor = new TextAreaEdit('user_edit', 50, 8);
            $editColumn = new CustomEditColumn('User', 'User', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Notes field
            //
            $editor = new TextAreaEdit('notes_edit', 50, 8);
            $editColumn = new CustomEditColumn('Notes', 'Notes', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Description field
            //
            $editor = new TextAreaEdit('description_edit', 50, 8);
            $editColumn = new CustomEditColumn('Description', 'Description', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Keg field
            //
            $editor = new TextAreaEdit('keg_edit', 50, 8);
            $editColumn = new CustomEditColumn('Keg', 'Keg', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for GrainYield field
            //
            $editor = new TextAreaEdit('grainyield_edit', 50, 8);
            $editColumn = new CustomEditColumn('Grain Yield', 'GrainYield', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Usage field
            //
            $editor = new TextAreaEdit('usage_edit', 50, 8);
            $editColumn = new CustomEditColumn('Usage', 'Usage', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Category field
            //
            $editor = new TextAreaEdit('category_edit', 50, 8);
            $editColumn = new CustomEditColumn('Category', 'Category', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Format field
            //
            $editor = new TextAreaEdit('format_edit', 50, 8);
            $editColumn = new CustomEditColumn('Format', 'Format', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Potential Yield field
            //
            $editor = new TextAreaEdit('potential_yield_edit', 50, 8);
            $editColumn = new CustomEditColumn('Potential Yield', 'Potential Yield', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for DeviceID field
            //
            $editor = new TextAreaEdit('deviceid_edit', 50, 8);
            $editColumn = new CustomEditColumn('Device ID', 'DeviceID', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for DeviceName field
            //
            $editor = new TextAreaEdit('devicename_edit', 50, 8);
            $editColumn = new CustomEditColumn('Device Name', 'DeviceName', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            $grid->SetShowAddButton(true && $this->GetSecurityInfo()->HasAddGrant());
        }
    
        private function AddMultiUploadColumn(Grid $grid)
        {
    
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for updated field
            //
            $column = new DateTimeViewColumn('updated', 'updated', 'Updated', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for id field
            //
            $column = new NumberViewColumn('Inventory Item', 'Inventory Item_id', 'Inventory Item', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for id field
            //
            $column = new NumberViewColumn('Template', 'Template_id', 'Template', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for id field
            //
            $column = new NumberViewColumn('Batch', 'Batch_id', 'Batch', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for id field
            //
            $column = new NumberViewColumn('Brew', 'Brew_id', 'Brew', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for PackageLog field
            //
            $column = new TextViewColumn('PackageLog', 'PackageLog', 'Package Log', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Order ID field
            //
            $column = new NumberViewColumn('Order ID', 'Order ID', 'Order ID', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Committed field
            //
            $column = new NumberViewColumn('Committed', 'Committed', 'Committed', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Activity Date field
            //
            $column = new DateTimeViewColumn('Activity Date', 'Activity Date', 'Activity Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Vendor field
            //
            $column = new TextViewColumn('Vendor', 'Vendor', 'Vendor', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Entry Type field
            //
            $column = new TextViewColumn('Entry Type', 'Entry Type', 'Entry Type', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Unit of Measure field
            //
            $column = new TextViewColumn('Unit of Measure', 'Unit of Measure', 'Unit Of Measure', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Pkg Type field
            //
            $column = new TextViewColumn('Pkg Type', 'Pkg Type', 'Pkg Type', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Activity field
            //
            $column = new TextViewColumn('Activity', 'Activity', 'Activity', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Units per Pkg field
            //
            $column = new NumberViewColumn('Units per Pkg', 'Units per Pkg', 'Units Per Pkg', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Activity Pkg Qty field
            //
            $column = new NumberViewColumn('Activity Pkg Qty', 'Activity Pkg Qty', 'Activity Pkg Qty', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Activity Unit Qty field
            //
            $column = new NumberViewColumn('Activity Unit Qty', 'Activity Unit Qty', 'Activity Unit Qty', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Total Packages field
            //
            $column = new NumberViewColumn('Total Packages', 'Total Packages', 'Total Packages', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Total Units field
            //
            $column = new NumberViewColumn('Total Units', 'Total Units', 'Total Units', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Price/Unit field
            //
            $column = new NumberViewColumn('Price/Unit', 'Price/Unit', 'Price/Unit', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Total Price field
            //
            $column = new NumberViewColumn('Total Price', 'Total Price', 'Total Price', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Activity Pkgs Debit field
            //
            $column = new NumberViewColumn('Activity Pkgs Debit', 'Activity Pkgs Debit', 'Activity Pkgs Debit', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Activity Pkgs Credit field
            //
            $column = new NumberViewColumn('Activity Pkgs Credit', 'Activity Pkgs Credit', 'Activity Pkgs Credit', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Activity Units Debit field
            //
            $column = new NumberViewColumn('Activity Units Debit', 'Activity Units Debit', 'Activity Units Debit', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Activity Units Credit field
            //
            $column = new NumberViewColumn('Activity Units Credit', 'Activity Units Credit', 'Activity Units Credit', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Committed Pkg Qty field
            //
            $column = new NumberViewColumn('Committed Pkg Qty', 'Committed Pkg Qty', 'Committed Pkg Qty', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Committed Unit Qty field
            //
            $column = new NumberViewColumn('Committed Unit Qty', 'Committed Unit Qty', 'Committed Unit Qty', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for User field
            //
            $column = new TextViewColumn('User', 'User', 'User', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Notes field
            //
            $column = new TextViewColumn('Notes', 'Notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Description field
            //
            $column = new TextViewColumn('Description', 'Description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Keg field
            //
            $column = new TextViewColumn('Keg', 'Keg', 'Keg', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for GrainYield field
            //
            $column = new TextViewColumn('GrainYield', 'GrainYield', 'Grain Yield', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Usage field
            //
            $column = new TextViewColumn('Usage', 'Usage', 'Usage', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Category field
            //
            $column = new TextViewColumn('Category', 'Category', 'Category', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Format field
            //
            $column = new TextViewColumn('Format', 'Format', 'Format', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Potential Yield field
            //
            $column = new TextViewColumn('Potential Yield', 'Potential Yield', 'Potential Yield', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for DeviceID field
            //
            $column = new TextViewColumn('DeviceID', 'DeviceID', 'Device ID', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for DeviceName field
            //
            $column = new TextViewColumn('DeviceName', 'DeviceName', 'Device Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for updated field
            //
            $column = new DateTimeViewColumn('updated', 'updated', 'Updated', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for id field
            //
            $column = new NumberViewColumn('Inventory Item', 'Inventory Item_id', 'Inventory Item', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for id field
            //
            $column = new NumberViewColumn('Template', 'Template_id', 'Template', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for id field
            //
            $column = new NumberViewColumn('Batch', 'Batch_id', 'Batch', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for id field
            //
            $column = new NumberViewColumn('Brew', 'Brew_id', 'Brew', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for PackageLog field
            //
            $column = new TextViewColumn('PackageLog', 'PackageLog', 'Package Log', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for Order ID field
            //
            $column = new NumberViewColumn('Order ID', 'Order ID', 'Order ID', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for Committed field
            //
            $column = new NumberViewColumn('Committed', 'Committed', 'Committed', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for Activity Date field
            //
            $column = new DateTimeViewColumn('Activity Date', 'Activity Date', 'Activity Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddExportColumn($column);
            
            //
            // View column for Vendor field
            //
            $column = new TextViewColumn('Vendor', 'Vendor', 'Vendor', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for Entry Type field
            //
            $column = new TextViewColumn('Entry Type', 'Entry Type', 'Entry Type', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for Unit of Measure field
            //
            $column = new TextViewColumn('Unit of Measure', 'Unit of Measure', 'Unit Of Measure', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for Pkg Type field
            //
            $column = new TextViewColumn('Pkg Type', 'Pkg Type', 'Pkg Type', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for Activity field
            //
            $column = new TextViewColumn('Activity', 'Activity', 'Activity', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for Units per Pkg field
            //
            $column = new NumberViewColumn('Units per Pkg', 'Units per Pkg', 'Units Per Pkg', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for Activity Pkg Qty field
            //
            $column = new NumberViewColumn('Activity Pkg Qty', 'Activity Pkg Qty', 'Activity Pkg Qty', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for Activity Unit Qty field
            //
            $column = new NumberViewColumn('Activity Unit Qty', 'Activity Unit Qty', 'Activity Unit Qty', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for Total Packages field
            //
            $column = new NumberViewColumn('Total Packages', 'Total Packages', 'Total Packages', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for Total Units field
            //
            $column = new NumberViewColumn('Total Units', 'Total Units', 'Total Units', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for Price/Unit field
            //
            $column = new NumberViewColumn('Price/Unit', 'Price/Unit', 'Price/Unit', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for Total Price field
            //
            $column = new NumberViewColumn('Total Price', 'Total Price', 'Total Price', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for Activity Pkgs Debit field
            //
            $column = new NumberViewColumn('Activity Pkgs Debit', 'Activity Pkgs Debit', 'Activity Pkgs Debit', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for Activity Pkgs Credit field
            //
            $column = new NumberViewColumn('Activity Pkgs Credit', 'Activity Pkgs Credit', 'Activity Pkgs Credit', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for Activity Units Debit field
            //
            $column = new NumberViewColumn('Activity Units Debit', 'Activity Units Debit', 'Activity Units Debit', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for Activity Units Credit field
            //
            $column = new NumberViewColumn('Activity Units Credit', 'Activity Units Credit', 'Activity Units Credit', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for Committed Pkg Qty field
            //
            $column = new NumberViewColumn('Committed Pkg Qty', 'Committed Pkg Qty', 'Committed Pkg Qty', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for Committed Unit Qty field
            //
            $column = new NumberViewColumn('Committed Unit Qty', 'Committed Unit Qty', 'Committed Unit Qty', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for User field
            //
            $column = new TextViewColumn('User', 'User', 'User', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for Notes field
            //
            $column = new TextViewColumn('Notes', 'Notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for Description field
            //
            $column = new TextViewColumn('Description', 'Description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for Keg field
            //
            $column = new TextViewColumn('Keg', 'Keg', 'Keg', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for GrainYield field
            //
            $column = new TextViewColumn('GrainYield', 'GrainYield', 'Grain Yield', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for Usage field
            //
            $column = new TextViewColumn('Usage', 'Usage', 'Usage', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for Category field
            //
            $column = new TextViewColumn('Category', 'Category', 'Category', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for Format field
            //
            $column = new TextViewColumn('Format', 'Format', 'Format', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for Potential Yield field
            //
            $column = new TextViewColumn('Potential Yield', 'Potential Yield', 'Potential Yield', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for DeviceID field
            //
            $column = new TextViewColumn('DeviceID', 'DeviceID', 'Device ID', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for DeviceName field
            //
            $column = new TextViewColumn('DeviceName', 'DeviceName', 'Device Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for updated field
            //
            $column = new DateTimeViewColumn('updated', 'updated', 'Updated', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for id field
            //
            $column = new NumberViewColumn('Inventory Item', 'Inventory Item_id', 'Inventory Item', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for id field
            //
            $column = new NumberViewColumn('Template', 'Template_id', 'Template', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for id field
            //
            $column = new NumberViewColumn('Batch', 'Batch_id', 'Batch', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for id field
            //
            $column = new NumberViewColumn('Brew', 'Brew_id', 'Brew', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for PackageLog field
            //
            $column = new TextViewColumn('PackageLog', 'PackageLog', 'Package Log', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Order ID field
            //
            $column = new NumberViewColumn('Order ID', 'Order ID', 'Order ID', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Committed field
            //
            $column = new NumberViewColumn('Committed', 'Committed', 'Committed', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Activity Date field
            //
            $column = new DateTimeViewColumn('Activity Date', 'Activity Date', 'Activity Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Vendor field
            //
            $column = new TextViewColumn('Vendor', 'Vendor', 'Vendor', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Entry Type field
            //
            $column = new TextViewColumn('Entry Type', 'Entry Type', 'Entry Type', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Unit of Measure field
            //
            $column = new TextViewColumn('Unit of Measure', 'Unit of Measure', 'Unit Of Measure', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Pkg Type field
            //
            $column = new TextViewColumn('Pkg Type', 'Pkg Type', 'Pkg Type', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Activity field
            //
            $column = new TextViewColumn('Activity', 'Activity', 'Activity', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Units per Pkg field
            //
            $column = new NumberViewColumn('Units per Pkg', 'Units per Pkg', 'Units Per Pkg', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Activity Pkg Qty field
            //
            $column = new NumberViewColumn('Activity Pkg Qty', 'Activity Pkg Qty', 'Activity Pkg Qty', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Activity Unit Qty field
            //
            $column = new NumberViewColumn('Activity Unit Qty', 'Activity Unit Qty', 'Activity Unit Qty', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Total Packages field
            //
            $column = new NumberViewColumn('Total Packages', 'Total Packages', 'Total Packages', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Total Units field
            //
            $column = new NumberViewColumn('Total Units', 'Total Units', 'Total Units', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Price/Unit field
            //
            $column = new NumberViewColumn('Price/Unit', 'Price/Unit', 'Price/Unit', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Total Price field
            //
            $column = new NumberViewColumn('Total Price', 'Total Price', 'Total Price', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Activity Pkgs Debit field
            //
            $column = new NumberViewColumn('Activity Pkgs Debit', 'Activity Pkgs Debit', 'Activity Pkgs Debit', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Activity Pkgs Credit field
            //
            $column = new NumberViewColumn('Activity Pkgs Credit', 'Activity Pkgs Credit', 'Activity Pkgs Credit', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Activity Units Debit field
            //
            $column = new NumberViewColumn('Activity Units Debit', 'Activity Units Debit', 'Activity Units Debit', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Activity Units Credit field
            //
            $column = new NumberViewColumn('Activity Units Credit', 'Activity Units Credit', 'Activity Units Credit', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Committed Pkg Qty field
            //
            $column = new NumberViewColumn('Committed Pkg Qty', 'Committed Pkg Qty', 'Committed Pkg Qty', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Committed Unit Qty field
            //
            $column = new NumberViewColumn('Committed Unit Qty', 'Committed Unit Qty', 'Committed Unit Qty', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for User field
            //
            $column = new TextViewColumn('User', 'User', 'User', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Notes field
            //
            $column = new TextViewColumn('Notes', 'Notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Description field
            //
            $column = new TextViewColumn('Description', 'Description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Keg field
            //
            $column = new TextViewColumn('Keg', 'Keg', 'Keg', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for GrainYield field
            //
            $column = new TextViewColumn('GrainYield', 'GrainYield', 'Grain Yield', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Usage field
            //
            $column = new TextViewColumn('Usage', 'Usage', 'Usage', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Category field
            //
            $column = new TextViewColumn('Category', 'Category', 'Category', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Format field
            //
            $column = new TextViewColumn('Format', 'Format', 'Format', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Potential Yield field
            //
            $column = new TextViewColumn('Potential Yield', 'Potential Yield', 'Potential Yield', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for DeviceID field
            //
            $column = new TextViewColumn('DeviceID', 'DeviceID', 'Device ID', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for DeviceName field
            //
            $column = new TextViewColumn('DeviceName', 'DeviceName', 'Device Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
        }
    
        private function AddCompareHeaderColumns(Grid $grid)
        {
    
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        public function isFilterConditionRequired()
        {
            return false;
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
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset);
            if ($this->GetSecurityInfo()->HasDeleteGrant())
               $result->SetAllowDeleteSelected(true);
            else
               $result->SetAllowDeleteSelected(false);   
            
            ApplyCommonPageSettings($this, $result);
            
            $result->SetUseImagesForActions(true);
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(true);
            $result->setAllowCompare(true);
            $this->AddCompareHeaderColumns($result);
            $this->AddCompareColumns($result);
            $result->setMultiEditAllowed($this->GetSecurityInfo()->HasEditGrant() && true);
            $result->setTableBordered(false);
            $result->setTableCondensed(false);
            
            $result->SetHighlightRowAtHover(false);
            $result->SetWidth('');
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddMultiEditColumns($result);
            $this->AddToggleEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
            $this->AddMultiUploadColumn($result);
    
    
            $this->SetShowPageList(true);
            $this->SetShowTopPageNavigator(true);
            $this->SetShowBottomPageNavigator(true);
            $this->setAllowedActions(array('view', 'insert', 'copy', 'edit', 'multi-edit', 'delete', 'multi-delete'));
            $this->setPrintListAvailable(true);
            $this->setPrintListRecordAvailable(false);
            $this->setPrintOneRecordAvailable(true);
            $this->setAllowPrintSelectedRecords(true);
            $this->setExportListAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportSelectedRecordsAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportListRecordAvailable(array());
            $this->setExportOneRecordAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
    
            return $result;
        }
     
        protected function setClientSideEvents(Grid $grid) {
    
        }
    
        protected function doRegisterHandlers() {
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`InventoryItems`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new DateTimeField('updated', true),
                    new StringField('Item ID'),
                    new StringField('Inventory Item', true, true),
                    new IntegerField('Price/Unit'),
                    new StringField('Active'),
                    new StringField('Label Name from Template'),
                    new StringField('Brand from Template'),
                    new StringField('Brand from Item'),
                    new StringField('BeerSmith Name'),
                    new StringField('Brand'),
                    new StringField('Product Name'),
                    new StringField('Category'),
                    new StringField('Notes'),
                    new StringField('Pkg Type'),
                    new StringField('Qty per Pkg'),
                    new StringField('Unit of Measure'),
                    new StringField('Image'),
                    new StringField('Image : URL'),
                    new IntegerField('Activity Pkg Sum'),
                    new IntegerField('Activity Units (Calc)'),
                    new IntegerField('Activity Units (Sum)'),
                    new StringField('Inventory Pkgs'),
                    new IntegerField('Inventory Units'),
                    new IntegerField('Inventory Value'),
                    new StringField('Qty Description'),
                    new StringField('Activities'),
                    new IntegerField('Inventory - Order'),
                    new IntegerField('Inventory - Warning'),
                    new IntegerField('Inventory - Critical'),
                    new StringField('Orders Pending'),
                    new StringField('Inventory Level'),
                    new StringField('Re-Order Status'),
                    new StringField('Used past 30 days'),
                    new StringField('Alpha Acids'),
                    new StringField('GrainYield'),
                    new StringField('Format'),
                    new StringField('Attachment'),
                    new StringField('Attachment : URL')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_Brews_InventoryActivities_Inventory Item_search', 'Inventory Item', 'id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`Templates`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new DateTimeField('updated', true),
                    new StringField('Template', true, true),
                    new StringField('Brand/Name', true),
                    new StringField('Style'),
                    new IntegerField('Color'),
                    new IntegerField('IBU'),
                    new IntegerField('OG_Avg'),
                    new IntegerField('OG_Override'),
                    new IntegerField('OG_Eq'),
                    new IntegerField('ABV_Avg'),
                    new IntegerField('ABV_Avg_Dec'),
                    new IntegerField('ABV_Eq'),
                    new IntegerField('Attenuation_Override'),
                    new IntegerField('Attenuation_Override_Dec'),
                    new IntegerField('Attenuation_Avg'),
                    new IntegerField('Attenuation_Avg_Dec'),
                    new IntegerField('Attenuation_Eq'),
                    new IntegerField('FG_Eq'),
                    new StringField('Notes'),
                    new IntegerField('Batches')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_Brews_InventoryActivities_Template_search', 'Template', 'id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`Batches`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new DateTimeField('updated', true),
                    new IntegerField('BatchID', true),
                    new StringField('Template', true),
                    new StringField('Batch', true, true),
                    new DateField('Brew Date'),
                    new IntegerField('Ingredient_Cnt'),
                    new IntegerField('Brews-Records'),
                    new StringField('Brews Blended from this Batch'),
                    new StringField('Brews Blended into this Batch'),
                    new IntegerField('Brews'),
                    new IntegerField('Total Brews Calc 1'),
                    new IntegerField('Total Brews Calc 2'),
                    new DateField('Brew Date Start Calc 1'),
                    new DateField('Brew Date End Calc 1'),
                    new DateField('Brew Date Start Calc 2'),
                    new DateField('Brew Date End Calc 2'),
                    new DateField('Brew Date Start'),
                    new DateField('Brew Date End'),
                    new IntegerField('Brew Days'),
                    new IntegerField('Total Brews (Net)'),
                    new StringField('ProPitch'),
                    new StringField('Yeast'),
                    new StringField('Yeast Source'),
                    new StringField('Yeast from FV'),
                    new StringField('Nickname'),
                    new StringField('Status'),
                    new StringField('Batch-Status'),
                    new StringField('Days Running 1'),
                    new StringField('Days Running 2'),
                    new StringField('Style'),
                    new StringField('FV'),
                    new StringField('FV Tank'),
                    new StringField('BT'),
                    new StringField('BT Tank'),
                    new StringField('Current Tank'),
                    new StringField('Bbls'),
                    new StringField('Color'),
                    new StringField('IBU'),
                    new StringField('OG-A'),
                    new StringField('OG-B'),
                    new StringField('OG-C'),
                    new StringField('OG-D'),
                    new StringField('OG-AB'),
                    new StringField('OG-ABC'),
                    new StringField('OG-ABCD'),
                    new StringField('OG'),
                    new StringField('FG_Min'),
                    new StringField('Current Gravity'),
                    new StringField('FG'),
                    new StringField('ABV'),
                    new StringField('Attenuation'),
                    new StringField('Yeast Pitch'),
                    new StringField('Blend Ratio'),
                    new StringField('Notes'),
                    new StringField('Status2'),
                    new StringField('Dry Hop Date'),
                    new StringField('Dry Hop Date Formula'),
                    new StringField('Crash Date'),
                    new StringField('Brite Tank Date'),
                    new StringField('Gone Date'),
                    new StringField('Dry Hop Days'),
                    new StringField('Total Days'),
                    new StringField('Dry Hopped Running'),
                    new StringField('User'),
                    new StringField('Maximum CO2'),
                    new StringField('CO2 Volumes'),
                    new StringField('This Batch Blended into Batch'),
                    new StringField('Batches Blended into this Batch'),
                    new StringField('Calculated Days'),
                    new StringField('Blended'),
                    new StringField('TankLog Count'),
                    new StringField('KegLog Count'),
                    new StringField('Kegs Count'),
                    new StringField('PackageLog Count'),
                    new StringField('KegOrders Count'),
                    new StringField('Net Bbls'),
                    new StringField('Canned & Kegged Barrels'),
                    new StringField('Canning Runs'),
                    new StringField('5G Kegs'),
                    new StringField('50L Kegs'),
                    new StringField('Brews-Bbls'),
                    new StringField('Brews-OG'),
                    new StringField('Net Beer Factor'),
                    new StringField('Batch Gross Bbls Calc'),
                    new StringField('Gross Bbls'),
                    new StringField('Remaining Bbls Calc'),
                    new StringField('Remaining Bbls (Est)'),
                    new StringField('Can Be Deleted'),
                    new StringField('Brews from Template'),
                    new StringField('FermStart-DateCalc'),
                    new StringField('FermStart-DateCalc2'),
                    new StringField('FermEnd-DateCalc'),
                    new StringField('FermEnd-DateCalc2'),
                    new StringField('Ferm-DateCalc'),
                    new StringField('Ferm-DateCalc2'),
                    new StringField('FermEnd-DateDayNumber'),
                    new StringField('DryHop-DateDayAdd'),
                    new StringField('Dryhop-DateCalc'),
                    new StringField('Dryhop-DateDayNumber'),
                    new StringField('Crash-DateDayAdd'),
                    new StringField('Crash-DateCalc'),
                    new StringField('Crash-DateDayNumber'),
                    new StringField('Transfer-DateDayAdd'),
                    new StringField('Transfer-DateCalc'),
                    new StringField('Transfer-DateDayNumber'),
                    new StringField('Package-DateDayAdd'),
                    new StringField('Package-DateCalc'),
                    new StringField('Scheduled Steps'),
                    new StringField('Steps Remaining'),
                    new StringField('PropCrash-DateCalc'),
                    new StringField('PropTrans-DateCalc'),
                    new StringField('Brew Size (Gallons)'),
                    new StringField('Brew % of 7Bbl'),
                    new StringField('Sum - Potential Yield'),
                    new StringField('Potential OG'),
                    new StringField('Efficiency'),
                    new StringField('Ratings'),
                    new StringField('CurrentTank_Name'),
                    new DateField('Canned'),
                    new StringField('PendingActivities'),
                    new StringField('TempLogsCount'),
                    new StringField('Rating')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_Brews_InventoryActivities_Batch_search', 'Batch', 'id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`Brews`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new DateTimeField('updated', true),
                    new StringField('Batch', true),
                    new StringField('Brew ID', true),
                    new StringField('Brew', true, true),
                    new DateField('Brew Date', true),
                    new StringField('Status'),
                    new IntegerField('Mash Temp'),
                    new IntegerField('Lactic Acid'),
                    new IntegerField('Preboil Grav'),
                    new IntegerField('OG'),
                    new IntegerField('pH-Mash'),
                    new IntegerField('pH-First'),
                    new IntegerField('pH-Last'),
                    new IntegerField('pH-Pre boil'),
                    new IntegerField('pH-KO'),
                    new StringField('O2 Setting'),
                    new IntegerField('DO-Line'),
                    new IntegerField('DO-Tank'),
                    new StringField('Notes'),
                    new StringField('User'),
                    new IntegerField('Bbls')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_Brews_InventoryActivities_Brew_search', 'Brew', 'id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`InventoryItems`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new DateTimeField('updated', true),
                    new StringField('Item ID'),
                    new StringField('Inventory Item', true, true),
                    new IntegerField('Price/Unit'),
                    new StringField('Active'),
                    new StringField('Label Name from Template'),
                    new StringField('Brand from Template'),
                    new StringField('Brand from Item'),
                    new StringField('BeerSmith Name'),
                    new StringField('Brand'),
                    new StringField('Product Name'),
                    new StringField('Category'),
                    new StringField('Notes'),
                    new StringField('Pkg Type'),
                    new StringField('Qty per Pkg'),
                    new StringField('Unit of Measure'),
                    new StringField('Image'),
                    new StringField('Image : URL'),
                    new IntegerField('Activity Pkg Sum'),
                    new IntegerField('Activity Units (Calc)'),
                    new IntegerField('Activity Units (Sum)'),
                    new StringField('Inventory Pkgs'),
                    new IntegerField('Inventory Units'),
                    new IntegerField('Inventory Value'),
                    new StringField('Qty Description'),
                    new StringField('Activities'),
                    new IntegerField('Inventory - Order'),
                    new IntegerField('Inventory - Warning'),
                    new IntegerField('Inventory - Critical'),
                    new StringField('Orders Pending'),
                    new StringField('Inventory Level'),
                    new StringField('Re-Order Status'),
                    new StringField('Used past 30 days'),
                    new StringField('Alpha Acids'),
                    new StringField('GrainYield'),
                    new StringField('Format'),
                    new StringField('Attachment'),
                    new StringField('Attachment : URL')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_Brews_InventoryActivities_Inventory Item_search', 'Inventory Item', 'id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`Templates`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new DateTimeField('updated', true),
                    new StringField('Template', true, true),
                    new StringField('Brand/Name', true),
                    new StringField('Style'),
                    new IntegerField('Color'),
                    new IntegerField('IBU'),
                    new IntegerField('OG_Avg'),
                    new IntegerField('OG_Override'),
                    new IntegerField('OG_Eq'),
                    new IntegerField('ABV_Avg'),
                    new IntegerField('ABV_Avg_Dec'),
                    new IntegerField('ABV_Eq'),
                    new IntegerField('Attenuation_Override'),
                    new IntegerField('Attenuation_Override_Dec'),
                    new IntegerField('Attenuation_Avg'),
                    new IntegerField('Attenuation_Avg_Dec'),
                    new IntegerField('Attenuation_Eq'),
                    new IntegerField('FG_Eq'),
                    new StringField('Notes'),
                    new IntegerField('Batches')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_Brews_InventoryActivities_Template_search', 'Template', 'id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`Batches`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new DateTimeField('updated', true),
                    new IntegerField('BatchID', true),
                    new StringField('Template', true),
                    new StringField('Batch', true, true),
                    new DateField('Brew Date'),
                    new IntegerField('Ingredient_Cnt'),
                    new IntegerField('Brews-Records'),
                    new StringField('Brews Blended from this Batch'),
                    new StringField('Brews Blended into this Batch'),
                    new IntegerField('Brews'),
                    new IntegerField('Total Brews Calc 1'),
                    new IntegerField('Total Brews Calc 2'),
                    new DateField('Brew Date Start Calc 1'),
                    new DateField('Brew Date End Calc 1'),
                    new DateField('Brew Date Start Calc 2'),
                    new DateField('Brew Date End Calc 2'),
                    new DateField('Brew Date Start'),
                    new DateField('Brew Date End'),
                    new IntegerField('Brew Days'),
                    new IntegerField('Total Brews (Net)'),
                    new StringField('ProPitch'),
                    new StringField('Yeast'),
                    new StringField('Yeast Source'),
                    new StringField('Yeast from FV'),
                    new StringField('Nickname'),
                    new StringField('Status'),
                    new StringField('Batch-Status'),
                    new StringField('Days Running 1'),
                    new StringField('Days Running 2'),
                    new StringField('Style'),
                    new StringField('FV'),
                    new StringField('FV Tank'),
                    new StringField('BT'),
                    new StringField('BT Tank'),
                    new StringField('Current Tank'),
                    new StringField('Bbls'),
                    new StringField('Color'),
                    new StringField('IBU'),
                    new StringField('OG-A'),
                    new StringField('OG-B'),
                    new StringField('OG-C'),
                    new StringField('OG-D'),
                    new StringField('OG-AB'),
                    new StringField('OG-ABC'),
                    new StringField('OG-ABCD'),
                    new StringField('OG'),
                    new StringField('FG_Min'),
                    new StringField('Current Gravity'),
                    new StringField('FG'),
                    new StringField('ABV'),
                    new StringField('Attenuation'),
                    new StringField('Yeast Pitch'),
                    new StringField('Blend Ratio'),
                    new StringField('Notes'),
                    new StringField('Status2'),
                    new StringField('Dry Hop Date'),
                    new StringField('Dry Hop Date Formula'),
                    new StringField('Crash Date'),
                    new StringField('Brite Tank Date'),
                    new StringField('Gone Date'),
                    new StringField('Dry Hop Days'),
                    new StringField('Total Days'),
                    new StringField('Dry Hopped Running'),
                    new StringField('User'),
                    new StringField('Maximum CO2'),
                    new StringField('CO2 Volumes'),
                    new StringField('This Batch Blended into Batch'),
                    new StringField('Batches Blended into this Batch'),
                    new StringField('Calculated Days'),
                    new StringField('Blended'),
                    new StringField('TankLog Count'),
                    new StringField('KegLog Count'),
                    new StringField('Kegs Count'),
                    new StringField('PackageLog Count'),
                    new StringField('KegOrders Count'),
                    new StringField('Net Bbls'),
                    new StringField('Canned & Kegged Barrels'),
                    new StringField('Canning Runs'),
                    new StringField('5G Kegs'),
                    new StringField('50L Kegs'),
                    new StringField('Brews-Bbls'),
                    new StringField('Brews-OG'),
                    new StringField('Net Beer Factor'),
                    new StringField('Batch Gross Bbls Calc'),
                    new StringField('Gross Bbls'),
                    new StringField('Remaining Bbls Calc'),
                    new StringField('Remaining Bbls (Est)'),
                    new StringField('Can Be Deleted'),
                    new StringField('Brews from Template'),
                    new StringField('FermStart-DateCalc'),
                    new StringField('FermStart-DateCalc2'),
                    new StringField('FermEnd-DateCalc'),
                    new StringField('FermEnd-DateCalc2'),
                    new StringField('Ferm-DateCalc'),
                    new StringField('Ferm-DateCalc2'),
                    new StringField('FermEnd-DateDayNumber'),
                    new StringField('DryHop-DateDayAdd'),
                    new StringField('Dryhop-DateCalc'),
                    new StringField('Dryhop-DateDayNumber'),
                    new StringField('Crash-DateDayAdd'),
                    new StringField('Crash-DateCalc'),
                    new StringField('Crash-DateDayNumber'),
                    new StringField('Transfer-DateDayAdd'),
                    new StringField('Transfer-DateCalc'),
                    new StringField('Transfer-DateDayNumber'),
                    new StringField('Package-DateDayAdd'),
                    new StringField('Package-DateCalc'),
                    new StringField('Scheduled Steps'),
                    new StringField('Steps Remaining'),
                    new StringField('PropCrash-DateCalc'),
                    new StringField('PropTrans-DateCalc'),
                    new StringField('Brew Size (Gallons)'),
                    new StringField('Brew % of 7Bbl'),
                    new StringField('Sum - Potential Yield'),
                    new StringField('Potential OG'),
                    new StringField('Efficiency'),
                    new StringField('Ratings'),
                    new StringField('CurrentTank_Name'),
                    new DateField('Canned'),
                    new StringField('PendingActivities'),
                    new StringField('TempLogsCount'),
                    new StringField('Rating')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_Brews_InventoryActivities_Batch_search', 'Batch', 'id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`Brews`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new DateTimeField('updated', true),
                    new StringField('Batch', true),
                    new StringField('Brew ID', true),
                    new StringField('Brew', true, true),
                    new DateField('Brew Date', true),
                    new StringField('Status'),
                    new IntegerField('Mash Temp'),
                    new IntegerField('Lactic Acid'),
                    new IntegerField('Preboil Grav'),
                    new IntegerField('OG'),
                    new IntegerField('pH-Mash'),
                    new IntegerField('pH-First'),
                    new IntegerField('pH-Last'),
                    new IntegerField('pH-Pre boil'),
                    new IntegerField('pH-KO'),
                    new StringField('O2 Setting'),
                    new IntegerField('DO-Line'),
                    new IntegerField('DO-Tank'),
                    new StringField('Notes'),
                    new StringField('User'),
                    new IntegerField('Bbls')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_Brews_InventoryActivities_Brew_search', 'Brew', 'id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`Brews`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new DateTimeField('updated', true),
                    new StringField('Batch', true),
                    new StringField('Brew ID', true),
                    new StringField('Brew', true, true),
                    new DateField('Brew Date', true),
                    new StringField('Status'),
                    new IntegerField('Mash Temp'),
                    new IntegerField('Lactic Acid'),
                    new IntegerField('Preboil Grav'),
                    new IntegerField('OG'),
                    new IntegerField('pH-Mash'),
                    new IntegerField('pH-First'),
                    new IntegerField('pH-Last'),
                    new IntegerField('pH-Pre boil'),
                    new IntegerField('pH-KO'),
                    new StringField('O2 Setting'),
                    new IntegerField('DO-Line'),
                    new IntegerField('DO-Tank'),
                    new StringField('Notes'),
                    new StringField('User'),
                    new IntegerField('Bbls')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_Brews_InventoryActivities_Brew_search', 'Brew', 'id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`InventoryItems`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new DateTimeField('updated', true),
                    new StringField('Item ID'),
                    new StringField('Inventory Item', true, true),
                    new IntegerField('Price/Unit'),
                    new StringField('Active'),
                    new StringField('Label Name from Template'),
                    new StringField('Brand from Template'),
                    new StringField('Brand from Item'),
                    new StringField('BeerSmith Name'),
                    new StringField('Brand'),
                    new StringField('Product Name'),
                    new StringField('Category'),
                    new StringField('Notes'),
                    new StringField('Pkg Type'),
                    new StringField('Qty per Pkg'),
                    new StringField('Unit of Measure'),
                    new StringField('Image'),
                    new StringField('Image : URL'),
                    new IntegerField('Activity Pkg Sum'),
                    new IntegerField('Activity Units (Calc)'),
                    new IntegerField('Activity Units (Sum)'),
                    new StringField('Inventory Pkgs'),
                    new IntegerField('Inventory Units'),
                    new IntegerField('Inventory Value'),
                    new StringField('Qty Description'),
                    new StringField('Activities'),
                    new IntegerField('Inventory - Order'),
                    new IntegerField('Inventory - Warning'),
                    new IntegerField('Inventory - Critical'),
                    new StringField('Orders Pending'),
                    new StringField('Inventory Level'),
                    new StringField('Re-Order Status'),
                    new StringField('Used past 30 days'),
                    new StringField('Alpha Acids'),
                    new StringField('GrainYield'),
                    new StringField('Format'),
                    new StringField('Attachment'),
                    new StringField('Attachment : URL')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_Brews_InventoryActivities_Inventory Item_search', 'Inventory Item', 'id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`Templates`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new DateTimeField('updated', true),
                    new StringField('Template', true, true),
                    new StringField('Brand/Name', true),
                    new StringField('Style'),
                    new IntegerField('Color'),
                    new IntegerField('IBU'),
                    new IntegerField('OG_Avg'),
                    new IntegerField('OG_Override'),
                    new IntegerField('OG_Eq'),
                    new IntegerField('ABV_Avg'),
                    new IntegerField('ABV_Avg_Dec'),
                    new IntegerField('ABV_Eq'),
                    new IntegerField('Attenuation_Override'),
                    new IntegerField('Attenuation_Override_Dec'),
                    new IntegerField('Attenuation_Avg'),
                    new IntegerField('Attenuation_Avg_Dec'),
                    new IntegerField('Attenuation_Eq'),
                    new IntegerField('FG_Eq'),
                    new StringField('Notes'),
                    new IntegerField('Batches')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_Brews_InventoryActivities_Template_search', 'Template', 'id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`Batches`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new DateTimeField('updated', true),
                    new IntegerField('BatchID', true),
                    new StringField('Template', true),
                    new StringField('Batch', true, true),
                    new DateField('Brew Date'),
                    new IntegerField('Ingredient_Cnt'),
                    new IntegerField('Brews-Records'),
                    new StringField('Brews Blended from this Batch'),
                    new StringField('Brews Blended into this Batch'),
                    new IntegerField('Brews'),
                    new IntegerField('Total Brews Calc 1'),
                    new IntegerField('Total Brews Calc 2'),
                    new DateField('Brew Date Start Calc 1'),
                    new DateField('Brew Date End Calc 1'),
                    new DateField('Brew Date Start Calc 2'),
                    new DateField('Brew Date End Calc 2'),
                    new DateField('Brew Date Start'),
                    new DateField('Brew Date End'),
                    new IntegerField('Brew Days'),
                    new IntegerField('Total Brews (Net)'),
                    new StringField('ProPitch'),
                    new StringField('Yeast'),
                    new StringField('Yeast Source'),
                    new StringField('Yeast from FV'),
                    new StringField('Nickname'),
                    new StringField('Status'),
                    new StringField('Batch-Status'),
                    new StringField('Days Running 1'),
                    new StringField('Days Running 2'),
                    new StringField('Style'),
                    new StringField('FV'),
                    new StringField('FV Tank'),
                    new StringField('BT'),
                    new StringField('BT Tank'),
                    new StringField('Current Tank'),
                    new StringField('Bbls'),
                    new StringField('Color'),
                    new StringField('IBU'),
                    new StringField('OG-A'),
                    new StringField('OG-B'),
                    new StringField('OG-C'),
                    new StringField('OG-D'),
                    new StringField('OG-AB'),
                    new StringField('OG-ABC'),
                    new StringField('OG-ABCD'),
                    new StringField('OG'),
                    new StringField('FG_Min'),
                    new StringField('Current Gravity'),
                    new StringField('FG'),
                    new StringField('ABV'),
                    new StringField('Attenuation'),
                    new StringField('Yeast Pitch'),
                    new StringField('Blend Ratio'),
                    new StringField('Notes'),
                    new StringField('Status2'),
                    new StringField('Dry Hop Date'),
                    new StringField('Dry Hop Date Formula'),
                    new StringField('Crash Date'),
                    new StringField('Brite Tank Date'),
                    new StringField('Gone Date'),
                    new StringField('Dry Hop Days'),
                    new StringField('Total Days'),
                    new StringField('Dry Hopped Running'),
                    new StringField('User'),
                    new StringField('Maximum CO2'),
                    new StringField('CO2 Volumes'),
                    new StringField('This Batch Blended into Batch'),
                    new StringField('Batches Blended into this Batch'),
                    new StringField('Calculated Days'),
                    new StringField('Blended'),
                    new StringField('TankLog Count'),
                    new StringField('KegLog Count'),
                    new StringField('Kegs Count'),
                    new StringField('PackageLog Count'),
                    new StringField('KegOrders Count'),
                    new StringField('Net Bbls'),
                    new StringField('Canned & Kegged Barrels'),
                    new StringField('Canning Runs'),
                    new StringField('5G Kegs'),
                    new StringField('50L Kegs'),
                    new StringField('Brews-Bbls'),
                    new StringField('Brews-OG'),
                    new StringField('Net Beer Factor'),
                    new StringField('Batch Gross Bbls Calc'),
                    new StringField('Gross Bbls'),
                    new StringField('Remaining Bbls Calc'),
                    new StringField('Remaining Bbls (Est)'),
                    new StringField('Can Be Deleted'),
                    new StringField('Brews from Template'),
                    new StringField('FermStart-DateCalc'),
                    new StringField('FermStart-DateCalc2'),
                    new StringField('FermEnd-DateCalc'),
                    new StringField('FermEnd-DateCalc2'),
                    new StringField('Ferm-DateCalc'),
                    new StringField('Ferm-DateCalc2'),
                    new StringField('FermEnd-DateDayNumber'),
                    new StringField('DryHop-DateDayAdd'),
                    new StringField('Dryhop-DateCalc'),
                    new StringField('Dryhop-DateDayNumber'),
                    new StringField('Crash-DateDayAdd'),
                    new StringField('Crash-DateCalc'),
                    new StringField('Crash-DateDayNumber'),
                    new StringField('Transfer-DateDayAdd'),
                    new StringField('Transfer-DateCalc'),
                    new StringField('Transfer-DateDayNumber'),
                    new StringField('Package-DateDayAdd'),
                    new StringField('Package-DateCalc'),
                    new StringField('Scheduled Steps'),
                    new StringField('Steps Remaining'),
                    new StringField('PropCrash-DateCalc'),
                    new StringField('PropTrans-DateCalc'),
                    new StringField('Brew Size (Gallons)'),
                    new StringField('Brew % of 7Bbl'),
                    new StringField('Sum - Potential Yield'),
                    new StringField('Potential OG'),
                    new StringField('Efficiency'),
                    new StringField('Ratings'),
                    new StringField('CurrentTank_Name'),
                    new DateField('Canned'),
                    new StringField('PendingActivities'),
                    new StringField('TempLogsCount'),
                    new StringField('Rating')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_Brews_InventoryActivities_Batch_search', 'Batch', 'id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`Brews`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new DateTimeField('updated', true),
                    new StringField('Batch', true),
                    new StringField('Brew ID', true),
                    new StringField('Brew', true, true),
                    new DateField('Brew Date', true),
                    new StringField('Status'),
                    new IntegerField('Mash Temp'),
                    new IntegerField('Lactic Acid'),
                    new IntegerField('Preboil Grav'),
                    new IntegerField('OG'),
                    new IntegerField('pH-Mash'),
                    new IntegerField('pH-First'),
                    new IntegerField('pH-Last'),
                    new IntegerField('pH-Pre boil'),
                    new IntegerField('pH-KO'),
                    new StringField('O2 Setting'),
                    new IntegerField('DO-Line'),
                    new IntegerField('DO-Tank'),
                    new StringField('Notes'),
                    new StringField('User'),
                    new IntegerField('Bbls')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_Brews_InventoryActivities_Brew_search', 'Brew', 'id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`InventoryItems`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new DateTimeField('updated', true),
                    new StringField('Item ID'),
                    new StringField('Inventory Item', true, true),
                    new IntegerField('Price/Unit'),
                    new StringField('Active'),
                    new StringField('Label Name from Template'),
                    new StringField('Brand from Template'),
                    new StringField('Brand from Item'),
                    new StringField('BeerSmith Name'),
                    new StringField('Brand'),
                    new StringField('Product Name'),
                    new StringField('Category'),
                    new StringField('Notes'),
                    new StringField('Pkg Type'),
                    new StringField('Qty per Pkg'),
                    new StringField('Unit of Measure'),
                    new StringField('Image'),
                    new StringField('Image : URL'),
                    new IntegerField('Activity Pkg Sum'),
                    new IntegerField('Activity Units (Calc)'),
                    new IntegerField('Activity Units (Sum)'),
                    new StringField('Inventory Pkgs'),
                    new IntegerField('Inventory Units'),
                    new IntegerField('Inventory Value'),
                    new StringField('Qty Description'),
                    new StringField('Activities'),
                    new IntegerField('Inventory - Order'),
                    new IntegerField('Inventory - Warning'),
                    new IntegerField('Inventory - Critical'),
                    new StringField('Orders Pending'),
                    new StringField('Inventory Level'),
                    new StringField('Re-Order Status'),
                    new StringField('Used past 30 days'),
                    new StringField('Alpha Acids'),
                    new StringField('GrainYield'),
                    new StringField('Format'),
                    new StringField('Attachment'),
                    new StringField('Attachment : URL')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_Brews_InventoryActivities_Inventory Item_search', 'Inventory Item', 'id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`Templates`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new DateTimeField('updated', true),
                    new StringField('Template', true, true),
                    new StringField('Brand/Name', true),
                    new StringField('Style'),
                    new IntegerField('Color'),
                    new IntegerField('IBU'),
                    new IntegerField('OG_Avg'),
                    new IntegerField('OG_Override'),
                    new IntegerField('OG_Eq'),
                    new IntegerField('ABV_Avg'),
                    new IntegerField('ABV_Avg_Dec'),
                    new IntegerField('ABV_Eq'),
                    new IntegerField('Attenuation_Override'),
                    new IntegerField('Attenuation_Override_Dec'),
                    new IntegerField('Attenuation_Avg'),
                    new IntegerField('Attenuation_Avg_Dec'),
                    new IntegerField('Attenuation_Eq'),
                    new IntegerField('FG_Eq'),
                    new StringField('Notes'),
                    new IntegerField('Batches')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_Brews_InventoryActivities_Template_search', 'Template', 'id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`Batches`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new DateTimeField('updated', true),
                    new IntegerField('BatchID', true),
                    new StringField('Template', true),
                    new StringField('Batch', true, true),
                    new DateField('Brew Date'),
                    new IntegerField('Ingredient_Cnt'),
                    new IntegerField('Brews-Records'),
                    new StringField('Brews Blended from this Batch'),
                    new StringField('Brews Blended into this Batch'),
                    new IntegerField('Brews'),
                    new IntegerField('Total Brews Calc 1'),
                    new IntegerField('Total Brews Calc 2'),
                    new DateField('Brew Date Start Calc 1'),
                    new DateField('Brew Date End Calc 1'),
                    new DateField('Brew Date Start Calc 2'),
                    new DateField('Brew Date End Calc 2'),
                    new DateField('Brew Date Start'),
                    new DateField('Brew Date End'),
                    new IntegerField('Brew Days'),
                    new IntegerField('Total Brews (Net)'),
                    new StringField('ProPitch'),
                    new StringField('Yeast'),
                    new StringField('Yeast Source'),
                    new StringField('Yeast from FV'),
                    new StringField('Nickname'),
                    new StringField('Status'),
                    new StringField('Batch-Status'),
                    new StringField('Days Running 1'),
                    new StringField('Days Running 2'),
                    new StringField('Style'),
                    new StringField('FV'),
                    new StringField('FV Tank'),
                    new StringField('BT'),
                    new StringField('BT Tank'),
                    new StringField('Current Tank'),
                    new StringField('Bbls'),
                    new StringField('Color'),
                    new StringField('IBU'),
                    new StringField('OG-A'),
                    new StringField('OG-B'),
                    new StringField('OG-C'),
                    new StringField('OG-D'),
                    new StringField('OG-AB'),
                    new StringField('OG-ABC'),
                    new StringField('OG-ABCD'),
                    new StringField('OG'),
                    new StringField('FG_Min'),
                    new StringField('Current Gravity'),
                    new StringField('FG'),
                    new StringField('ABV'),
                    new StringField('Attenuation'),
                    new StringField('Yeast Pitch'),
                    new StringField('Blend Ratio'),
                    new StringField('Notes'),
                    new StringField('Status2'),
                    new StringField('Dry Hop Date'),
                    new StringField('Dry Hop Date Formula'),
                    new StringField('Crash Date'),
                    new StringField('Brite Tank Date'),
                    new StringField('Gone Date'),
                    new StringField('Dry Hop Days'),
                    new StringField('Total Days'),
                    new StringField('Dry Hopped Running'),
                    new StringField('User'),
                    new StringField('Maximum CO2'),
                    new StringField('CO2 Volumes'),
                    new StringField('This Batch Blended into Batch'),
                    new StringField('Batches Blended into this Batch'),
                    new StringField('Calculated Days'),
                    new StringField('Blended'),
                    new StringField('TankLog Count'),
                    new StringField('KegLog Count'),
                    new StringField('Kegs Count'),
                    new StringField('PackageLog Count'),
                    new StringField('KegOrders Count'),
                    new StringField('Net Bbls'),
                    new StringField('Canned & Kegged Barrels'),
                    new StringField('Canning Runs'),
                    new StringField('5G Kegs'),
                    new StringField('50L Kegs'),
                    new StringField('Brews-Bbls'),
                    new StringField('Brews-OG'),
                    new StringField('Net Beer Factor'),
                    new StringField('Batch Gross Bbls Calc'),
                    new StringField('Gross Bbls'),
                    new StringField('Remaining Bbls Calc'),
                    new StringField('Remaining Bbls (Est)'),
                    new StringField('Can Be Deleted'),
                    new StringField('Brews from Template'),
                    new StringField('FermStart-DateCalc'),
                    new StringField('FermStart-DateCalc2'),
                    new StringField('FermEnd-DateCalc'),
                    new StringField('FermEnd-DateCalc2'),
                    new StringField('Ferm-DateCalc'),
                    new StringField('Ferm-DateCalc2'),
                    new StringField('FermEnd-DateDayNumber'),
                    new StringField('DryHop-DateDayAdd'),
                    new StringField('Dryhop-DateCalc'),
                    new StringField('Dryhop-DateDayNumber'),
                    new StringField('Crash-DateDayAdd'),
                    new StringField('Crash-DateCalc'),
                    new StringField('Crash-DateDayNumber'),
                    new StringField('Transfer-DateDayAdd'),
                    new StringField('Transfer-DateCalc'),
                    new StringField('Transfer-DateDayNumber'),
                    new StringField('Package-DateDayAdd'),
                    new StringField('Package-DateCalc'),
                    new StringField('Scheduled Steps'),
                    new StringField('Steps Remaining'),
                    new StringField('PropCrash-DateCalc'),
                    new StringField('PropTrans-DateCalc'),
                    new StringField('Brew Size (Gallons)'),
                    new StringField('Brew % of 7Bbl'),
                    new StringField('Sum - Potential Yield'),
                    new StringField('Potential OG'),
                    new StringField('Efficiency'),
                    new StringField('Ratings'),
                    new StringField('CurrentTank_Name'),
                    new DateField('Canned'),
                    new StringField('PendingActivities'),
                    new StringField('TempLogsCount'),
                    new StringField('Rating')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_Brews_InventoryActivities_Batch_search', 'Batch', 'id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`Brews`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new DateTimeField('updated', true),
                    new StringField('Batch', true),
                    new StringField('Brew ID', true),
                    new StringField('Brew', true, true),
                    new DateField('Brew Date', true),
                    new StringField('Status'),
                    new IntegerField('Mash Temp'),
                    new IntegerField('Lactic Acid'),
                    new IntegerField('Preboil Grav'),
                    new IntegerField('OG'),
                    new IntegerField('pH-Mash'),
                    new IntegerField('pH-First'),
                    new IntegerField('pH-Last'),
                    new IntegerField('pH-Pre boil'),
                    new IntegerField('pH-KO'),
                    new StringField('O2 Setting'),
                    new IntegerField('DO-Line'),
                    new IntegerField('DO-Tank'),
                    new StringField('Notes'),
                    new StringField('User'),
                    new IntegerField('Bbls')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_Brews_InventoryActivities_Brew_search', 'Brew', 'id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
        }
       
        protected function doCustomRenderColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderPrintColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderExportColumn($exportType, $fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomDrawRow($rowData, &$cellFontColor, &$cellFontSize, &$cellBgColor, &$cellItalicAttr, &$cellBoldAttr)
        {
    
        }
    
        protected function doExtendedCustomDrawRow($rowData, &$rowCellStyles, &$rowStyles, &$rowClasses, &$cellClasses)
        {
    
        }
    
        protected function doCustomRenderTotal($totalValue, $aggregate, $columnName, &$customText, &$handled)
        {
    
        }
    
        protected function doCustomDefaultValues(&$values, &$handled) 
        {
    
        }
    
        protected function doCustomCompareColumn($columnName, $valueA, $valueB, &$result)
        {
    
        }
    
        protected function doBeforeInsertRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeUpdateRecord($page, $oldRowData, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeDeleteRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterInsertRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterUpdateRecord($page, $oldRowData, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterDeleteRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doCustomHTMLHeader($page, &$customHtmlHeaderText)
        { 
    
        }
    
        protected function doGetCustomTemplate($type, $part, $mode, &$result, &$params)
        {
    
        }
    
        protected function doGetCustomExportOptions(Page $page, $exportType, $rowData, &$options)
        {
    
        }
    
        protected function doFileUpload($fieldName, $rowData, &$result, &$accept, $originalFileName, $originalFileExtension, $fileSize, $tempFileName)
        {
    
        }
    
        protected function doPrepareChart(Chart $chart)
        {
    
        }
    
        protected function doPrepareColumnFilter(ColumnFilter $columnFilter)
        {
    
        }
    
        protected function doPrepareFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
    
        }
    
        protected function doGetSelectionFilters(FixedKeysArray $columns, &$result)
        {
    
        }
    
        protected function doGetCustomFormLayout($mode, FixedKeysArray $columns, FormLayout $layout)
        {
    
        }
    
        protected function doGetCustomColumnGroup(FixedKeysArray $columns, ViewColumnGroup $columnGroup)
        {
    
        }
    
        protected function doPageLoaded()
        {
    
        }
    
        protected function doCalculateFields($rowData, $fieldName, &$value)
        {
    
        }
    
        protected function doGetCustomRecordPermissions(Page $page, &$usingCondition, $rowData, &$allowEdit, &$allowDelete, &$mergeWithDefault, &$handled)
        {
    
        }
    
        protected function doAddEnvironmentVariables(Page $page, &$variables)
        {
    
        }
    
    }
    
    // OnBeforePageExecute event handler
    
    
    
    class BrewsPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Brews');
            $this->SetMenuLabel('Brews');
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`Brews`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new DateTimeField('updated', true),
                    new StringField('Batch', true),
                    new StringField('Brew ID', true),
                    new StringField('Brew', true, true),
                    new DateField('Brew Date', true),
                    new StringField('Status'),
                    new IntegerField('Mash Temp'),
                    new IntegerField('Lactic Acid'),
                    new IntegerField('Preboil Grav'),
                    new IntegerField('OG'),
                    new IntegerField('pH-Mash'),
                    new IntegerField('pH-First'),
                    new IntegerField('pH-Last'),
                    new IntegerField('pH-Pre boil'),
                    new IntegerField('pH-KO'),
                    new StringField('O2 Setting'),
                    new IntegerField('DO-Line'),
                    new IntegerField('DO-Tank'),
                    new StringField('Notes'),
                    new StringField('User'),
                    new IntegerField('Bbls')
                )
            );
            $this->dataset->AddLookupField('Batch', 'Batches', new StringField('Batch'), new IntegerField('id', false, false, false, false, 'Batch_id', 'Batch_id_Batches'), 'Batch_id_Batches');
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
    
        protected function CreateRssGenerator()
        {
            return null;
        }
    
        protected function setupCharts()
        {
    
        }
    
        protected function getFiltersColumns()
        {
            return array(
                new FilterColumn($this->dataset, 'id', 'id', 'Id'),
                new FilterColumn($this->dataset, 'updated', 'updated', 'Updated'),
                new FilterColumn($this->dataset, 'Batch', 'Batch_id', 'Batch'),
                new FilterColumn($this->dataset, 'Brew ID', 'Brew ID', 'Brew ID'),
                new FilterColumn($this->dataset, 'Brew', 'Brew', 'Brew'),
                new FilterColumn($this->dataset, 'Brew Date', 'Brew Date', 'Brew Date'),
                new FilterColumn($this->dataset, 'Status', 'Status', 'Status'),
                new FilterColumn($this->dataset, 'Mash Temp', 'Mash Temp', 'Mash Temp'),
                new FilterColumn($this->dataset, 'Lactic Acid', 'Lactic Acid', 'Lactic Acid'),
                new FilterColumn($this->dataset, 'Preboil Grav', 'Preboil Grav', 'Preboil Grav'),
                new FilterColumn($this->dataset, 'OG', 'OG', 'OG'),
                new FilterColumn($this->dataset, 'pH-Mash', 'pH-Mash', 'PH-Mash'),
                new FilterColumn($this->dataset, 'pH-First', 'pH-First', 'PH-First'),
                new FilterColumn($this->dataset, 'pH-Last', 'pH-Last', 'PH-Last'),
                new FilterColumn($this->dataset, 'pH-Pre boil', 'pH-Pre boil', 'PH-Pre Boil'),
                new FilterColumn($this->dataset, 'pH-KO', 'pH-KO', 'PH-KO'),
                new FilterColumn($this->dataset, 'O2 Setting', 'O2 Setting', 'O2 Setting'),
                new FilterColumn($this->dataset, 'DO-Line', 'DO-Line', 'DO-Line'),
                new FilterColumn($this->dataset, 'DO-Tank', 'DO-Tank', 'DO-Tank'),
                new FilterColumn($this->dataset, 'Notes', 'Notes', 'Notes'),
                new FilterColumn($this->dataset, 'User', 'User', 'User'),
                new FilterColumn($this->dataset, 'Bbls', 'Bbls', 'Bbls')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['id'])
                ->addColumn($columns['updated'])
                ->addColumn($columns['Batch'])
                ->addColumn($columns['Brew ID'])
                ->addColumn($columns['Brew'])
                ->addColumn($columns['Brew Date'])
                ->addColumn($columns['Status'])
                ->addColumn($columns['Mash Temp'])
                ->addColumn($columns['Lactic Acid'])
                ->addColumn($columns['Preboil Grav'])
                ->addColumn($columns['OG'])
                ->addColumn($columns['pH-Mash'])
                ->addColumn($columns['pH-First'])
                ->addColumn($columns['pH-Last'])
                ->addColumn($columns['pH-Pre boil'])
                ->addColumn($columns['pH-KO'])
                ->addColumn($columns['O2 Setting'])
                ->addColumn($columns['DO-Line'])
                ->addColumn($columns['DO-Tank'])
                ->addColumn($columns['Notes'])
                ->addColumn($columns['User'])
                ->addColumn($columns['Bbls']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('updated')
                ->setOptionsFor('Batch')
                ->setOptionsFor('Brew Date');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new TextEdit('id_edit');
            
            $filterBuilder->addColumn(
                $columns['id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('updated_edit', false, 'Y-m-d H:i:s');
            
            $filterBuilder->addColumn(
                $columns['updated'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('batch_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_Brews_Batch_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('Batch', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_Brews_Batch_search');
            
            $filterBuilder->addColumn(
                $columns['Batch'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('brew_id_edit');
            $main_editor->SetMaxLength(10);
            
            $filterBuilder->addColumn(
                $columns['Brew ID'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('brew_edit');
            $main_editor->SetMaxLength(85);
            
            $filterBuilder->addColumn(
                $columns['Brew'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('brew_date_edit', false, 'Y-m-d');
            
            $filterBuilder->addColumn(
                $columns['Brew Date'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('status_edit');
            $main_editor->SetMaxLength(64);
            
            $filterBuilder->addColumn(
                $columns['Status'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('mash_temp_edit');
            
            $filterBuilder->addColumn(
                $columns['Mash Temp'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('lactic_acid_edit');
            
            $filterBuilder->addColumn(
                $columns['Lactic Acid'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('preboil_grav_edit');
            
            $filterBuilder->addColumn(
                $columns['Preboil Grav'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('og_edit');
            
            $filterBuilder->addColumn(
                $columns['OG'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('ph-mash_edit');
            
            $filterBuilder->addColumn(
                $columns['pH-Mash'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('ph-first_edit');
            
            $filterBuilder->addColumn(
                $columns['pH-First'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('ph-last_edit');
            
            $filterBuilder->addColumn(
                $columns['pH-Last'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('ph-pre_boil_edit');
            
            $filterBuilder->addColumn(
                $columns['pH-Pre boil'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('ph-ko_edit');
            
            $filterBuilder->addColumn(
                $columns['pH-KO'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('o2_setting_edit');
            $main_editor->SetMaxLength(64);
            
            $filterBuilder->addColumn(
                $columns['O2 Setting'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('do-line_edit');
            
            $filterBuilder->addColumn(
                $columns['DO-Line'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('do-tank_edit');
            
            $filterBuilder->addColumn(
                $columns['DO-Tank'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('Notes');
            
            $filterBuilder->addColumn(
                $columns['Notes'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('user_edit');
            $main_editor->SetMaxLength(64);
            
            $filterBuilder->addColumn(
                $columns['User'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('bbls_edit');
            
            $filterBuilder->addColumn(
                $columns['Bbls'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
            $actions = $grid->getActions();
            $actions->setCaption($this->GetLocalizerCaptions()->GetMessageString('Actions'));
            $actions->setPosition(ActionList::POSITION_LEFT);
            
            if ($this->GetSecurityInfo()->HasViewGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('View'), OPERATION_VIEW, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
            
            if ($this->GetSecurityInfo()->HasEditGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Edit'), OPERATION_EDIT, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowEditButtonHandler', $this);
            }
            
            if ($this->deleteOperationIsAllowed()) {
                $operation = new AjaxOperation(OPERATION_DELETE,
                    $this->GetLocalizerCaptions()->GetMessageString('Delete'),
                    $this->GetLocalizerCaptions()->GetMessageString('Delete'), $this->dataset,
                    $this->GetModalGridDeleteHandler(), $grid
                );
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowDeleteButtonHandler', $this);
            }
            
            
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Copy'), OPERATION_COPY, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
        }
    
        protected function AddFieldColumns(Grid $grid, $withDetails = true)
        {
            if (GetCurrentUserPermissionsForPage('Brews.InventoryActivities')->HasViewGrant() && $withDetails)
            {
            //
            // View column for Brews_InventoryActivities detail
            //
            $column = new DetailColumn(array('Brew'), 'Brews.InventoryActivities', 'Brews_InventoryActivities_handler', $this->dataset, 'Inventory Activities');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            }
            
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for updated field
            //
            $column = new DateTimeViewColumn('updated', 'updated', 'Updated', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for id field
            //
            $column = new NumberViewColumn('Batch', 'Batch_id', 'Batch', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Brew ID field
            //
            $column = new TextViewColumn('Brew ID', 'Brew ID', 'Brew ID', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Brew field
            //
            $column = new TextViewColumn('Brew', 'Brew', 'Brew', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Brew Date field
            //
            $column = new DateTimeViewColumn('Brew Date', 'Brew Date', 'Brew Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Status field
            //
            $column = new TextViewColumn('Status', 'Status', 'Status', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Mash Temp field
            //
            $column = new NumberViewColumn('Mash Temp', 'Mash Temp', 'Mash Temp', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Lactic Acid field
            //
            $column = new NumberViewColumn('Lactic Acid', 'Lactic Acid', 'Lactic Acid', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Preboil Grav field
            //
            $column = new NumberViewColumn('Preboil Grav', 'Preboil Grav', 'Preboil Grav', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for OG field
            //
            $column = new NumberViewColumn('OG', 'OG', 'OG', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for pH-Mash field
            //
            $column = new NumberViewColumn('pH-Mash', 'pH-Mash', 'PH-Mash', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for pH-First field
            //
            $column = new NumberViewColumn('pH-First', 'pH-First', 'PH-First', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for pH-Last field
            //
            $column = new NumberViewColumn('pH-Last', 'pH-Last', 'PH-Last', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for pH-Pre boil field
            //
            $column = new NumberViewColumn('pH-Pre boil', 'pH-Pre boil', 'PH-Pre Boil', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for pH-KO field
            //
            $column = new NumberViewColumn('pH-KO', 'pH-KO', 'PH-KO', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for O2 Setting field
            //
            $column = new TextViewColumn('O2 Setting', 'O2 Setting', 'O2 Setting', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for DO-Line field
            //
            $column = new NumberViewColumn('DO-Line', 'DO-Line', 'DO-Line', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for DO-Tank field
            //
            $column = new NumberViewColumn('DO-Tank', 'DO-Tank', 'DO-Tank', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Notes field
            //
            $column = new TextViewColumn('Notes', 'Notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for User field
            //
            $column = new TextViewColumn('User', 'User', 'User', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Bbls field
            //
            $column = new NumberViewColumn('Bbls', 'Bbls', 'Bbls', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for updated field
            //
            $column = new DateTimeViewColumn('updated', 'updated', 'Updated', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for id field
            //
            $column = new NumberViewColumn('Batch', 'Batch_id', 'Batch', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Brew ID field
            //
            $column = new TextViewColumn('Brew ID', 'Brew ID', 'Brew ID', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Brew field
            //
            $column = new TextViewColumn('Brew', 'Brew', 'Brew', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Brew Date field
            //
            $column = new DateTimeViewColumn('Brew Date', 'Brew Date', 'Brew Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Status field
            //
            $column = new TextViewColumn('Status', 'Status', 'Status', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Mash Temp field
            //
            $column = new NumberViewColumn('Mash Temp', 'Mash Temp', 'Mash Temp', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Lactic Acid field
            //
            $column = new NumberViewColumn('Lactic Acid', 'Lactic Acid', 'Lactic Acid', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Preboil Grav field
            //
            $column = new NumberViewColumn('Preboil Grav', 'Preboil Grav', 'Preboil Grav', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for OG field
            //
            $column = new NumberViewColumn('OG', 'OG', 'OG', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for pH-Mash field
            //
            $column = new NumberViewColumn('pH-Mash', 'pH-Mash', 'PH-Mash', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for pH-First field
            //
            $column = new NumberViewColumn('pH-First', 'pH-First', 'PH-First', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for pH-Last field
            //
            $column = new NumberViewColumn('pH-Last', 'pH-Last', 'PH-Last', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for pH-Pre boil field
            //
            $column = new NumberViewColumn('pH-Pre boil', 'pH-Pre boil', 'PH-Pre Boil', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for pH-KO field
            //
            $column = new NumberViewColumn('pH-KO', 'pH-KO', 'PH-KO', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for O2 Setting field
            //
            $column = new TextViewColumn('O2 Setting', 'O2 Setting', 'O2 Setting', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for DO-Line field
            //
            $column = new NumberViewColumn('DO-Line', 'DO-Line', 'DO-Line', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for DO-Tank field
            //
            $column = new NumberViewColumn('DO-Tank', 'DO-Tank', 'DO-Tank', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Notes field
            //
            $column = new TextViewColumn('Notes', 'Notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for User field
            //
            $column = new TextViewColumn('User', 'User', 'User', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Bbls field
            //
            $column = new NumberViewColumn('Bbls', 'Bbls', 'Bbls', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for updated field
            //
            $editor = new DateTimeEdit('updated_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Updated', 'updated', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Batch field
            //
            $editor = new DynamicCombobox('batch_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`Batches`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new DateTimeField('updated', true),
                    new IntegerField('BatchID', true),
                    new StringField('Template', true),
                    new StringField('Batch', true, true),
                    new DateField('Brew Date'),
                    new IntegerField('Ingredient_Cnt'),
                    new IntegerField('Brews-Records'),
                    new StringField('Brews Blended from this Batch'),
                    new StringField('Brews Blended into this Batch'),
                    new IntegerField('Brews'),
                    new IntegerField('Total Brews Calc 1'),
                    new IntegerField('Total Brews Calc 2'),
                    new DateField('Brew Date Start Calc 1'),
                    new DateField('Brew Date End Calc 1'),
                    new DateField('Brew Date Start Calc 2'),
                    new DateField('Brew Date End Calc 2'),
                    new DateField('Brew Date Start'),
                    new DateField('Brew Date End'),
                    new IntegerField('Brew Days'),
                    new IntegerField('Total Brews (Net)'),
                    new StringField('ProPitch'),
                    new StringField('Yeast'),
                    new StringField('Yeast Source'),
                    new StringField('Yeast from FV'),
                    new StringField('Nickname'),
                    new StringField('Status'),
                    new StringField('Batch-Status'),
                    new StringField('Days Running 1'),
                    new StringField('Days Running 2'),
                    new StringField('Style'),
                    new StringField('FV'),
                    new StringField('FV Tank'),
                    new StringField('BT'),
                    new StringField('BT Tank'),
                    new StringField('Current Tank'),
                    new StringField('Bbls'),
                    new StringField('Color'),
                    new StringField('IBU'),
                    new StringField('OG-A'),
                    new StringField('OG-B'),
                    new StringField('OG-C'),
                    new StringField('OG-D'),
                    new StringField('OG-AB'),
                    new StringField('OG-ABC'),
                    new StringField('OG-ABCD'),
                    new StringField('OG'),
                    new StringField('FG_Min'),
                    new StringField('Current Gravity'),
                    new StringField('FG'),
                    new StringField('ABV'),
                    new StringField('Attenuation'),
                    new StringField('Yeast Pitch'),
                    new StringField('Blend Ratio'),
                    new StringField('Notes'),
                    new StringField('Status2'),
                    new StringField('Dry Hop Date'),
                    new StringField('Dry Hop Date Formula'),
                    new StringField('Crash Date'),
                    new StringField('Brite Tank Date'),
                    new StringField('Gone Date'),
                    new StringField('Dry Hop Days'),
                    new StringField('Total Days'),
                    new StringField('Dry Hopped Running'),
                    new StringField('User'),
                    new StringField('Maximum CO2'),
                    new StringField('CO2 Volumes'),
                    new StringField('This Batch Blended into Batch'),
                    new StringField('Batches Blended into this Batch'),
                    new StringField('Calculated Days'),
                    new StringField('Blended'),
                    new StringField('TankLog Count'),
                    new StringField('KegLog Count'),
                    new StringField('Kegs Count'),
                    new StringField('PackageLog Count'),
                    new StringField('KegOrders Count'),
                    new StringField('Net Bbls'),
                    new StringField('Canned & Kegged Barrels'),
                    new StringField('Canning Runs'),
                    new StringField('5G Kegs'),
                    new StringField('50L Kegs'),
                    new StringField('Brews-Bbls'),
                    new StringField('Brews-OG'),
                    new StringField('Net Beer Factor'),
                    new StringField('Batch Gross Bbls Calc'),
                    new StringField('Gross Bbls'),
                    new StringField('Remaining Bbls Calc'),
                    new StringField('Remaining Bbls (Est)'),
                    new StringField('Can Be Deleted'),
                    new StringField('Brews from Template'),
                    new StringField('FermStart-DateCalc'),
                    new StringField('FermStart-DateCalc2'),
                    new StringField('FermEnd-DateCalc'),
                    new StringField('FermEnd-DateCalc2'),
                    new StringField('Ferm-DateCalc'),
                    new StringField('Ferm-DateCalc2'),
                    new StringField('FermEnd-DateDayNumber'),
                    new StringField('DryHop-DateDayAdd'),
                    new StringField('Dryhop-DateCalc'),
                    new StringField('Dryhop-DateDayNumber'),
                    new StringField('Crash-DateDayAdd'),
                    new StringField('Crash-DateCalc'),
                    new StringField('Crash-DateDayNumber'),
                    new StringField('Transfer-DateDayAdd'),
                    new StringField('Transfer-DateCalc'),
                    new StringField('Transfer-DateDayNumber'),
                    new StringField('Package-DateDayAdd'),
                    new StringField('Package-DateCalc'),
                    new StringField('Scheduled Steps'),
                    new StringField('Steps Remaining'),
                    new StringField('PropCrash-DateCalc'),
                    new StringField('PropTrans-DateCalc'),
                    new StringField('Brew Size (Gallons)'),
                    new StringField('Brew % of 7Bbl'),
                    new StringField('Sum - Potential Yield'),
                    new StringField('Potential OG'),
                    new StringField('Efficiency'),
                    new StringField('Ratings'),
                    new StringField('CurrentTank_Name'),
                    new DateField('Canned'),
                    new StringField('PendingActivities'),
                    new StringField('TempLogsCount'),
                    new StringField('Rating')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Batch', 'Batch', 'Batch_id', 'edit_Brews_Batch_search', $editor, $this->dataset, $lookupDataset, 'Batch', 'id', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Brew ID field
            //
            $editor = new TextEdit('brew_id_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Brew ID', 'Brew ID', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Brew Date field
            //
            $editor = new DateTimeEdit('brew_date_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Brew Date', 'Brew Date', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Status field
            //
            $editor = new TextEdit('status_edit');
            $editor->SetMaxLength(64);
            $editColumn = new CustomEditColumn('Status', 'Status', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Mash Temp field
            //
            $editor = new TextEdit('mash_temp_edit');
            $editColumn = new CustomEditColumn('Mash Temp', 'Mash Temp', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Lactic Acid field
            //
            $editor = new TextEdit('lactic_acid_edit');
            $editColumn = new CustomEditColumn('Lactic Acid', 'Lactic Acid', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Preboil Grav field
            //
            $editor = new TextEdit('preboil_grav_edit');
            $editColumn = new CustomEditColumn('Preboil Grav', 'Preboil Grav', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for OG field
            //
            $editor = new TextEdit('og_edit');
            $editColumn = new CustomEditColumn('OG', 'OG', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for pH-Mash field
            //
            $editor = new TextEdit('ph-mash_edit');
            $editColumn = new CustomEditColumn('PH-Mash', 'pH-Mash', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for pH-First field
            //
            $editor = new TextEdit('ph-first_edit');
            $editColumn = new CustomEditColumn('PH-First', 'pH-First', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for pH-Last field
            //
            $editor = new TextEdit('ph-last_edit');
            $editColumn = new CustomEditColumn('PH-Last', 'pH-Last', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for pH-Pre boil field
            //
            $editor = new TextEdit('ph-pre_boil_edit');
            $editColumn = new CustomEditColumn('PH-Pre Boil', 'pH-Pre boil', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for pH-KO field
            //
            $editor = new TextEdit('ph-ko_edit');
            $editColumn = new CustomEditColumn('PH-KO', 'pH-KO', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for O2 Setting field
            //
            $editor = new TextEdit('o2_setting_edit');
            $editor->SetMaxLength(64);
            $editColumn = new CustomEditColumn('O2 Setting', 'O2 Setting', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for DO-Line field
            //
            $editor = new TextEdit('do-line_edit');
            $editColumn = new CustomEditColumn('DO-Line', 'DO-Line', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for DO-Tank field
            //
            $editor = new TextEdit('do-tank_edit');
            $editColumn = new CustomEditColumn('DO-Tank', 'DO-Tank', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Notes field
            //
            $editor = new TextAreaEdit('notes_edit', 50, 8);
            $editColumn = new CustomEditColumn('Notes', 'Notes', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for User field
            //
            $editor = new TextEdit('user_edit');
            $editor->SetMaxLength(64);
            $editColumn = new CustomEditColumn('User', 'User', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Bbls field
            //
            $editor = new TextEdit('bbls_edit');
            $editColumn = new CustomEditColumn('Bbls', 'Bbls', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for updated field
            //
            $editor = new DateTimeEdit('updated_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Updated', 'updated', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Batch field
            //
            $editor = new DynamicCombobox('batch_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`Batches`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new DateTimeField('updated', true),
                    new IntegerField('BatchID', true),
                    new StringField('Template', true),
                    new StringField('Batch', true, true),
                    new DateField('Brew Date'),
                    new IntegerField('Ingredient_Cnt'),
                    new IntegerField('Brews-Records'),
                    new StringField('Brews Blended from this Batch'),
                    new StringField('Brews Blended into this Batch'),
                    new IntegerField('Brews'),
                    new IntegerField('Total Brews Calc 1'),
                    new IntegerField('Total Brews Calc 2'),
                    new DateField('Brew Date Start Calc 1'),
                    new DateField('Brew Date End Calc 1'),
                    new DateField('Brew Date Start Calc 2'),
                    new DateField('Brew Date End Calc 2'),
                    new DateField('Brew Date Start'),
                    new DateField('Brew Date End'),
                    new IntegerField('Brew Days'),
                    new IntegerField('Total Brews (Net)'),
                    new StringField('ProPitch'),
                    new StringField('Yeast'),
                    new StringField('Yeast Source'),
                    new StringField('Yeast from FV'),
                    new StringField('Nickname'),
                    new StringField('Status'),
                    new StringField('Batch-Status'),
                    new StringField('Days Running 1'),
                    new StringField('Days Running 2'),
                    new StringField('Style'),
                    new StringField('FV'),
                    new StringField('FV Tank'),
                    new StringField('BT'),
                    new StringField('BT Tank'),
                    new StringField('Current Tank'),
                    new StringField('Bbls'),
                    new StringField('Color'),
                    new StringField('IBU'),
                    new StringField('OG-A'),
                    new StringField('OG-B'),
                    new StringField('OG-C'),
                    new StringField('OG-D'),
                    new StringField('OG-AB'),
                    new StringField('OG-ABC'),
                    new StringField('OG-ABCD'),
                    new StringField('OG'),
                    new StringField('FG_Min'),
                    new StringField('Current Gravity'),
                    new StringField('FG'),
                    new StringField('ABV'),
                    new StringField('Attenuation'),
                    new StringField('Yeast Pitch'),
                    new StringField('Blend Ratio'),
                    new StringField('Notes'),
                    new StringField('Status2'),
                    new StringField('Dry Hop Date'),
                    new StringField('Dry Hop Date Formula'),
                    new StringField('Crash Date'),
                    new StringField('Brite Tank Date'),
                    new StringField('Gone Date'),
                    new StringField('Dry Hop Days'),
                    new StringField('Total Days'),
                    new StringField('Dry Hopped Running'),
                    new StringField('User'),
                    new StringField('Maximum CO2'),
                    new StringField('CO2 Volumes'),
                    new StringField('This Batch Blended into Batch'),
                    new StringField('Batches Blended into this Batch'),
                    new StringField('Calculated Days'),
                    new StringField('Blended'),
                    new StringField('TankLog Count'),
                    new StringField('KegLog Count'),
                    new StringField('Kegs Count'),
                    new StringField('PackageLog Count'),
                    new StringField('KegOrders Count'),
                    new StringField('Net Bbls'),
                    new StringField('Canned & Kegged Barrels'),
                    new StringField('Canning Runs'),
                    new StringField('5G Kegs'),
                    new StringField('50L Kegs'),
                    new StringField('Brews-Bbls'),
                    new StringField('Brews-OG'),
                    new StringField('Net Beer Factor'),
                    new StringField('Batch Gross Bbls Calc'),
                    new StringField('Gross Bbls'),
                    new StringField('Remaining Bbls Calc'),
                    new StringField('Remaining Bbls (Est)'),
                    new StringField('Can Be Deleted'),
                    new StringField('Brews from Template'),
                    new StringField('FermStart-DateCalc'),
                    new StringField('FermStart-DateCalc2'),
                    new StringField('FermEnd-DateCalc'),
                    new StringField('FermEnd-DateCalc2'),
                    new StringField('Ferm-DateCalc'),
                    new StringField('Ferm-DateCalc2'),
                    new StringField('FermEnd-DateDayNumber'),
                    new StringField('DryHop-DateDayAdd'),
                    new StringField('Dryhop-DateCalc'),
                    new StringField('Dryhop-DateDayNumber'),
                    new StringField('Crash-DateDayAdd'),
                    new StringField('Crash-DateCalc'),
                    new StringField('Crash-DateDayNumber'),
                    new StringField('Transfer-DateDayAdd'),
                    new StringField('Transfer-DateCalc'),
                    new StringField('Transfer-DateDayNumber'),
                    new StringField('Package-DateDayAdd'),
                    new StringField('Package-DateCalc'),
                    new StringField('Scheduled Steps'),
                    new StringField('Steps Remaining'),
                    new StringField('PropCrash-DateCalc'),
                    new StringField('PropTrans-DateCalc'),
                    new StringField('Brew Size (Gallons)'),
                    new StringField('Brew % of 7Bbl'),
                    new StringField('Sum - Potential Yield'),
                    new StringField('Potential OG'),
                    new StringField('Efficiency'),
                    new StringField('Ratings'),
                    new StringField('CurrentTank_Name'),
                    new DateField('Canned'),
                    new StringField('PendingActivities'),
                    new StringField('TempLogsCount'),
                    new StringField('Rating')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Batch', 'Batch', 'Batch_id', 'multi_edit_Brews_Batch_search', $editor, $this->dataset, $lookupDataset, 'Batch', 'id', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Brew ID field
            //
            $editor = new TextEdit('brew_id_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Brew ID', 'Brew ID', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Brew Date field
            //
            $editor = new DateTimeEdit('brew_date_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Brew Date', 'Brew Date', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Status field
            //
            $editor = new TextEdit('status_edit');
            $editor->SetMaxLength(64);
            $editColumn = new CustomEditColumn('Status', 'Status', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Mash Temp field
            //
            $editor = new TextEdit('mash_temp_edit');
            $editColumn = new CustomEditColumn('Mash Temp', 'Mash Temp', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Lactic Acid field
            //
            $editor = new TextEdit('lactic_acid_edit');
            $editColumn = new CustomEditColumn('Lactic Acid', 'Lactic Acid', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Preboil Grav field
            //
            $editor = new TextEdit('preboil_grav_edit');
            $editColumn = new CustomEditColumn('Preboil Grav', 'Preboil Grav', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for OG field
            //
            $editor = new TextEdit('og_edit');
            $editColumn = new CustomEditColumn('OG', 'OG', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for pH-Mash field
            //
            $editor = new TextEdit('ph-mash_edit');
            $editColumn = new CustomEditColumn('PH-Mash', 'pH-Mash', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for pH-First field
            //
            $editor = new TextEdit('ph-first_edit');
            $editColumn = new CustomEditColumn('PH-First', 'pH-First', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for pH-Last field
            //
            $editor = new TextEdit('ph-last_edit');
            $editColumn = new CustomEditColumn('PH-Last', 'pH-Last', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for pH-Pre boil field
            //
            $editor = new TextEdit('ph-pre_boil_edit');
            $editColumn = new CustomEditColumn('PH-Pre Boil', 'pH-Pre boil', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for pH-KO field
            //
            $editor = new TextEdit('ph-ko_edit');
            $editColumn = new CustomEditColumn('PH-KO', 'pH-KO', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for O2 Setting field
            //
            $editor = new TextEdit('o2_setting_edit');
            $editor->SetMaxLength(64);
            $editColumn = new CustomEditColumn('O2 Setting', 'O2 Setting', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for DO-Line field
            //
            $editor = new TextEdit('do-line_edit');
            $editColumn = new CustomEditColumn('DO-Line', 'DO-Line', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for DO-Tank field
            //
            $editor = new TextEdit('do-tank_edit');
            $editColumn = new CustomEditColumn('DO-Tank', 'DO-Tank', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Notes field
            //
            $editor = new TextAreaEdit('notes_edit', 50, 8);
            $editColumn = new CustomEditColumn('Notes', 'Notes', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for User field
            //
            $editor = new TextEdit('user_edit');
            $editor->SetMaxLength(64);
            $editColumn = new CustomEditColumn('User', 'User', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Bbls field
            //
            $editor = new TextEdit('bbls_edit');
            $editColumn = new CustomEditColumn('Bbls', 'Bbls', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddToggleEditColumns(Grid $grid)
        {
    
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for updated field
            //
            $editor = new DateTimeEdit('updated_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Updated', 'updated', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Batch field
            //
            $editor = new DynamicCombobox('batch_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`Batches`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new DateTimeField('updated', true),
                    new IntegerField('BatchID', true),
                    new StringField('Template', true),
                    new StringField('Batch', true, true),
                    new DateField('Brew Date'),
                    new IntegerField('Ingredient_Cnt'),
                    new IntegerField('Brews-Records'),
                    new StringField('Brews Blended from this Batch'),
                    new StringField('Brews Blended into this Batch'),
                    new IntegerField('Brews'),
                    new IntegerField('Total Brews Calc 1'),
                    new IntegerField('Total Brews Calc 2'),
                    new DateField('Brew Date Start Calc 1'),
                    new DateField('Brew Date End Calc 1'),
                    new DateField('Brew Date Start Calc 2'),
                    new DateField('Brew Date End Calc 2'),
                    new DateField('Brew Date Start'),
                    new DateField('Brew Date End'),
                    new IntegerField('Brew Days'),
                    new IntegerField('Total Brews (Net)'),
                    new StringField('ProPitch'),
                    new StringField('Yeast'),
                    new StringField('Yeast Source'),
                    new StringField('Yeast from FV'),
                    new StringField('Nickname'),
                    new StringField('Status'),
                    new StringField('Batch-Status'),
                    new StringField('Days Running 1'),
                    new StringField('Days Running 2'),
                    new StringField('Style'),
                    new StringField('FV'),
                    new StringField('FV Tank'),
                    new StringField('BT'),
                    new StringField('BT Tank'),
                    new StringField('Current Tank'),
                    new StringField('Bbls'),
                    new StringField('Color'),
                    new StringField('IBU'),
                    new StringField('OG-A'),
                    new StringField('OG-B'),
                    new StringField('OG-C'),
                    new StringField('OG-D'),
                    new StringField('OG-AB'),
                    new StringField('OG-ABC'),
                    new StringField('OG-ABCD'),
                    new StringField('OG'),
                    new StringField('FG_Min'),
                    new StringField('Current Gravity'),
                    new StringField('FG'),
                    new StringField('ABV'),
                    new StringField('Attenuation'),
                    new StringField('Yeast Pitch'),
                    new StringField('Blend Ratio'),
                    new StringField('Notes'),
                    new StringField('Status2'),
                    new StringField('Dry Hop Date'),
                    new StringField('Dry Hop Date Formula'),
                    new StringField('Crash Date'),
                    new StringField('Brite Tank Date'),
                    new StringField('Gone Date'),
                    new StringField('Dry Hop Days'),
                    new StringField('Total Days'),
                    new StringField('Dry Hopped Running'),
                    new StringField('User'),
                    new StringField('Maximum CO2'),
                    new StringField('CO2 Volumes'),
                    new StringField('This Batch Blended into Batch'),
                    new StringField('Batches Blended into this Batch'),
                    new StringField('Calculated Days'),
                    new StringField('Blended'),
                    new StringField('TankLog Count'),
                    new StringField('KegLog Count'),
                    new StringField('Kegs Count'),
                    new StringField('PackageLog Count'),
                    new StringField('KegOrders Count'),
                    new StringField('Net Bbls'),
                    new StringField('Canned & Kegged Barrels'),
                    new StringField('Canning Runs'),
                    new StringField('5G Kegs'),
                    new StringField('50L Kegs'),
                    new StringField('Brews-Bbls'),
                    new StringField('Brews-OG'),
                    new StringField('Net Beer Factor'),
                    new StringField('Batch Gross Bbls Calc'),
                    new StringField('Gross Bbls'),
                    new StringField('Remaining Bbls Calc'),
                    new StringField('Remaining Bbls (Est)'),
                    new StringField('Can Be Deleted'),
                    new StringField('Brews from Template'),
                    new StringField('FermStart-DateCalc'),
                    new StringField('FermStart-DateCalc2'),
                    new StringField('FermEnd-DateCalc'),
                    new StringField('FermEnd-DateCalc2'),
                    new StringField('Ferm-DateCalc'),
                    new StringField('Ferm-DateCalc2'),
                    new StringField('FermEnd-DateDayNumber'),
                    new StringField('DryHop-DateDayAdd'),
                    new StringField('Dryhop-DateCalc'),
                    new StringField('Dryhop-DateDayNumber'),
                    new StringField('Crash-DateDayAdd'),
                    new StringField('Crash-DateCalc'),
                    new StringField('Crash-DateDayNumber'),
                    new StringField('Transfer-DateDayAdd'),
                    new StringField('Transfer-DateCalc'),
                    new StringField('Transfer-DateDayNumber'),
                    new StringField('Package-DateDayAdd'),
                    new StringField('Package-DateCalc'),
                    new StringField('Scheduled Steps'),
                    new StringField('Steps Remaining'),
                    new StringField('PropCrash-DateCalc'),
                    new StringField('PropTrans-DateCalc'),
                    new StringField('Brew Size (Gallons)'),
                    new StringField('Brew % of 7Bbl'),
                    new StringField('Sum - Potential Yield'),
                    new StringField('Potential OG'),
                    new StringField('Efficiency'),
                    new StringField('Ratings'),
                    new StringField('CurrentTank_Name'),
                    new DateField('Canned'),
                    new StringField('PendingActivities'),
                    new StringField('TempLogsCount'),
                    new StringField('Rating')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Batch', 'Batch', 'Batch_id', 'insert_Brews_Batch_search', $editor, $this->dataset, $lookupDataset, 'Batch', 'id', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Brew ID field
            //
            $editor = new TextEdit('brew_id_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Brew ID', 'Brew ID', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Brew Date field
            //
            $editor = new DateTimeEdit('brew_date_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Brew Date', 'Brew Date', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Status field
            //
            $editor = new TextEdit('status_edit');
            $editor->SetMaxLength(64);
            $editColumn = new CustomEditColumn('Status', 'Status', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Mash Temp field
            //
            $editor = new TextEdit('mash_temp_edit');
            $editColumn = new CustomEditColumn('Mash Temp', 'Mash Temp', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Lactic Acid field
            //
            $editor = new TextEdit('lactic_acid_edit');
            $editColumn = new CustomEditColumn('Lactic Acid', 'Lactic Acid', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Preboil Grav field
            //
            $editor = new TextEdit('preboil_grav_edit');
            $editColumn = new CustomEditColumn('Preboil Grav', 'Preboil Grav', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for OG field
            //
            $editor = new TextEdit('og_edit');
            $editColumn = new CustomEditColumn('OG', 'OG', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for pH-Mash field
            //
            $editor = new TextEdit('ph-mash_edit');
            $editColumn = new CustomEditColumn('PH-Mash', 'pH-Mash', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for pH-First field
            //
            $editor = new TextEdit('ph-first_edit');
            $editColumn = new CustomEditColumn('PH-First', 'pH-First', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for pH-Last field
            //
            $editor = new TextEdit('ph-last_edit');
            $editColumn = new CustomEditColumn('PH-Last', 'pH-Last', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for pH-Pre boil field
            //
            $editor = new TextEdit('ph-pre_boil_edit');
            $editColumn = new CustomEditColumn('PH-Pre Boil', 'pH-Pre boil', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for pH-KO field
            //
            $editor = new TextEdit('ph-ko_edit');
            $editColumn = new CustomEditColumn('PH-KO', 'pH-KO', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for O2 Setting field
            //
            $editor = new TextEdit('o2_setting_edit');
            $editor->SetMaxLength(64);
            $editColumn = new CustomEditColumn('O2 Setting', 'O2 Setting', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for DO-Line field
            //
            $editor = new TextEdit('do-line_edit');
            $editColumn = new CustomEditColumn('DO-Line', 'DO-Line', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for DO-Tank field
            //
            $editor = new TextEdit('do-tank_edit');
            $editColumn = new CustomEditColumn('DO-Tank', 'DO-Tank', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Notes field
            //
            $editor = new TextAreaEdit('notes_edit', 50, 8);
            $editColumn = new CustomEditColumn('Notes', 'Notes', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for User field
            //
            $editor = new TextEdit('user_edit');
            $editor->SetMaxLength(64);
            $editColumn = new CustomEditColumn('User', 'User', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Bbls field
            //
            $editor = new TextEdit('bbls_edit');
            $editColumn = new CustomEditColumn('Bbls', 'Bbls', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            $grid->SetShowAddButton(true && $this->GetSecurityInfo()->HasAddGrant());
        }
    
        private function AddMultiUploadColumn(Grid $grid)
        {
    
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for updated field
            //
            $column = new DateTimeViewColumn('updated', 'updated', 'Updated', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for id field
            //
            $column = new NumberViewColumn('Batch', 'Batch_id', 'Batch', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Brew ID field
            //
            $column = new TextViewColumn('Brew ID', 'Brew ID', 'Brew ID', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Brew field
            //
            $column = new TextViewColumn('Brew', 'Brew', 'Brew', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Brew Date field
            //
            $column = new DateTimeViewColumn('Brew Date', 'Brew Date', 'Brew Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Status field
            //
            $column = new TextViewColumn('Status', 'Status', 'Status', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Mash Temp field
            //
            $column = new NumberViewColumn('Mash Temp', 'Mash Temp', 'Mash Temp', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Lactic Acid field
            //
            $column = new NumberViewColumn('Lactic Acid', 'Lactic Acid', 'Lactic Acid', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Preboil Grav field
            //
            $column = new NumberViewColumn('Preboil Grav', 'Preboil Grav', 'Preboil Grav', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for OG field
            //
            $column = new NumberViewColumn('OG', 'OG', 'OG', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for pH-Mash field
            //
            $column = new NumberViewColumn('pH-Mash', 'pH-Mash', 'PH-Mash', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for pH-First field
            //
            $column = new NumberViewColumn('pH-First', 'pH-First', 'PH-First', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for pH-Last field
            //
            $column = new NumberViewColumn('pH-Last', 'pH-Last', 'PH-Last', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for pH-Pre boil field
            //
            $column = new NumberViewColumn('pH-Pre boil', 'pH-Pre boil', 'PH-Pre Boil', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for pH-KO field
            //
            $column = new NumberViewColumn('pH-KO', 'pH-KO', 'PH-KO', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for O2 Setting field
            //
            $column = new TextViewColumn('O2 Setting', 'O2 Setting', 'O2 Setting', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for DO-Line field
            //
            $column = new NumberViewColumn('DO-Line', 'DO-Line', 'DO-Line', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for DO-Tank field
            //
            $column = new NumberViewColumn('DO-Tank', 'DO-Tank', 'DO-Tank', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Notes field
            //
            $column = new TextViewColumn('Notes', 'Notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for User field
            //
            $column = new TextViewColumn('User', 'User', 'User', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Bbls field
            //
            $column = new NumberViewColumn('Bbls', 'Bbls', 'Bbls', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for updated field
            //
            $column = new DateTimeViewColumn('updated', 'updated', 'Updated', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for id field
            //
            $column = new NumberViewColumn('Batch', 'Batch_id', 'Batch', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for Brew ID field
            //
            $column = new TextViewColumn('Brew ID', 'Brew ID', 'Brew ID', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Brew field
            //
            $column = new TextViewColumn('Brew', 'Brew', 'Brew', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for Brew Date field
            //
            $column = new DateTimeViewColumn('Brew Date', 'Brew Date', 'Brew Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddExportColumn($column);
            
            //
            // View column for Status field
            //
            $column = new TextViewColumn('Status', 'Status', 'Status', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Mash Temp field
            //
            $column = new NumberViewColumn('Mash Temp', 'Mash Temp', 'Mash Temp', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for Lactic Acid field
            //
            $column = new NumberViewColumn('Lactic Acid', 'Lactic Acid', 'Lactic Acid', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for Preboil Grav field
            //
            $column = new NumberViewColumn('Preboil Grav', 'Preboil Grav', 'Preboil Grav', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for OG field
            //
            $column = new NumberViewColumn('OG', 'OG', 'OG', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for pH-Mash field
            //
            $column = new NumberViewColumn('pH-Mash', 'pH-Mash', 'PH-Mash', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for pH-First field
            //
            $column = new NumberViewColumn('pH-First', 'pH-First', 'PH-First', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for pH-Last field
            //
            $column = new NumberViewColumn('pH-Last', 'pH-Last', 'PH-Last', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for pH-Pre boil field
            //
            $column = new NumberViewColumn('pH-Pre boil', 'pH-Pre boil', 'PH-Pre Boil', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for pH-KO field
            //
            $column = new NumberViewColumn('pH-KO', 'pH-KO', 'PH-KO', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for O2 Setting field
            //
            $column = new TextViewColumn('O2 Setting', 'O2 Setting', 'O2 Setting', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for DO-Line field
            //
            $column = new NumberViewColumn('DO-Line', 'DO-Line', 'DO-Line', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for DO-Tank field
            //
            $column = new NumberViewColumn('DO-Tank', 'DO-Tank', 'DO-Tank', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for Notes field
            //
            $column = new TextViewColumn('Notes', 'Notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for User field
            //
            $column = new TextViewColumn('User', 'User', 'User', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Bbls field
            //
            $column = new NumberViewColumn('Bbls', 'Bbls', 'Bbls', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for updated field
            //
            $column = new DateTimeViewColumn('updated', 'updated', 'Updated', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for id field
            //
            $column = new NumberViewColumn('Batch', 'Batch_id', 'Batch', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Brew ID field
            //
            $column = new TextViewColumn('Brew ID', 'Brew ID', 'Brew ID', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Brew Date field
            //
            $column = new DateTimeViewColumn('Brew Date', 'Brew Date', 'Brew Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Status field
            //
            $column = new TextViewColumn('Status', 'Status', 'Status', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Mash Temp field
            //
            $column = new NumberViewColumn('Mash Temp', 'Mash Temp', 'Mash Temp', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Lactic Acid field
            //
            $column = new NumberViewColumn('Lactic Acid', 'Lactic Acid', 'Lactic Acid', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Preboil Grav field
            //
            $column = new NumberViewColumn('Preboil Grav', 'Preboil Grav', 'Preboil Grav', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for OG field
            //
            $column = new NumberViewColumn('OG', 'OG', 'OG', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for pH-Mash field
            //
            $column = new NumberViewColumn('pH-Mash', 'pH-Mash', 'PH-Mash', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for pH-First field
            //
            $column = new NumberViewColumn('pH-First', 'pH-First', 'PH-First', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for pH-Last field
            //
            $column = new NumberViewColumn('pH-Last', 'pH-Last', 'PH-Last', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for pH-Pre boil field
            //
            $column = new NumberViewColumn('pH-Pre boil', 'pH-Pre boil', 'PH-Pre Boil', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for pH-KO field
            //
            $column = new NumberViewColumn('pH-KO', 'pH-KO', 'PH-KO', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for O2 Setting field
            //
            $column = new TextViewColumn('O2 Setting', 'O2 Setting', 'O2 Setting', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for DO-Line field
            //
            $column = new NumberViewColumn('DO-Line', 'DO-Line', 'DO-Line', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for DO-Tank field
            //
            $column = new NumberViewColumn('DO-Tank', 'DO-Tank', 'DO-Tank', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Notes field
            //
            $column = new TextViewColumn('Notes', 'Notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for User field
            //
            $column = new TextViewColumn('User', 'User', 'User', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Bbls field
            //
            $column = new NumberViewColumn('Bbls', 'Bbls', 'Bbls', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
        }
    
        private function AddCompareHeaderColumns(Grid $grid)
        {
    
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        public function isFilterConditionRequired()
        {
            return false;
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
    		$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        function CreateMasterDetailRecordGrid()
        {
            $result = new Grid($this, $this->dataset);
            
            $this->AddFieldColumns($result, false);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
            
            $result->SetAllowDeleteSelected(false);
            $result->SetShowUpdateLink(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(false);
            $result->setTableBordered(false);
            $result->setTableCondensed(false);
            
            $this->setupGridColumnGroup($result);
            $this->attachGridEventHandlers($result);
            
            return $result;
        }
        
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset);
            if ($this->GetSecurityInfo()->HasDeleteGrant())
               $result->SetAllowDeleteSelected(true);
            else
               $result->SetAllowDeleteSelected(false);   
            
            ApplyCommonPageSettings($this, $result);
            
            $result->SetUseImagesForActions(true);
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(true);
            $result->setAllowCompare(true);
            $this->AddCompareHeaderColumns($result);
            $this->AddCompareColumns($result);
            $result->setMultiEditAllowed($this->GetSecurityInfo()->HasEditGrant() && true);
            $result->setTableBordered(false);
            $result->setTableCondensed(false);
            
            $result->SetHighlightRowAtHover(false);
            $result->SetWidth('');
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddMultiEditColumns($result);
            $this->AddToggleEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
            $this->AddMultiUploadColumn($result);
    
    
            $this->SetShowPageList(true);
            $this->SetShowTopPageNavigator(true);
            $this->SetShowBottomPageNavigator(true);
            $this->setAllowedActions(array('view', 'insert', 'copy', 'edit', 'multi-edit', 'delete', 'multi-delete'));
            $this->setPrintListAvailable(true);
            $this->setPrintListRecordAvailable(false);
            $this->setPrintOneRecordAvailable(true);
            $this->setAllowPrintSelectedRecords(true);
            $this->setExportListAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportSelectedRecordsAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportListRecordAvailable(array());
            $this->setExportOneRecordAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
    
            return $result;
        }
     
        protected function setClientSideEvents(Grid $grid) {
    
        }
    
        protected function doRegisterHandlers() {
            $detailPage = new Brews_InventoryActivitiesPage('Brews_InventoryActivities', $this, array('Brew'), array('Brew'), $this->GetForeignKeyFields(), $this->CreateMasterDetailRecordGrid(), $this->dataset, GetCurrentUserPermissionsForPage('Brews.InventoryActivities'), 'UTF-8');
            $detailPage->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('Brews.InventoryActivities'));
            $detailPage->SetHttpHandlerName('Brews_InventoryActivities_handler');
            $handler = new PageHTTPHandler('Brews_InventoryActivities_handler', $detailPage);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`Batches`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new DateTimeField('updated', true),
                    new IntegerField('BatchID', true),
                    new StringField('Template', true),
                    new StringField('Batch', true, true),
                    new DateField('Brew Date'),
                    new IntegerField('Ingredient_Cnt'),
                    new IntegerField('Brews-Records'),
                    new StringField('Brews Blended from this Batch'),
                    new StringField('Brews Blended into this Batch'),
                    new IntegerField('Brews'),
                    new IntegerField('Total Brews Calc 1'),
                    new IntegerField('Total Brews Calc 2'),
                    new DateField('Brew Date Start Calc 1'),
                    new DateField('Brew Date End Calc 1'),
                    new DateField('Brew Date Start Calc 2'),
                    new DateField('Brew Date End Calc 2'),
                    new DateField('Brew Date Start'),
                    new DateField('Brew Date End'),
                    new IntegerField('Brew Days'),
                    new IntegerField('Total Brews (Net)'),
                    new StringField('ProPitch'),
                    new StringField('Yeast'),
                    new StringField('Yeast Source'),
                    new StringField('Yeast from FV'),
                    new StringField('Nickname'),
                    new StringField('Status'),
                    new StringField('Batch-Status'),
                    new StringField('Days Running 1'),
                    new StringField('Days Running 2'),
                    new StringField('Style'),
                    new StringField('FV'),
                    new StringField('FV Tank'),
                    new StringField('BT'),
                    new StringField('BT Tank'),
                    new StringField('Current Tank'),
                    new StringField('Bbls'),
                    new StringField('Color'),
                    new StringField('IBU'),
                    new StringField('OG-A'),
                    new StringField('OG-B'),
                    new StringField('OG-C'),
                    new StringField('OG-D'),
                    new StringField('OG-AB'),
                    new StringField('OG-ABC'),
                    new StringField('OG-ABCD'),
                    new StringField('OG'),
                    new StringField('FG_Min'),
                    new StringField('Current Gravity'),
                    new StringField('FG'),
                    new StringField('ABV'),
                    new StringField('Attenuation'),
                    new StringField('Yeast Pitch'),
                    new StringField('Blend Ratio'),
                    new StringField('Notes'),
                    new StringField('Status2'),
                    new StringField('Dry Hop Date'),
                    new StringField('Dry Hop Date Formula'),
                    new StringField('Crash Date'),
                    new StringField('Brite Tank Date'),
                    new StringField('Gone Date'),
                    new StringField('Dry Hop Days'),
                    new StringField('Total Days'),
                    new StringField('Dry Hopped Running'),
                    new StringField('User'),
                    new StringField('Maximum CO2'),
                    new StringField('CO2 Volumes'),
                    new StringField('This Batch Blended into Batch'),
                    new StringField('Batches Blended into this Batch'),
                    new StringField('Calculated Days'),
                    new StringField('Blended'),
                    new StringField('TankLog Count'),
                    new StringField('KegLog Count'),
                    new StringField('Kegs Count'),
                    new StringField('PackageLog Count'),
                    new StringField('KegOrders Count'),
                    new StringField('Net Bbls'),
                    new StringField('Canned & Kegged Barrels'),
                    new StringField('Canning Runs'),
                    new StringField('5G Kegs'),
                    new StringField('50L Kegs'),
                    new StringField('Brews-Bbls'),
                    new StringField('Brews-OG'),
                    new StringField('Net Beer Factor'),
                    new StringField('Batch Gross Bbls Calc'),
                    new StringField('Gross Bbls'),
                    new StringField('Remaining Bbls Calc'),
                    new StringField('Remaining Bbls (Est)'),
                    new StringField('Can Be Deleted'),
                    new StringField('Brews from Template'),
                    new StringField('FermStart-DateCalc'),
                    new StringField('FermStart-DateCalc2'),
                    new StringField('FermEnd-DateCalc'),
                    new StringField('FermEnd-DateCalc2'),
                    new StringField('Ferm-DateCalc'),
                    new StringField('Ferm-DateCalc2'),
                    new StringField('FermEnd-DateDayNumber'),
                    new StringField('DryHop-DateDayAdd'),
                    new StringField('Dryhop-DateCalc'),
                    new StringField('Dryhop-DateDayNumber'),
                    new StringField('Crash-DateDayAdd'),
                    new StringField('Crash-DateCalc'),
                    new StringField('Crash-DateDayNumber'),
                    new StringField('Transfer-DateDayAdd'),
                    new StringField('Transfer-DateCalc'),
                    new StringField('Transfer-DateDayNumber'),
                    new StringField('Package-DateDayAdd'),
                    new StringField('Package-DateCalc'),
                    new StringField('Scheduled Steps'),
                    new StringField('Steps Remaining'),
                    new StringField('PropCrash-DateCalc'),
                    new StringField('PropTrans-DateCalc'),
                    new StringField('Brew Size (Gallons)'),
                    new StringField('Brew % of 7Bbl'),
                    new StringField('Sum - Potential Yield'),
                    new StringField('Potential OG'),
                    new StringField('Efficiency'),
                    new StringField('Ratings'),
                    new StringField('CurrentTank_Name'),
                    new DateField('Canned'),
                    new StringField('PendingActivities'),
                    new StringField('TempLogsCount'),
                    new StringField('Rating')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_Brews_Batch_search', 'Batch', 'id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`Batches`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new DateTimeField('updated', true),
                    new IntegerField('BatchID', true),
                    new StringField('Template', true),
                    new StringField('Batch', true, true),
                    new DateField('Brew Date'),
                    new IntegerField('Ingredient_Cnt'),
                    new IntegerField('Brews-Records'),
                    new StringField('Brews Blended from this Batch'),
                    new StringField('Brews Blended into this Batch'),
                    new IntegerField('Brews'),
                    new IntegerField('Total Brews Calc 1'),
                    new IntegerField('Total Brews Calc 2'),
                    new DateField('Brew Date Start Calc 1'),
                    new DateField('Brew Date End Calc 1'),
                    new DateField('Brew Date Start Calc 2'),
                    new DateField('Brew Date End Calc 2'),
                    new DateField('Brew Date Start'),
                    new DateField('Brew Date End'),
                    new IntegerField('Brew Days'),
                    new IntegerField('Total Brews (Net)'),
                    new StringField('ProPitch'),
                    new StringField('Yeast'),
                    new StringField('Yeast Source'),
                    new StringField('Yeast from FV'),
                    new StringField('Nickname'),
                    new StringField('Status'),
                    new StringField('Batch-Status'),
                    new StringField('Days Running 1'),
                    new StringField('Days Running 2'),
                    new StringField('Style'),
                    new StringField('FV'),
                    new StringField('FV Tank'),
                    new StringField('BT'),
                    new StringField('BT Tank'),
                    new StringField('Current Tank'),
                    new StringField('Bbls'),
                    new StringField('Color'),
                    new StringField('IBU'),
                    new StringField('OG-A'),
                    new StringField('OG-B'),
                    new StringField('OG-C'),
                    new StringField('OG-D'),
                    new StringField('OG-AB'),
                    new StringField('OG-ABC'),
                    new StringField('OG-ABCD'),
                    new StringField('OG'),
                    new StringField('FG_Min'),
                    new StringField('Current Gravity'),
                    new StringField('FG'),
                    new StringField('ABV'),
                    new StringField('Attenuation'),
                    new StringField('Yeast Pitch'),
                    new StringField('Blend Ratio'),
                    new StringField('Notes'),
                    new StringField('Status2'),
                    new StringField('Dry Hop Date'),
                    new StringField('Dry Hop Date Formula'),
                    new StringField('Crash Date'),
                    new StringField('Brite Tank Date'),
                    new StringField('Gone Date'),
                    new StringField('Dry Hop Days'),
                    new StringField('Total Days'),
                    new StringField('Dry Hopped Running'),
                    new StringField('User'),
                    new StringField('Maximum CO2'),
                    new StringField('CO2 Volumes'),
                    new StringField('This Batch Blended into Batch'),
                    new StringField('Batches Blended into this Batch'),
                    new StringField('Calculated Days'),
                    new StringField('Blended'),
                    new StringField('TankLog Count'),
                    new StringField('KegLog Count'),
                    new StringField('Kegs Count'),
                    new StringField('PackageLog Count'),
                    new StringField('KegOrders Count'),
                    new StringField('Net Bbls'),
                    new StringField('Canned & Kegged Barrels'),
                    new StringField('Canning Runs'),
                    new StringField('5G Kegs'),
                    new StringField('50L Kegs'),
                    new StringField('Brews-Bbls'),
                    new StringField('Brews-OG'),
                    new StringField('Net Beer Factor'),
                    new StringField('Batch Gross Bbls Calc'),
                    new StringField('Gross Bbls'),
                    new StringField('Remaining Bbls Calc'),
                    new StringField('Remaining Bbls (Est)'),
                    new StringField('Can Be Deleted'),
                    new StringField('Brews from Template'),
                    new StringField('FermStart-DateCalc'),
                    new StringField('FermStart-DateCalc2'),
                    new StringField('FermEnd-DateCalc'),
                    new StringField('FermEnd-DateCalc2'),
                    new StringField('Ferm-DateCalc'),
                    new StringField('Ferm-DateCalc2'),
                    new StringField('FermEnd-DateDayNumber'),
                    new StringField('DryHop-DateDayAdd'),
                    new StringField('Dryhop-DateCalc'),
                    new StringField('Dryhop-DateDayNumber'),
                    new StringField('Crash-DateDayAdd'),
                    new StringField('Crash-DateCalc'),
                    new StringField('Crash-DateDayNumber'),
                    new StringField('Transfer-DateDayAdd'),
                    new StringField('Transfer-DateCalc'),
                    new StringField('Transfer-DateDayNumber'),
                    new StringField('Package-DateDayAdd'),
                    new StringField('Package-DateCalc'),
                    new StringField('Scheduled Steps'),
                    new StringField('Steps Remaining'),
                    new StringField('PropCrash-DateCalc'),
                    new StringField('PropTrans-DateCalc'),
                    new StringField('Brew Size (Gallons)'),
                    new StringField('Brew % of 7Bbl'),
                    new StringField('Sum - Potential Yield'),
                    new StringField('Potential OG'),
                    new StringField('Efficiency'),
                    new StringField('Ratings'),
                    new StringField('CurrentTank_Name'),
                    new DateField('Canned'),
                    new StringField('PendingActivities'),
                    new StringField('TempLogsCount'),
                    new StringField('Rating')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_Brews_Batch_search', 'Batch', 'id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`Batches`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new DateTimeField('updated', true),
                    new IntegerField('BatchID', true),
                    new StringField('Template', true),
                    new StringField('Batch', true, true),
                    new DateField('Brew Date'),
                    new IntegerField('Ingredient_Cnt'),
                    new IntegerField('Brews-Records'),
                    new StringField('Brews Blended from this Batch'),
                    new StringField('Brews Blended into this Batch'),
                    new IntegerField('Brews'),
                    new IntegerField('Total Brews Calc 1'),
                    new IntegerField('Total Brews Calc 2'),
                    new DateField('Brew Date Start Calc 1'),
                    new DateField('Brew Date End Calc 1'),
                    new DateField('Brew Date Start Calc 2'),
                    new DateField('Brew Date End Calc 2'),
                    new DateField('Brew Date Start'),
                    new DateField('Brew Date End'),
                    new IntegerField('Brew Days'),
                    new IntegerField('Total Brews (Net)'),
                    new StringField('ProPitch'),
                    new StringField('Yeast'),
                    new StringField('Yeast Source'),
                    new StringField('Yeast from FV'),
                    new StringField('Nickname'),
                    new StringField('Status'),
                    new StringField('Batch-Status'),
                    new StringField('Days Running 1'),
                    new StringField('Days Running 2'),
                    new StringField('Style'),
                    new StringField('FV'),
                    new StringField('FV Tank'),
                    new StringField('BT'),
                    new StringField('BT Tank'),
                    new StringField('Current Tank'),
                    new StringField('Bbls'),
                    new StringField('Color'),
                    new StringField('IBU'),
                    new StringField('OG-A'),
                    new StringField('OG-B'),
                    new StringField('OG-C'),
                    new StringField('OG-D'),
                    new StringField('OG-AB'),
                    new StringField('OG-ABC'),
                    new StringField('OG-ABCD'),
                    new StringField('OG'),
                    new StringField('FG_Min'),
                    new StringField('Current Gravity'),
                    new StringField('FG'),
                    new StringField('ABV'),
                    new StringField('Attenuation'),
                    new StringField('Yeast Pitch'),
                    new StringField('Blend Ratio'),
                    new StringField('Notes'),
                    new StringField('Status2'),
                    new StringField('Dry Hop Date'),
                    new StringField('Dry Hop Date Formula'),
                    new StringField('Crash Date'),
                    new StringField('Brite Tank Date'),
                    new StringField('Gone Date'),
                    new StringField('Dry Hop Days'),
                    new StringField('Total Days'),
                    new StringField('Dry Hopped Running'),
                    new StringField('User'),
                    new StringField('Maximum CO2'),
                    new StringField('CO2 Volumes'),
                    new StringField('This Batch Blended into Batch'),
                    new StringField('Batches Blended into this Batch'),
                    new StringField('Calculated Days'),
                    new StringField('Blended'),
                    new StringField('TankLog Count'),
                    new StringField('KegLog Count'),
                    new StringField('Kegs Count'),
                    new StringField('PackageLog Count'),
                    new StringField('KegOrders Count'),
                    new StringField('Net Bbls'),
                    new StringField('Canned & Kegged Barrels'),
                    new StringField('Canning Runs'),
                    new StringField('5G Kegs'),
                    new StringField('50L Kegs'),
                    new StringField('Brews-Bbls'),
                    new StringField('Brews-OG'),
                    new StringField('Net Beer Factor'),
                    new StringField('Batch Gross Bbls Calc'),
                    new StringField('Gross Bbls'),
                    new StringField('Remaining Bbls Calc'),
                    new StringField('Remaining Bbls (Est)'),
                    new StringField('Can Be Deleted'),
                    new StringField('Brews from Template'),
                    new StringField('FermStart-DateCalc'),
                    new StringField('FermStart-DateCalc2'),
                    new StringField('FermEnd-DateCalc'),
                    new StringField('FermEnd-DateCalc2'),
                    new StringField('Ferm-DateCalc'),
                    new StringField('Ferm-DateCalc2'),
                    new StringField('FermEnd-DateDayNumber'),
                    new StringField('DryHop-DateDayAdd'),
                    new StringField('Dryhop-DateCalc'),
                    new StringField('Dryhop-DateDayNumber'),
                    new StringField('Crash-DateDayAdd'),
                    new StringField('Crash-DateCalc'),
                    new StringField('Crash-DateDayNumber'),
                    new StringField('Transfer-DateDayAdd'),
                    new StringField('Transfer-DateCalc'),
                    new StringField('Transfer-DateDayNumber'),
                    new StringField('Package-DateDayAdd'),
                    new StringField('Package-DateCalc'),
                    new StringField('Scheduled Steps'),
                    new StringField('Steps Remaining'),
                    new StringField('PropCrash-DateCalc'),
                    new StringField('PropTrans-DateCalc'),
                    new StringField('Brew Size (Gallons)'),
                    new StringField('Brew % of 7Bbl'),
                    new StringField('Sum - Potential Yield'),
                    new StringField('Potential OG'),
                    new StringField('Efficiency'),
                    new StringField('Ratings'),
                    new StringField('CurrentTank_Name'),
                    new DateField('Canned'),
                    new StringField('PendingActivities'),
                    new StringField('TempLogsCount'),
                    new StringField('Rating')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_Brews_Batch_search', 'Batch', 'id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`Batches`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new DateTimeField('updated', true),
                    new IntegerField('BatchID', true),
                    new StringField('Template', true),
                    new StringField('Batch', true, true),
                    new DateField('Brew Date'),
                    new IntegerField('Ingredient_Cnt'),
                    new IntegerField('Brews-Records'),
                    new StringField('Brews Blended from this Batch'),
                    new StringField('Brews Blended into this Batch'),
                    new IntegerField('Brews'),
                    new IntegerField('Total Brews Calc 1'),
                    new IntegerField('Total Brews Calc 2'),
                    new DateField('Brew Date Start Calc 1'),
                    new DateField('Brew Date End Calc 1'),
                    new DateField('Brew Date Start Calc 2'),
                    new DateField('Brew Date End Calc 2'),
                    new DateField('Brew Date Start'),
                    new DateField('Brew Date End'),
                    new IntegerField('Brew Days'),
                    new IntegerField('Total Brews (Net)'),
                    new StringField('ProPitch'),
                    new StringField('Yeast'),
                    new StringField('Yeast Source'),
                    new StringField('Yeast from FV'),
                    new StringField('Nickname'),
                    new StringField('Status'),
                    new StringField('Batch-Status'),
                    new StringField('Days Running 1'),
                    new StringField('Days Running 2'),
                    new StringField('Style'),
                    new StringField('FV'),
                    new StringField('FV Tank'),
                    new StringField('BT'),
                    new StringField('BT Tank'),
                    new StringField('Current Tank'),
                    new StringField('Bbls'),
                    new StringField('Color'),
                    new StringField('IBU'),
                    new StringField('OG-A'),
                    new StringField('OG-B'),
                    new StringField('OG-C'),
                    new StringField('OG-D'),
                    new StringField('OG-AB'),
                    new StringField('OG-ABC'),
                    new StringField('OG-ABCD'),
                    new StringField('OG'),
                    new StringField('FG_Min'),
                    new StringField('Current Gravity'),
                    new StringField('FG'),
                    new StringField('ABV'),
                    new StringField('Attenuation'),
                    new StringField('Yeast Pitch'),
                    new StringField('Blend Ratio'),
                    new StringField('Notes'),
                    new StringField('Status2'),
                    new StringField('Dry Hop Date'),
                    new StringField('Dry Hop Date Formula'),
                    new StringField('Crash Date'),
                    new StringField('Brite Tank Date'),
                    new StringField('Gone Date'),
                    new StringField('Dry Hop Days'),
                    new StringField('Total Days'),
                    new StringField('Dry Hopped Running'),
                    new StringField('User'),
                    new StringField('Maximum CO2'),
                    new StringField('CO2 Volumes'),
                    new StringField('This Batch Blended into Batch'),
                    new StringField('Batches Blended into this Batch'),
                    new StringField('Calculated Days'),
                    new StringField('Blended'),
                    new StringField('TankLog Count'),
                    new StringField('KegLog Count'),
                    new StringField('Kegs Count'),
                    new StringField('PackageLog Count'),
                    new StringField('KegOrders Count'),
                    new StringField('Net Bbls'),
                    new StringField('Canned & Kegged Barrels'),
                    new StringField('Canning Runs'),
                    new StringField('5G Kegs'),
                    new StringField('50L Kegs'),
                    new StringField('Brews-Bbls'),
                    new StringField('Brews-OG'),
                    new StringField('Net Beer Factor'),
                    new StringField('Batch Gross Bbls Calc'),
                    new StringField('Gross Bbls'),
                    new StringField('Remaining Bbls Calc'),
                    new StringField('Remaining Bbls (Est)'),
                    new StringField('Can Be Deleted'),
                    new StringField('Brews from Template'),
                    new StringField('FermStart-DateCalc'),
                    new StringField('FermStart-DateCalc2'),
                    new StringField('FermEnd-DateCalc'),
                    new StringField('FermEnd-DateCalc2'),
                    new StringField('Ferm-DateCalc'),
                    new StringField('Ferm-DateCalc2'),
                    new StringField('FermEnd-DateDayNumber'),
                    new StringField('DryHop-DateDayAdd'),
                    new StringField('Dryhop-DateCalc'),
                    new StringField('Dryhop-DateDayNumber'),
                    new StringField('Crash-DateDayAdd'),
                    new StringField('Crash-DateCalc'),
                    new StringField('Crash-DateDayNumber'),
                    new StringField('Transfer-DateDayAdd'),
                    new StringField('Transfer-DateCalc'),
                    new StringField('Transfer-DateDayNumber'),
                    new StringField('Package-DateDayAdd'),
                    new StringField('Package-DateCalc'),
                    new StringField('Scheduled Steps'),
                    new StringField('Steps Remaining'),
                    new StringField('PropCrash-DateCalc'),
                    new StringField('PropTrans-DateCalc'),
                    new StringField('Brew Size (Gallons)'),
                    new StringField('Brew % of 7Bbl'),
                    new StringField('Sum - Potential Yield'),
                    new StringField('Potential OG'),
                    new StringField('Efficiency'),
                    new StringField('Ratings'),
                    new StringField('CurrentTank_Name'),
                    new DateField('Canned'),
                    new StringField('PendingActivities'),
                    new StringField('TempLogsCount'),
                    new StringField('Rating')
                )
            );
            $lookupDataset->setOrderByField('id', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_Brews_Batch_search', 'Batch', 'id', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
        }
       
        protected function doCustomRenderColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderPrintColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderExportColumn($exportType, $fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomDrawRow($rowData, &$cellFontColor, &$cellFontSize, &$cellBgColor, &$cellItalicAttr, &$cellBoldAttr)
        {
    
        }
    
        protected function doExtendedCustomDrawRow($rowData, &$rowCellStyles, &$rowStyles, &$rowClasses, &$cellClasses)
        {
    
        }
    
        protected function doCustomRenderTotal($totalValue, $aggregate, $columnName, &$customText, &$handled)
        {
    
        }
    
        protected function doCustomDefaultValues(&$values, &$handled) 
        {
    
        }
    
        protected function doCustomCompareColumn($columnName, $valueA, $valueB, &$result)
        {
    
        }
    
        protected function doBeforeInsertRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeUpdateRecord($page, $oldRowData, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeDeleteRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterInsertRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterUpdateRecord($page, $oldRowData, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterDeleteRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doCustomHTMLHeader($page, &$customHtmlHeaderText)
        { 
    
        }
    
        protected function doGetCustomTemplate($type, $part, $mode, &$result, &$params)
        {
    
        }
    
        protected function doGetCustomExportOptions(Page $page, $exportType, $rowData, &$options)
        {
    
        }
    
        protected function doFileUpload($fieldName, $rowData, &$result, &$accept, $originalFileName, $originalFileExtension, $fileSize, $tempFileName)
        {
    
        }
    
        protected function doPrepareChart(Chart $chart)
        {
    
        }
    
        protected function doPrepareColumnFilter(ColumnFilter $columnFilter)
        {
    
        }
    
        protected function doPrepareFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
    
        }
    
        protected function doGetSelectionFilters(FixedKeysArray $columns, &$result)
        {
    
        }
    
        protected function doGetCustomFormLayout($mode, FixedKeysArray $columns, FormLayout $layout)
        {
    
        }
    
        protected function doGetCustomColumnGroup(FixedKeysArray $columns, ViewColumnGroup $columnGroup)
        {
    
        }
    
        protected function doPageLoaded()
        {
    
        }
    
        protected function doCalculateFields($rowData, $fieldName, &$value)
        {
    
        }
    
        protected function doGetCustomRecordPermissions(Page $page, &$usingCondition, $rowData, &$allowEdit, &$allowDelete, &$mergeWithDefault, &$handled)
        {
    
        }
    
        protected function doAddEnvironmentVariables(Page $page, &$variables)
        {
    
        }
    
    }

    SetUpUserAuthorization();

    try
    {
        $Page = new BrewsPage("Brews", "Brews.php", GetCurrentUserPermissionsForPage("Brews"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("Brews"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
