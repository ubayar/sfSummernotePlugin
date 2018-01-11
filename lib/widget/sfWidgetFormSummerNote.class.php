<?php

class sfWidgetFormSummerNote extends sfWidgetFormTextarea
{

  protected function configure($options = array(), $attributes = array())
  {
      $js = true;
      if ($js === false) {
          throw new sfConfigurationException(sprintf('Summernote javascript SDK not declared!'));
      }

      if (isset($options['sn_options'])) {
          $this->addOption('sn_options', $options['sn_options']);
      }
      parent::configure($options, $attributes);
  }

  public function getJavascripts()
  {
      return array(
          sfConfig::get('app_summernote_path') . 'summernote.min.js'
      );
  }

  public function getStylesheets()
  {
      return array(
          sfConfig::get('app_summernote_path') . "summernote.css" => "screen"
      );
  }

  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
      $jsReplacement = '';
      $jsReplacement .= '<script type="text/javascript">';
      $jsReplacement .= '$(document).ready(function() {';
      $jsReplacement .= '$("[name=\''.$name.'\']").summernote({';


      $jsOptions = $this->getOption('sn_options');
      if(is_array($jsOptions) && count($jsOptions)>0){
        foreach($jsOptions as $k=>$option){
            $jsReplacement .= $k.': '.$option.',';
        }
      }

      $toolbar = array();
      $toolbar['style'] = array('style');
      $toolbar['font'] = array('bold', 'italic', 'underline', 'clear');
      $toolbar['fontname'] = array('fontname');
      $toolbar['fontsize'] = array('fontsize');
      $toolbar['color'] = array('color');
      $toolbar['para'] = array('ul', 'ol', 'paragraph');
      $toolbar['height'] = array('height');
      $toolbar['table'] = array('table');
      $toolbar['insert'] = array('link', 'picture', 'video', 'hr');
      $toolbar['view'] = array('fullscreen');
      if(isset($jsOptions['codeview']) && $jsOptions['codeview'] == true){
        $toolbar['view'][] = 'codeview';
      }
      $toolbar['help'] = array('help');

      $jsReplacement .= '
          toolbar: [';

          foreach($toolbar as $k => $t){
            $attrs = array();
            foreach($t as $attr){
              $attrs[] = "'".$attr."'";
            }
            $jsReplacement .= "['".$k."', [".implode(', ', $attrs)."]],";
          }

      $jsReplacement .= ']
      });';
      $jsReplacement .= '});';
      $jsReplacement .= '</script>';

      return parent::render($name, $value, $attributes, $errors) . $jsReplacement;

  }
}
