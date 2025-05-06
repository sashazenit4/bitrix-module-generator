<?php
namespace Sashazenit4\BitrixModuleGenerator\Services;

class TemplateGenerator {
    public function generateModule(array $options = [], array $params = []): void
    {
        $vars = [
            'MODULE_ID' => "'{$params['module_id']}'",
            'MODULE_CLASS_NAME' => str_replace('.', '_', $params['module_id']),
            'MODULE_SORT' => $params['module_sort'],
            'OPTIONS' => var_export($options, true),
            'VERSION_ID' => $params['version_id'],
            'VERSION_DATE' => $params['version_date'],
        ];

        $files = [
            'options.php' => $this->renderTemplate('options.php.template', $vars),
            'install/index.php' => $this->renderTemplate('install/index.php.template', $vars),
            'install/version.php' => $this->renderTemplate('install/version.php.template', $vars),
        ];

        foreach ($files as $path => $content) {
            file_put_contents(__DIR__  . "/../../files/{$params['module_id']}/{$path}", $content, );
        }
    }

    private function renderTemplate(string $name, array $options): string
    {
        $template = file_get_contents(__DIR__ . "/../templates/{$name}");
        $template = str_replace('{{$module_id}}', $options['MODULE_ID'], $template);
        $template = str_replace('{{$module_class_name}}', $options['MODULE_CLASS_NAME'], $template);
        $template = str_replace('{{$module_sort}}', $options['MODULE_SORT'], $template);
        $template = str_replace('{{$options}}', $options['OPTIONS'], $template);
        $template = str_replace("'{{GM(\'EMPTY_CONFIG_TITLE\')}}'", "Loc::getMessage('EMPTY_CONFIG_TITLE')", $template);
        $template = str_replace('{{$VERSION_ID}}', $options['VERSION_ID'], $template);
        $template = str_replace('{{$VERSION_DATE}}', $options['VERSION_DATE'], $template);
        $template = str_replace("'{{GM(\'MODULE_ID_MODULE_NAME\')}}'", "Loc::getMessage('MODULE_ID_MODULE_NAME')", $template);
        $template = str_replace("'{{GM(\'MODULE_ID_MODULE_DESCRIPTION\')}}'", "Loc::getMessage('MODULE_ID_MODULE_DESCRIPTION')", $template);
        $template = str_replace("'{{GM(\'MODULE_ID_PARTNER_NAME\')}}'", "Loc::getMessage('MODULE_ID_PARTNER_NAME')", $template);
        $template = str_replace("'{{GM(\'MODULE_ID_PARTNER_URI\')}}'", "Loc::getMessage('MODULE_ID_PARTNER_URI')", $template);
        $template = str_replace("'{{GM(\'MODULE_ID_INSTALL_MODULE_ERROR\')}}'", "Loc::getMessage('MODULE_ID_INSTALL_MODULE_ERROR')", $template);
        return $template === false ? '' : $template;
    }
}
