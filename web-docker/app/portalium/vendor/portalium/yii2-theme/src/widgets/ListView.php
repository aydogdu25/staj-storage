<?php

namespace portalium\theme\widgets;

use Yii;
use yii\helpers\ArrayHelper;

class ListView extends \portalium\widgets\ListView
{
    /**
     * @var array the configuration for the page sizer widget. By default, [[LinkPageSizer]] will be
     * used to render the page sizer. You can use a different widget class by configuring the "class" element.
     */
    public $pageSizer = [];

    public $paginationParams;
    public function init()
    {
        parent::init();

        $this->pager = [
            'class' => 'yii\bootstrap5\LinkPager',
            'options' => [
                'class' => 'pagination justify-content-end',
            ],
        ];

        $this->layout = "{items}<div class='panel-footer d-flex justify-content-between'>" . str_replace('{items}', '', $this->layout) . '</div>';
        if (strpos($this->layout, '{pagesizer}{pager}') !== false) {
            $this->layout = str_replace('{pagesizer}{pager}', '<div class="d-flex">{pagesizer}{pager}</div>', $this->layout);
        } else {
            $this->layout = str_replace('{pager}', '<div class="d-flex">{pager}</div>', $this->layout);
        }
    }

    /**
     * Renders a section of the specified name.
     * If the named section is not supported, false will be returned.
     * @param string $name the section name, e.g., `{summary}`, `{items}`.
     * @return string|bool the rendering result of the section, or false if the named section is not supported.
     */
    /* public function renderSection($name)
    {
        // $this->layout = "{items}<div class='panel-footer d-flex justify-content-between'>{summary}{pager}</div>";
        switch ($name) {
            case '{summary}':
                break;
                // return $this->renderSummary();
            case '{items}':
                return $this->renderItems();
            case '{pager}':
                return "<div class='panel-footer d-flex justify-content-between'>" . $this->renderSummary() . '<div class="d-flex">' . $this->renderPager() . $this->renderPagesizer() .  "</div></div>";
            case '{sorter}':
                return $this->renderSorter();
            case "{pagesizer}":
                return $this->renderPagesizer();
            default:
                return false;
        }
    } */

    /* public function renderPager()
    {
        $pager = parent::renderPager();

        if ($this->paginationParams && isset($this->paginationParams['urlParams'])) {
            $urlParams = $this->paginationParams['urlParams'];
            $anchorParams = [];

            foreach ((array) $urlParams as $key => $value) {
                if ($key === '#') {
                    $anchorParams[] = $value;
                } else {
                    $urlSeparator = (strpos($pager, '?') !== false) ? '&' : '?';
                    $pager = preg_replace('/href="([^"]*)"/', 'href="$1' . $urlSeparator . $key . '=' . $value . '"', $pager);
                }
            }

            if (!empty($anchorParams)) {
                $anchorParams = '#' . implode(',', $anchorParams);
                $pager = preg_replace('/href="([^"]*)"/', 'href="$1' . $anchorParams . '"', $pager);
            }
        }

        return $pager;
    } */

    /**
     * Renders the page sizer.
     * @return string the rendering result
     */
    /* public function renderPagesizer()
    {
        $pagination = $this->dataProvider->getPagination();
        if ($pagination === false || $this->dataProvider->getCount() <= 0) {
            return '';
        }

        $pageSizer = $this->pageSizer;
        $class = ArrayHelper::remove($pageSizer, 'class', LinkPageSizer::className());
        $pageSizer['pagination'] = $pagination;
        $pageSizer['view'] = $this->getView();

        return $class::widget($pageSizer);
    } */
}
