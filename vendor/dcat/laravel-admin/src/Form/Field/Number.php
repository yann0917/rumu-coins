<?php

namespace Dcat\Admin\Form\Field;

class Number extends Text
{
    protected static $js = [
        '@number-input',
    ];

    protected $default = 0;

    public function render()
    {
        $this->default($this->default);

        $this->script = <<<JS

$('{$this->getElementClassSelector()}:not(.initialized)')
    .addClass('initialized')
    .bootstrapNumber({
        upClass: 'success',
        downClass: 'primary',
        center: true
    });
JS;

        $this->prepend('')->defaultAttribute('style', 'width: 200px');

        return parent::render();
    }

    protected function prepareInputValue($value)
    {
        return (int) $value;
    }

    /**
     * Set min value of number field.
     *
     * @param int $value
     *
     * @return $this
     */
    public function min($value)
    {
        $this->attribute('min', $value);

        return $this;
    }

    /**
     * Set max value of number field.
     *
     * @param int $value
     *
     * @return $this
     */
    public function max($value)
    {
        $this->attribute('max', $value);

        return $this;
    }
}
