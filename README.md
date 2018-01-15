# sfSummernotePlugin
Summernote rich text editor for symfony 1.4 framework

# Installation
First you need to place sfSummernotePlugin.zip file to /plugins folder and extract it.
Then you need to set the path of the summernote in an app.yml.
```
all:
  summernote:
    path:         'path/to/summernote/'
```
Recomended path is '/web/summernote/'.
Last thing, you must cut /summernote folder to this path.

# How to use
in xxxForm.class.php file:
```
$this->widgetSchema['my_editor'] = new sfWidgetFormSummerNote();
```
Or you can set configuration values:
```
$this->widgetSchema['my_editor'] = new sfWidgetFormSummerNote(array('sn_options'=>array('height' => 200, 'codeview' => true)));
```
See http://summernote.org/ for configuration instructions.

in template file, you must declare these two lines top of the page:
```
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
```

# Todos
- ...
- ...
