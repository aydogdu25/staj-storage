<?php

use portalium\db\Migration;
use portalium\menu\models\Menu;
use portalium\site\Module as SiteModule;
use portalium\site\models\Form;

class m220227_125705_theme_setting extends Migration
{
    public function up()
    {
        $this->insert(SiteModule::$tablePrefix . 'setting', [
            'module' => 'theme',
            'name' => 'theme::menu_main',
            'label' => 'Main Menu',
            'value' => '1',
            'type' => Form::TYPE_DROPDOWNLIST,
            'config' => json_encode([
                'model' => [
                    'class' => 'portalium\menu\models\Menu', 
                    'map' => [
                        'key' => 'id_menu' ,
                        'value' => 'name'
                    ],
                    'where' => [
                        'type' => Menu::TYPE['web']
                    ]
                ]
            ])
        ]);

        $this->insert(SiteModule::$tablePrefix . 'setting', [
            'module' => 'theme',
            'name' => 'theme::menu_side',
            'label' => 'Side Menu',
            'value' => '2',
            'type' => Form::TYPE_DROPDOWNLIST,
            'config' => json_encode([
                'model' => [
                    'class' => 'portalium\menu\models\Menu', 
                    'map' => [
                        'key' => 'id_menu' ,
                        'value' => 'name'
                    ],
                    'where' => [
                        'type' => Menu::TYPE['web']
                    ]
                ]
            ])
        ]);

        // $this->insert(SiteModule::$tablePrefix . 'setting', [
        //     'module' => 'theme',
        //     'name' => 'theme::menu_mobile',
        //     'label' => 'Mobile Menu',
        //     'value' => '1',
        //     'type' => Form::TYPE_DROPDOWNLIST,
        //     'config' => json_encode([
        //         'model' => [
        //             'class' => 'portalium\menu\models\Menu', 
        //             'map' => [
        //                 'key' => 'id_menu' ,
        //                 'value' => 'name'
        //             ],
        //             'where' => [
        //                 'type' => Menu::TYPE['mobile']
        //             ]
        //         ]
        //     ])
        // ]);

        $this->insert(SiteModule::$tablePrefix . 'setting', [
            'module' => 'theme',
            'name' => 'theme::menu_side_desktop',
            'label' => 'Side Menu Default Status (Desktop)',
            'value' => '',
            'type' => Form::TYPE_RADIOLIST,
            'config' => json_encode(['' => 'Show', 'active' => 'Hide'])
        ]);

        $this->insert(SiteModule::$tablePrefix . 'setting', [
            'module' => 'theme',
            'name' => 'theme::menu_side_mobile',
            'label' => 'Side Menu Default Status (Mobile)',
            'value' => '',
            'type' => Form::TYPE_RADIOLIST,
            'config' => json_encode(['active' => 'Show', '' => 'Hide'])
        ]);
        
        $this->insert(SiteModule::$tablePrefix . 'setting', [
            'module' => 'theme',
            'name' => 'theme::menu_closed',
            'label' => 'Side Menu Closed Display Style',
            'value' => 'closed-icon-and-text',
            'type' => Form::TYPE_RADIOLIST,
            'config' => json_encode(['closed-only-icon' => 'Only Icon', 'closed-only-text' => 'Only Text', 'closed-icon-and-text' => 'Icon and Text'])
        ]);

        $this->insert(SiteModule::$tablePrefix . 'setting', [
            'module' => 'theme',
            'name' => 'theme::page_size',
            'label' => 'Default Page Size',
            'value' => '10',
            'type' => Form::TYPE_DROPDOWNLIST,
            'config' => json_encode(['10' => '10', '20' => '20', '50' => '50', '100' => '100']),
            'is_preference' => 1
        ]);
        
    }

    public function down()
    {
        $this->delete(SiteModule::$tablePrefix . 'setting', ['module' => 'menu']);
    }
}
