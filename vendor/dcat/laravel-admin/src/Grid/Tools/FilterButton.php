<?php

namespace Dcat\Admin\Grid\Tools;

use Dcat\Admin\Admin;
use Dcat\Admin\Grid\Filter;
use Illuminate\Support\Str;

class FilterButton extends AbstractTool
{
    /**
     * @var string
     */
    protected $view = 'admin::filter.button';

    /**
     * @var string
     */
    protected $btnClassName;

    /**
     * @return \Dcat\Admin\Grid\Filter
     */
    protected function filter()
    {
        return $this->parent->filter();
    }

    /**
     * Get button class name.
     *
     * @return string
     */
    protected function getElementClassName()
    {
        if (! $this->btnClassName) {
            $this->btnClassName = 'filter-btn-'.Str::random(8);
        }

        return $this->btnClassName;
    }

    /**
     * Set up script for filter button.
     */
    protected function setupScripts()
    {
        $filter = $this->filter();
        $id = $filter->filterID();

        if ($filter->mode() === Filter::MODE_RIGHT_SIDE) {
            $expand = $filter->expand ? 'true' : 'false';

            $script = <<<JS
(function () {
    var slider, 
        expand = {$expand};
    
     function initSlider() {
        slider = new Dcat.Slider({
            target: '#{$id}',
        });
        
        slider
            .\$container
            .find('.right-side-filter-container .header')
            .width(slider.\$container.width() - 20);
        
        expand && setTimeout(slider.open.bind(slider), 10);
    }
    
    expand && setTimeout(initSlider, 10);
    
    $('.{$this->getElementClassName()}').on('click', function () {
        if (! slider) {
            initSlider()
        }
        slider.toggle();
       
        return false
    });
    
    $('#{$id} .slider-close').on('click', function () {
        slider.close()
    })
})();
JS;
        } else {
            $script = <<<JS
$('.{$this->getElementClassName()}').on('click', function(){
    $('#{$id}').parent().collapse('toggle');
}); 
JS;
        }

        Admin::script($script);
    }

    /**
     * @return mixed
     */
    protected function renderScopes()
    {
        return $this->filter()->scopes()->map->render()->implode("\r\n");
    }

    /**
     * Get label of current scope.
     *
     * @return string
     */
    protected function currentScopeLabel()
    {
        if ($scope = $this->filter()->getCurrentScope()) {
            return "&nbsp;{$scope->getLabel()}&nbsp;";
        }

        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function render()
    {
        $filter = $this->filter();

        $scopres = $filter->scopes();
        $filters = $filter->filters();

        if ($scopres->isEmpty() && ! $filters) {
            return;
        }

        $this->setupScripts();

        $onlyScopes = ((! $filters || $this->parent->option('show_filter') === false) && ! $scopres->isEmpty()) ? true : false;

        $variables = [
            'scopes'           => $scopres,
            'current_label'    => $this->currentScopeLabel(),
            'url_no_scopes'    => $filter->urlWithoutScopes(),
            'btn_class'        => $this->getElementClassName(),
            'expand'           => $filter->expand,
            'show_filter_text' => true,
            'only_scopes'      => $onlyScopes,
        ];

        return view($this->view, $variables)->render();
    }
}
