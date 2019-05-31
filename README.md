<h2>CRUDBOOSTER DEVELOPMENT</h2>
Do not use this master repository for production

## Table Of Index
1. [Installation](#installation)
1. [Quick Start](#quick-start)
1. [Basic Code Knowledge](#basic-code-knowledge)
1. **Type Available**
    1. [Text](#text)
    1. [Checkbox](#checkbox)
    1. [Password](#password)
    1. [Image](#image)
    1. [Text Area](#textarea)
    1. [Select](#select)
    1. [Custom](#custom)
    1. [Date](#date)
    1. [Date & Time](#date--time)
    1. [Email](#email)
    1. [Money](#money)
    1. [File Upload](#file-upload)
    1. [Hidden Input](#hidden-input)
    1. [Number](#number)
    1. [Radio Button](#radio-button)
    1. [WYSIWYG](#wysiwyg)
1. [Additional Basic Options](#additional-basic-options)
1. [Show Column To Specific Page](#show-column--input-to-specific-page)
1. [Buttons Display Control](#buttons-display-control)
1. [Additional View](#additional-view)
1. [Additional Index Head Buttons](#additional-index-head-buttons)
1. [Additional Table Grid Action Buttons](#additional-table-grid-action-buttons)
1. [Hide Buttons With Condition](#hide-buttons-with-condition)
1. [Command Artisan Available](#command-artisan-available)
1. [Module Helper Available](#module-helper-available)
1. [FCM Google Push Notification](#fcm-google-push-notification)

<h3>Installation</h3>
Make sure you have installed newest laravel

<code>composer require crocodicstudio/crudbooster=dev-master</code>

Then don't forget to run the crudbooster installation command :
 
<code>php artisan crudbooster:install</code>

<h3>Quick Start</h3> 
Whatever you want to use laravel artisan serve or xampp . 
I assume you can go to the default crudbooster path 
<code>/developer/login</code>

Little different? yep. For the first time, you need to make your 
some modules, menus, and users for your new backend.

Developer Area : <br/>
default path : <code>/developer/login</code><br/>
default user : developer<br/>
default pass : <code>You will get once the installation is finished</code><br/>

<strong>WARNING PLEASE DON'T FORGET TO CHANGE THE DEFAULT DEVELOPER CREDENTIAL AT 
<code>/config/crudbooster.php</code></strong>

1. Create your modules
1. Create your roles
1. Add new User

Now you can log out, and try the admin panel by visiting <code>/admin/login</code>

<quote>
You can always change the admin login at /config/crudbooster.php
</quote>

<h3>Basic Code Knowledge</h3>
In this new CRUDBooster, we use single scaffolding for index table and form. 
For example : 

```php
function cbInit() {
    $this->setTable("books");
    $this->setPageTitle("Book Data");
    
    $this->addText("Title");
}
```

As you can see we add column title it will show at index table, detail, add and edit form.

<h3>Types</h3>
These bellow are some types that you can use to make form input :
 
## Text
**Example**

```php
    $this->addText("Foo Bar");
    $this->addText("Foo bar","foo_bar","field_foobar");
```

Parameters available : <br/>

| Name              | Description       |
| ----------------- | ----------------- |
| $label            | The input label (Required)   |
| $name             | The input name (Optional)    |
| $field_to_save    | The field name if not same with the name (Optional) |

Additional Options available : <br/>

| Method            | Description       |
| ------------------ | ---------------- |
| <code>->maxLength(100);</code> | Set max length limit
| <code>->minLength(5);</code> | Set min length limit |
| <code>->strLimit(100);</code>| Set character limit |

Additional options example :
```php
    $this->addText("Foo Bar")->maxLength(100)->minLength(5);
```

## Checkbox
**Example**
```php
    $this->addCheckbox("Foo Bar");
    $this->addCheckbox("Foo Bar","foo_bar","foo_bar_field");
```

Parameters available : <br/>

| Name              | Description       |
| ----------------- | ----------------- |
| $label            | The input label (Required)   |
| $name             | The input name (Optional)    |
| $field_to_save    | The field name if not same with the name (Optional) |

Additional options available : 

| Method | Description |
| --- | --- |
| <code>->options($array);</code> | The options of check box |
| <code>->optionsFromTable($table, $key_field, $display_field, $SQLCondition = null);</code> | The options of check box with table source |

Additional options example : 
```php
    $this->addCheckbox("Foo bar")->options(["a"=>"Banana","b"=>"Melon"]);
    $this->addCheckbox("Foo bar")->optionsFromTable("fruits","id","name");
```

## Password
**Example**

```php
    $this->addPassword("Foo Bar");
    $this->addPassword("Foo bar","foo_bar","field_foobar");
```

Parameters available : <br/>

| Name              | Description       |
| ----------------- | ----------------- |
| $label            | The input label (Required)   |
| $name             | The input name (Optional)    |
| $field_to_save    | The field name if not same with the name (Optional) |


## Image
**Example**

```php
    $this->addImage("Foo Bar");
    $this->addImage("Foo bar","foo_bar","field_foobar");
```

Parameters available : <br/>

| Name              | Description       |
| ----------------- | ----------------- |
| $label            | The input label (Required)   |
| $name             | The input name (Optional)    |
| $field_to_save    | The field name if not same with the name (Optional) |

Additional options : 

| Name | Description |
| --- | --- |
| <code>->encrypt(true);</code> | To encrypt the file name set false or true |
| <code>->resize(150, 150);</code> | To resize the image param 1 for width, param 2 for height |

## TextArea
**Example**

```php
    $this->addTextArea("Foo Bar");
    $this->addTextArea("Foo bar","foo_bar","field_foobar");
```

Parameters available : <br/>

| Name              | Description       |
| ----------------- | ----------------- |
| $label            | The input label (Required)   |
| $name             | The input name (Optional)    |
| $field_to_save    | The field name if not same with the name (Optional) |

Additional options : 

| Name | Description |
| --- | --- |
| <code>->strLimit($length);</code>|Set column limit characters|

## Select
**Example**
```php
    $this->addSelect("Foo Bar");
    $this->addSelect("Foo Bar","foo_bar","foo_bar_field");
```

Parameters available : <br/>

| Name              | Description       |
| ----------------- | ----------------- |
| $label            | The input label (Required)   |
| $name             | The input name (Optional)    |
| $field_to_save    | The field name if not same with the name (Optional) |

Additional options available : 

| Method | Description |
| --- | --- |
| <code>->options($array);</code> | The options of select |
| <code>->optionsFromTable($table, $key_field, $display_field, $SQLCondition = null);</code> | The options of select with table source |
| <code>->foreignKey($parent_select_name);</code> | To enable sub select. The case example is for select a province, city and district|
| <code>->optionsFromQuery($query);</code>| To set the source options by your own DB Query. Should be 2 response field "key" and "label"|

Additional options example : 
```php
    $this->addSelect("Foo bar")->options(["a"=>"Banana","b"=>"Melon"]);
    $this->addSelect("Foo bar")->optionsFromTable("fruits","id","name");
    $this->addSelect("Foo Bar")->optionsFromQuery(function() {
        return DB::table("foo")->select("id as key","name as label")->get();
    });
```

## Custom
**Example**

```php
    $this->addCustom("Foo Bar");
    $this->addCustom("Foo bar","foo_bar","field_foobar");
```

Parameters available : <br/>

| Name              | Description       |
| ----------------- | ----------------- |
| $label            | The input label (Required)   |
| $name             | The input name (Optional)    |
| $field_to_save    | The field name if not same with the name (Optional) |

## Date
**Example**

```php
    $this->addDate("Foo Bar");
    $this->addDate("Foo bar","foo_bar","field_foobar");
```

Parameters available : <br/>

| Name              | Description       |
| ----------------- | ----------------- |
| $label            | The input label (Required)   |
| $name             | The input name (Optional)    |
| $field_to_save    | The field name if not same with the name (Optional) |

Additional options available : 

| Name | Description |
| --- | --- |
| <code>->format("Y-m-d");</code> | The date php format |

Additional options example : 
```php
    $this->addDate("foo bar")->format("Y-m-d");
```

## Date & Time
**Example**

```php
    $this->addDateTime("Foo Bar");
    $this->addDateTime("Foo bar","foo_bar","field_foobar");
```

Parameters available : <br/>

| Name              | Description       |
| ----------------- | ----------------- |
| $label            | The input label (Required)   |
| $name             | The input name (Optional)    |
| $field_to_save    | The field name if not same with the name (Optional) |

Additional options available : 

| Name | Description | 
| --- | --- |
| <code>->format("Y-m-d H:i:s");</code> | The date time php format |

Additional options example : 
```php
    $this->addDateTime("Foo bar")->format("Y-m-d H:i:s");
```

## Email
**Example**

```php
    $this->addEmail("Foo Bar");
    $this->addEmail("Foo bar","foo_bar","field_foobar");
```

Parameters available : <br/>

| Name              | Description       |
| ----------------- | ----------------- |
| $label            | The input label (Required)   |
| $name             | The input name (Optional)    |
| $field_to_save    | The field name if not same with the name (Optional) |


## Money
**Example**

```php
    $this->addMoney("Foo Bar");
    $this->addMoney("Foo bar","foo_bar","field_foobar");
```

Parameters available : <br/>

| Name              | Description       |
| ----------------- | ----------------- |
| $label            | The input label (Required)   |
| $name             | The input name (Optional)    |
| $field_to_save    | The field name if not same with the name (Optional) |

Additional options : 

| Name | Description |
| --- | --- |
| <code>->prefix("Rp.");</code>| The prefix of money display |
| <code>->precision(2);</code> | The precision of money input |
| <code>->decimalSeparator(".");</code> | The decimal separator of money input |
| <code>->thousandSeparator(",");</code> | The thousand separator of money input |

Additional option example : 
```php
    $this->addMoney("Price")->prefix("Rp.")->precision(2);
```

## File Upload
**Example**

```php
    $this->addFile("Foo Bar");
    $this->addFile("Foo bar","foo_bar","field_foobar");
```

Parameters available : <br/>

| Name              | Description       |
| ----------------- | ----------------- |
| $label            | The input label (Required)   |
| $name             | The input name (Optional)    |
| $field_to_save    | The field name if not same with the name (Optional) |

## Hidden Input
**Example**

```php
    $this->addHidden("Foo Bar");
    $this->addHidden("Foo bar","foo_bar","field_foobar");
```

Parameters available : <br/>

| Name              | Description       |
| ----------------- | ----------------- |
| $label            | The input label (Required)   |
| $name             | The input name (Optional)    |
| $field_to_save    | The field name if not same with the name (Optional) |

## Number
**Example**

```php
    $this->addNumber("Foo Bar");
    $this->addNumber("Foo bar","foo_bar","field_foobar");
```

Parameters available : <br/>

| Name              | Description       |
| ----------------- | ----------------- |
| $label            | The input label (Required)   |
| $name             | The input name (Optional)    |
| $field_to_save    | The field name if not same with the name (Optional) |


## Radio Button
**Example**

```php
    $this->addRadio("Foo Bar");
    $this->addRadio("Foo bar","foo_bar","field_foobar");
```

Parameters available : <br/>

| Name              | Description       |
| ----------------- | ----------------- |
| $label            | The input label (Required)   |
| $name             | The input name (Optional)    |
| $field_to_save    | The field name if not same with the name (Optional) |

Additional options available : 

| Method | Description |
| --- | --- |
| <code>->options($array);</code> | The options of radio |
| <code>->optionsFromTable($table, $key_field, $display_field, $SQLCondition = null);</code> | The options of radio with table source |
| <code>->optionsFromQuery($query);</code>| To set the source options by your own DB Query. Should be 2 response field "key" and "label"|

Additional options example : 
```php
    $this->addSelect("Foo bar")->options(["a"=>"Banana","b"=>"Melon"]);
    $this->addSelect("Foo bar")->optionsFromTable("fruits","id","name");
    $this->addSelect("Foo Bar")->optionsFromQuery(function() {
        return DB::table("foo")->select("id as key","name as label")->get();
    });
```

## Wysiwyg
**Example**

```php
    $this->addWysiwyg("Foo Bar");
    $this->addWysiwyg("Foo bar","foo_bar","field_foobar");
```

Parameters available : <br/>

| Name              | Description       |
| ----------------- | ----------------- |
| $label            | The input label (Required)   |
| $name             | The input name (Optional)    |
| $field_to_save    | The field name if not same with the name (Optional) |

Additional options : 

| Name | Description |
| --- | --- |
| <code>->strLimit($length);</code>|Set column limit characters|

# Additional Basic Options
| Name | Description |
| --- | --- |
| <code>->visible($boolean);</code> | To set input visible false or true |
| <code>->defaultValue($value);</code> | To set the default value |
| <code>->inputWidth(12);</code> | To set width of input |
| <code>->columnWidth(100);</code> | To set width of table column |
| <code>->required(true);</code> | To set the mandatory of input | 
| <code>->help("Help text");</code> | To set help text in the bellow of input | 
| <code>->placeholder("Enter the text");</code> | To set the input placeholder |
| <code>->validation("string");</code> | To set the input validation (laravel validation) |

**Example**
```php
    $this->addText("Foo Bar")
            ->inputWidth(6)
            ->columnWidth(150)
            ->help("Enter the foo bar")
            ->validation("required|string");
```

# Show column / input to specific page
You can prevent input or column to show only at index table.
```php
    $this->addText("Foo Bar")->showIndex(true)->showEdit(false)->showAdd(false)->showDetail(false);
```

# Buttons Display Control
In this section you can disable / hide buttons in crudbooster

| Name | Description |
| --- | --- |
| <code>$this->setSearchForm(true);</code> | To show/hide search form |
| <code>$this->setButtonLimitPage(true);</code> | To show/hide limit button |
| <code>$this->setButtonSave(true);</code> | To show/hide save button |
| <code>$this->setButtonAdd(true);</code> | To show/hide add button |
| <code>$this->setButtonEdit(true);</code> | To show/hide edit button |
| <code>$this->setButtonDetail(true);</code> | To show/hide detail button |
| <code>$this->setButtonDelete(true);</code> | To show/hide delete button |
| <code>$this->setButtonCancel(true);</code> | To show/hide cancel button at form |
| <code>$this->setButtonAddMore(true);</code> | To show/hide add more button at form |

# Additional View
In this section you can add additional view or html on before or after CRUDBooster element

| Name | Description |
| --- | --- |
| <code>$this->setBeforeIndexTable("<div>html</div>");</code> | To set additional html before index table data | 
| <code>$this->setAfterIndexTable("<div>html</div>");</code> | To set additional html after index table data |  
| <code>$this->setBeforeDetailForm(function($row) { return "<div>html</div>"; });</code> | To set additional html before detail form. You can use $row to get current data | 
| <code>$this->setAfterDetailForm(function($row) { return "<div>html</div>"; });</code> | To set additional html after detail form. You can use $row to get current data |

# Additional Index Head Buttons
In this section you can add more buttons on the above of index table

```php
    $this->addIndexActionButton($label, $actionURL, $fontawesomeClass, $color, $attributes);
```

| Name | Description |
| --- | --- |
| <code>$label</code> | The button label |
| <code>$actionURL</code> | The button action url | 
| <code>$fontaweseomClass</code> | The button icon use font awesome class | 
| <code>$color</code> | The button color use ButtonColor::GREEN, ButtonColor::RED, ButtonColor::YELLOW, ButtonColor::LIGHT_BLUE, ButtonColor::DARK_BLUE |

Example : 

```php
    $this->addIndexActionButton("Export Data", module()->url('export-data'), 'fa fa-download', ButtonColor::GREEN);
```

# Additional Table Grid Action Buttons
In this section you can add more buttons on the table grid data
```php
    $this->addActionButton($label, $actionURL,  $condition, $fontAwesome, $color, $confirmation);
```

| Name | Description | 
| --- | --- |
| <code>$label</code> | The button label | 
| <code>$actionURL</code> | The button action url. You can set as callable with <code>$row</code> parameter | 
| <code>$condition</code> | The button show condition, this type is callable with <code>$row</code> parameter | 
| <code>$fontawesome</code> | The button icon, you can use font awesome class | 
| <code>$color</code> | The button color, you can use ButtonColor::RED(YELLOW,LIGHT_BLUE,GREEN) |

```php
    $this->addActionButton("Download Invoice", function($row) {
        return module()->url("download-invoice/".$row->primary_key);
    },function($row) {
        if($row->status == "PAID") return true;
        else return false;
    }, "fa fa-download");
```

In the example above you can use magic properties <code>->primary_key</code> to get the ID of record

# Hide Buttons With Condition
Some case you want to hide the detail button, edit button with specific condition.

```php
    $this->hideButtonDetailWhen(function($row) {
        //Write if condition here
    });
```

The output of this function should be a boolean. True to hide the button, False to show the button.

Example 

```php
    $this->hideButtonDeleteWhen(function($row) {
        if($row->status == "PAID") return true;
        else return false;
    });
```

Method available : 

| Name | Description | 
| --- | --- |
| hideButtonDeleteWhen($callback) | To hide delete button | 
| hideButtonEditWhen($callback) | To hide edit button |
| hideButtonDetailWhen($callback) | To hide detail button |

# Command Artisan Available

| Name | Description |
| --- | --- |
| crudbooster:make --module={tableName} | To create a module by table name. Replace {tableName} with the table name |
| crudbooster:install | To install the crudbooster for the first time |
| crudbooster:seed {--generate}| To backup the cb_* tables data and additional table see at the config/crudbooster.php. This useful if you doing collaboration that need sync the data also. Set option --generate to generating the seeder, or without it to seeder the exisiting seeder file. |

# Module Helper Available

| Name | Description |
| --- | --- |
| module()->getData("key_name") | To get the properties variable at the module controller. Replace key name with the properties var name.
| module()->getPageTitle() | To get the module page title |
| module()->getTable() | To get the table name of module |
| module()->getPageIcon() | To get the page icon of module |
| module()->canBrowse() | To check the current user is can browse to the module ? | 
| module()->canCreate() | To check the current user is can create to the module ? |
| module()->canRead() | To check the current user is can read to the module ? |
| module()->canUpdate() | To check the current user is can update to the module ? |
| module()->canDelete() | To check the current user is can delete to the module ? |
| module()->addUrl() | To get the add page url |
| module()->editUrl() | To get the edit page url |
| module()->detailUrl() | To get the detail page url |
| module()->deleteUrl() | To get the delete page url |
| module()->url("path/here") | To get the root module url. You can pass the parameter with additional path |
 
# FCM Google Push Notification 
To use this feature you have to set the Google FCM Key at <code>config/crudbooster.php</code>

```php
    use crocodicstudio\crudbooster\helpers\FCM;
    
    $fcm = new FCM();
    $title = "Foo Bar Title";
    $message = "The content notification message";
    $data = [];
    $data['foo_data'] = "Hello";
    $data['bar_data'] = "New";
    $fcm->sendToAndroid($reg_id_array, $title, $message, $data);
    
    // Or you can send to ios with this bellow 
    $fcm->sendToIos($reg_id_array, $title, $message,$data);
```