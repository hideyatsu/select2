<?php namespace Hideyatsu\Select2;

/*
 * This file is inspired by Builder from Laravel ChartJS - Felix Costa
 */
class Builder
{
    /**
     * @var array
     */
    private $select2 = [];

    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $defaults = [
        'ajax'        => [],
        'data'        => [],
        'placeholder' => ''
    ];

    /**
     * @param string $name
     *
     * @return $this|Builder
     */
    public function name($name)
    {
        $this->name = $name;
        $this->select2[$name] = $this->defaults;
        return $this;
    }

    /**
     * @param string $element
     *
     * @return Builder
     */
    public function element($element)
    {
        return $this->set('element', $element);
    }

    /**
     * @param string $placeholder
     *
     * @return Builder
     */
    public function placeholder($placeholder)
    {
        return $this->set('placeholder', $placeholder);
    }

    /**
     * @param array $data
     *
     * @return Builder
     */
    public function data($data)
    {
        return $this->set('data', $data);
    }

    /**
     * @param array $ajax
     *
     * @return Builder
     */
    public function ajax($ajax)
    {
        return $this->set('ajax', $ajax);
    }

    /**
     * @param array $options
     *
     * @return $this|Builder
     */
    public function options(array $options)
    {
        foreach ($options as $key => $value) {
            $this->set('options.' . $key, $value);
        }
        return $this;
    }

    /**
     *
     * @param string|array $optionsRaw
     * @return \self
     */
    public function optionsRaw($optionsRaw)
    {
        if (is_array($optionsRaw)) {
            $this->set('optionsRaw', json_encode($optionsRaw, true));
            return $this;
        }
        $this->set('optionsRaw', $optionsRaw);
        return $this;
    }

    /**
     * @return mixed
     */
    public function render()
    {
        if (empty($this->name)) {
            $this->name('select');
        }
        $select2 = $this->select2[$this->name];
        return view('select2-template::select2-template')
                ->with('element', $this->name)
                ->with('placeholder', $select2['placeholder'])
                ->with('options', isset($select2['options']) ? $select2['options'] : '')
                ->with('optionsRaw', isset($select2['optionsRaw']) ? $select2['optionsRaw'] : '')
                ->with('ajax', isset($select2['ajax']) ? $select2['ajax'] : '');
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    private function get($key)
    {
        return array_get($this->select2[$this->name], $key);
    }

    /**
     * @param $key
     * @param $value
     *
     * @return $this|Builder
     */
    private function set($key, $value)
    {
        array_set($this->select2[$this->name], $key, $value);
        return $this;
    }
}
