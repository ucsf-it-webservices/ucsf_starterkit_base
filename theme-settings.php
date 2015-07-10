<?php

function ucsf_starterkit_base_form_system_theme_settings_alter(&$form, $form_state) {

  if(theme_get_setting('show_mothership_settings') !== 1) {
    $form['theme_settings']['#access'] = FALSE;
    $form['favicon']['#access'] = FALSE;
    $form['mothership_info']['#access'] = FALSE;
    $form['development']['#access'] = FALSE;
    $form['js']['#access'] = FALSE;
    $form['css']['#access'] = FALSE;
    $form['classes']['#access'] = FALSE;
    $form['misc']['#access'] = FALSE;
    $form['mobile']['#access'] = FALSE;
  }

  $form['show_mothership_settings'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Show Mothership Settings'),
    '#description'   => t('All settings from the base theme Mothership are hidden by default. Enable this checkbox to have access to those options'),
    '#default_value' => theme_get_setting('show_mothership_settings'),
  );

  $form['ucsf_starterkit_base_colorscheme'] = array(
    '#type' => 'select',
    '#title' => t('Pick your colorscheme'),
    '#options' => array(
      'navy' => t('Navy'),
      'blue' => t('Blue'),
      // 'orange' => t('Orange'),
      // 'lime' => t('Lime'),
      'teal' => t('Teal'),
      'purple' => t('Purple'),
      // 'pink' => t('Pink'),
    ),
    '#default_value' => theme_get_setting('ucsf_starterkit_base_colorscheme'),
  );
}
